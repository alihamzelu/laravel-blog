<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        $amount = $request->amount;

        if (!$amount) {
            return redirect()->back()->with('error', 'Invalid amount.');
        }

        $donation = Donation::create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'status' => 'pending',
        ]);

        $response = Http::post("https://sandbox.zarinpal.com/pg/v4/payment/request.json", [
            'merchant_id'  => '4d02b86b-1449-4b6a-a9b2-2edf4dcdde3c',
            'amount'       => $amount,
            'callback_url' => url('/donate/callback'),
            'description'  => 'Blog Donation',
        ]);

        $data = $response->json();

        if (isset($data['data']['authority'])) {

            $donation->update([
                'authority' => $data['data']['authority'],
            ]);

            return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $data['data']['authority']);
        }

        return redirect('/donate/failed');
    }

    public function callback(Request $request)
    {
        $status = $request->Status;
        $authority = $request->Authority;

        $donation = Donation::where('authority', $authority)->first();

        if (!$donation) {
            return redirect('/donate/failed');
        }

        if ($donation->status === 'paid') {
            return redirect('/donate/success');
        }

        if ($status === 'OK') {

            $response = Http::post("https://sandbox.zarinpal.com/pg/v4/payment/verify.json", [
                'merchant_id' => '4d02b86b-1449-4b6a-a9b2-2edf4dcdde3c',
                'amount'      => $donation->amount,
                'authority'   => $authority,
            ]);

            $data = $response->json();

            if (isset($data['data']['code']) && $data['data']['code'] == 100) {

                $donation->update([
                    'status' => 'paid',
                    'ref_id' => $data['data']['ref_id'] ?? null,
                ]);

                return redirect('/donate/success');
            }

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
