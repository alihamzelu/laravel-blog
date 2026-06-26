<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $is_public = Gallery::where('id', 1)->value('is_public');

        return view("gallery.create", compact("categories", "is_public"));
    }
    public function store(Request $request)
    {
        $request->validate([
            "title" => ["required", "max:255"],
            "image" => ["required", "image", "max:2028"],
            "description" => ["nullable", "string"],
            "category_id" => ["nullable", "exists:categories,id"],
            'is_public' => ['required', 'boolean'],
        ]);


        $path = $request->file("image")->store("gallery", 'public');

        $slug = Str::slug($request->title);
        $original = $slug;
        $i = 1;

        while (Gallery::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i;
            $i++;
        }

        Gallery::create([
            'user_id' => auth()->id(),
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
        $galleries = Gallery::all();




        return view("gallery", compact("galleries"));
    }
    public function edit(Gallery $gallery)
    {
        $categories = Category::all();

        return view("gallery.edit", compact("categories", "gallery"));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'is_public' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'max:2028'],
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
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        
        return redirect()->route('dashboard')
            ->with('success', 'Gallery deleted successfully');
    }
}
