<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view("gallery.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        abort_unless($user, 403);

        $request->validate([
            "title" => ["required", "max:255"],
            "image" => ["required", "image"],
            "description" => ["nullable", "string"],
            "category_id" => ["nullable", "exists:categories,id"],
            'is_public' => ['required', 'boolean'],
        ]);

        $path = $request->file("image")->store("gallery", 'public');

        // slug unique
        $slug = Str::slug($request->title);
        $original = $slug;
        $i = 1;

        while (Gallery::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }

        Gallery::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'image' => $path,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_public' => $request->is_public,
            'slug' => $slug,
        ]);

        return redirect()->route('dashboard');
    }

    public function index()
    {
        $galleries = Gallery::where('is_public', true)
            ->latest()
            ->get();

        return view("gallery", compact("galleries"));
    }

    public function edit(Gallery $gallery)
    {
        $this->authorizeOwner($gallery);

        $categories = Category::all();

        return view("gallery.edit", compact("categories", "gallery"));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $this->authorizeOwner($gallery);

        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'is_public' => ['required', 'boolean'],
            'image' => ['nullable', 'image'],
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_public' => $request->is_public,
        ];

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Gallery updated successfully');
    }

    public function destroy(Gallery $gallery)
    {
        $user = auth()->user();

        if ($gallery->user_id !== $user->id && ! $user->hasRole('admin')) {
            abort(403);
        }

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Gallery deleted successfully');
    }

    private function authorizeOwner(Gallery $gallery)
    {
        $user = Auth::user();

        abort_unless($user && $gallery->user_id === $user->id, 403);
    }
}
