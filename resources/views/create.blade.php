<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { night: '#0B1120' } } } }
  </script>
</head>


<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased min-h-screen transition-colors duration-200">

  @include('components.header')

  <main class="max-w-5xl mx-auto px-4 py-12">
    
    <div class="mb-8">
      <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Create New Post</h1>
      <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Share your technical insights, tutorials, and stories with the dev community.</p>
    </div>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-8 lg:grid-cols-3">
      @csrf

      <div class="lg:col-span-2 bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6 transition-colors">
        
        <div>
          <label for="title" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Post Title</label>
          <input type="text" 
                 id="title"
                 name="title" 
                 value="{{ old('title') }}" 
                 placeholder="e.g. Mastering Tailwind CSS Layouts at Scale" 
                 required
                 autofocus
                 class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('title') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
          @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="content" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Article Content</label>
          <textarea id="content" 
                    name="content" 
                    rows="12" 
                    placeholder="Write your markdown or text content here..." 
                    required
                    class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('content') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all resize-y min-h-[200px]">{{ old('content') }}</textarea>
          @error('content') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

      </div>

      <div class="space-y-6">
        
        <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 shadow-sm space-y-5 transition-colors">
          
          <div>
            <label for="category_id" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Category</label>
            <select id="category_id" 
                    name="category_id" 
                    required
                    class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('category_id') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all appearance-none cursor-pointer">
              <option value="" disabled selected>Select a category</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
            </select>
            @error('category_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="image" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Cover Image</label>
            <input type="file" 
                   id="image"
                   name="image" 
                   accept="image/*"
                   class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 hover:file:opacity-90 file:cursor-pointer cursor-pointer bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl p-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
            @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <div class="pt-2">
            <button type="submit" class="w-full bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm flex items-center justify-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
              <span>Publish Post</span>
            </button>
          </div>

        </div>

        <div class="text-center">
          <a href="{{ url()->previous() }}" class="text-xs text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 underline transition-all">Cancel and Go Back</a>
        </div>

      </div>
    </form>

  </main>

</body>

</html>