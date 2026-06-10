<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New Post - DevBlog</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            night: '#0B1120', 
          }
        },
      },
    }
  </script>
</head>
<body class="bg-slate-50 text-slate-900 transition-colors duration-300 dark:bg-night dark:text-slate-100 font-sans antialiased overflow-x-hidden">

  <div id="toast-notification" class="fixed bottom-5 right-5 z-50 transform translate-y-20 opacity-0 pointer-events-none transition-all duration-300 ease-out flex items-center space-x-3 bg-indigo-600 dark:bg-emerald-500 text-white dark:text-night font-semibold py-3 px-5 rounded-xl shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <span>Draft saved successfully!</span>
  </div>

  @include('components.header')


  <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
    <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="post" class="grid gap-8 lg:grid-cols-3">
        @csrf

      <div class="lg:col-span-2 space-y-6">
        
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 space-y-5 transition-colors">
          
          <div>
            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wide" for="post-title">Article Title</label>
            <input name="title" value="{{ old('title') }}" type="text" id="post-title" placeholder="e.g., Deconstructing Complex Render Engines..." required class="w-full text-lg font-bold bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all @error('title') border-red-500 dark:border-red-500 @enderror" />
            @error('title')
              <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <div class="flex items-center justify-between mb-2">
              <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide" for="post-body">Article Content</label>
              <span class="text-2xs text-slate-400 font-medium font-mono">Markdown Supported</span>
            </div>
            <textarea name="content" id="post-body" rows="14" placeholder="Write something incredible... use markdown syntax for headings, code snippets, and list structures natively." required class="w-full font-mono text-sm bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all leading-relaxed resize-y @error('content') border-red-500 dark:border-red-500 @enderror">{{ old('content') }}</textarea>
            @error('content')
              <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="space-y-6">
        
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 space-y-5 transition-colors">
          <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-800 pb-3">Publication Options</h3>
          
          <div>
            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wide" for="post-category">Category Type</label>
            <select name="category_id" id="post-category" class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all cursor-pointer @error('category_id') border-red-500 dark:border-red-500 @enderror">
              <option value="">Select a Category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
              @endforeach
            </select>
            @error('category_id')
              <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wide" for="post-image">Cover Image File</label>
            <input type="file" name="image" id="post-image" accept="image/*" class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 @error('image') border-red-500 @enderror" />
            <p class="text-3xs text-slate-400 dark:text-slate-500 mt-1.5 leading-normal">Upload a high-quality article layout cover image.</p>
            @error('image')
              <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 flex flex-col gap-3 transition-colors">
          <button type="submit" class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 text-sm font-bold shadow-md transition-all dark:bg-emerald-400 dark:text-night dark:hover:bg-emerald-500">
            Publish Post
          </button>
          
          <button type="button" onclick="triggerDraftSaveSimulation()" class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700/60 px-5 py-3 text-sm font-bold transition-all shadow-sm">
            Save Draft
          </button>

          <button type="button" onclick="window.history.back()" class="w-full text-center text-xs text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-bold py-1.5 transition-colors">
            Discard & Cancel
          </button>
        </div>

      </div>
    </form>
  </main>

  <script>
    const toast = document.getElementById('toast-notification');

    function triggerDraftSaveSimulation() {
      toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
      
      setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
      }, 3000);
    }

    // Standard Theme Mode Switching Registry Pipeline
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        lightIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        darkIcon.classList.remove('hidden');
    }

    themeToggleBtn.addEventListener('click', function() {
        darkIcon.classList.toggle('hidden');
        lightIcon.classList.toggle('hidden');
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    });
  </script>
</body>
</html>