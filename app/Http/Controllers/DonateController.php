<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;

class DonateController extends Controller
{
    public function donors()
    {
        $donations = Donation::where('status', 'paid')
            ->latest()
            ->take(20)
            ->get();

        return view('donate.donors', compact('donations'));
    }

    public function index()
    {
        return view("donate.donate");
    }

    public function pay(Request $request)
    {
        $user = Auth::user();

        abort_unless($user, 403);

        $request->validate([
            'amount' => ['required', 'integer', 'min:1000'], // حداقل مبلغ
        ]);

        $amount = (int) $request->amount;

        $donation = Donation::create([
            'user_id' => $user->id,
            'amount'  => $amount,
            'status'  => 'pending',
        ]);

        try {
            $response = Http::timeout(10)->post(
                "https://sandbox.zarinpal.com/pg/v4/payment/request.json",
                [
                    'merchant_id'  => '4d02b86b-1449-4b6a-a9b2-2edf4dcdde3c',
                    'amount'       => $amount,
                    'callback_url' => url('/donate/callback'),
                    'description'   => 'Blog Donation',
                ]
            );

            if (!$response->successful()) {
                throw new \Exception('Zarinpal request failed');
            }

            $data = $response->json();

            $authority = $data['data']['authority'] ?? null;

            if (!$authority) {
                throw new \Exception('Authority not received');
            }

            $donation->update([
                'authority' => $authority,
            ]);

            return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $authority);

        } catch (\Exception $e) {

            $donation->update([
                'status' => 'failed',
            ]);

            return redirect('/donate/failed');
        }
    }

    public function callback(Request $request)
    {
        $status = $request->query('Status');
        $authority = $request->query('Authority');

        if (!$authority) {
            return redirect('/donate/failed');
        }

        $donation = Donation::where('authority', $authority)->first();

        if (!$donation) {
            return redirect('/donate/failed');
        }

        if ($donation->status === 'paid') {
            return redirect('/donate/success');
        }

        if ($status !== 'OK') {
            $donation->update(['status' => 'failed']);
            return redirect('/donate/failed');
        }

        try {
            $response = Http::timeout(10)->post(
                "https://sandbox.zarinpal.com/pg/v4/payment/verify.json",
                [
                    'merchant_id' => '4d02b86b-1449-4b6a-a9b2-2edf4dcdde3c',
                    'amount'      => $donation->amount,
                    'authority'   => $authority,
                ]
            );

            if (!$response->successful()) {
                throw new \Exception('Verify request failed');
            }

            $data = $response->json();

            if (($data['data']['code'] ?? null) == 100) {

                $donation->update([
                    'status' => 'paid',
                    'ref_id' => $data['data']['ref_id'] ?? null,
                ]);

                return redirect('/donate/success');
            }

            $donation->update([
                'status' => 'failed',
            ]);

        } catch (\Exception $e) {

            $donation->update([
                'status' => 'failed',
            ]);
        }

        return redirect('/donate/failed');
    }

    public function success()
    {
        return view('donate.success');
    }

    public function failed()
    {
        return view('donate.failed');
    }
}