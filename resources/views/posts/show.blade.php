<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mastering Tailwind CSS Layouts - DevBlog</title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Tailwind Configuration for Dark Mode -->
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

  <!-- Navigation -->
  @include('components.header')

  <!-- Article View Layout Split -->
  <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="grid gap-10 lg:grid-cols-3 items-start">
      
      <!-- Primary Core Reading Area (2/3 width) -->
      <div class="lg:col-span-2">
        
        <!-- Article Context Info Header -->
        <header class="mb-8">
          <a href="#" class="inline-flex rounded-full bg-indigo-100 px-3 py-1 text-xs font-bold text-indigo-700 dark:bg-emerald-500/20 dark:text-emerald-400 mb-4 transition-colors">
            {{ $post->category->name }}
          </a>
          <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-slate-900 dark:text-white leading-tight transition-colors">
            {{ $post->title }}
          </h1>
          
          <!-- Metas: Author, Timings, Dates -->
          <div class="flex items-center space-x-4 border-b border-slate-200 dark:border-slate-800 py-6 mt-6 transition-colors">
            <img class="h-11 w-11 rounded-full object-cover" src="" alt="">
            <div class="text-sm">
              <p class="font-bold text-slate-900 dark:text-slate-200">{{ $post->user->name }}</p>
              <div class="flex items-center space-x-2 text-xs text-slate-400 mt-0.5">
                <span>Published {{ $post->published_at }}</span>
              </div>
            </div>
          </div>
        </header>

        <!-- Splash Hero Article Image -->
        <div class="overflow-hidden rounded-2xl mb-10 shadow-sm border border-slate-200 dark:border-slate-800 transition-colors">
          <img class="w-full h-[320px] sm:h-[400px] object-cover" src="{{ asset('storage/' . $post->image) }}" alt="Workspace development code display">
        </div>

        <!-- Premium High-Readability Editorial Content Block -->
        <div class="text-slate-700 dark:text-slate-300 text-base sm:text-lg leading-relaxed space-y-6 antialiased transition-colors">
          <p>{{ $post->content }}</p>
        </div>

        <!-- Share and Interaction Bar -->
        <div class="border-y border-slate-200 dark:border-slate-800 py-6 my-10 flex items-center justify-between transition-colors">
          <div class="flex items-center space-x-2">
            <button class="flex items-center space-x-1.5 rounded-xl border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 dark:border-slate-800 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904M14.25 9.664V6c0-1.152-.26-2.243-.723-3.218M5.904 19.5H3c-1.105 0-2-.895-2-2V10c0-1.105.895-2 2-2h2.904m0 11.5V8.25" /></svg>
              <span>412 Likes</span>
            </button>
          </div>
          <div class="flex items-center space-x-2">
            <a href="#" class="text-xs font-semibold text-slate-400 hover:text-indigo-600 dark:hover:text-emerald-400 transition-colors">Share to Twitter</a>
          </div>
        </div>

      </div>

      <!-- Sticky Reading Sidebar Area (1/3 width) -->
      <aside class="space-y-6 lg:sticky lg:top-24">
        
        <!-- Author Insight Card -->
        <div class="rounded-2xl bg-white border border-slate-200 dark:bg-slate-800/40 dark:border-slate-800 p-5 transition-colors">
          <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-3">Written By</h3>
          <div class="flex items-center space-x-3 mb-3">
            <img class="h-10 w-10 rounded-full object-cover" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Alex Reed">
            <div>
              <p class="text-sm font-bold text-slate-900 dark:text-slate-200">{{ $post->user->name }}</p>
              <p class="text-2xs text-slate-400 dark:text-slate-500">{{ $post->user->job }}</p>
            </div>
          </div>
          <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
            {{ $post->user->bio }}
          </p>
          <a href="{{ route('preview', auth()->user()) }}" class="inline-block mt-3 text-xs font-bold text-indigo-600 dark:text-emerald-400 hover:underline">View Profile &rarr;</a>
        </div>



      </aside>

    </div>
  </main>

  <!-- Footer -->
  @include('components.footer')

  <!-- Script Elements -->
  <script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    // 1. Theme Configuration Logic
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

    // 2. Mobile Menu Toggle Logic
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
  </script>
</body>
</html>