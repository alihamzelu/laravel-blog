<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories</title>
  
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

  @include('components.header')

  <!-- Categories Hub Content -->
  <main class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
    
    <!-- Hero / Intro Header -->
    <header class="max-w-2xl mb-12">
      <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-slate-900 dark:text-white mb-4 transition-colors">
        Explore by Categories
      </h1>
      <p class="text-lg text-slate-500 dark:text-slate-400 transition-colors">
        Find deep dives, engineering guides, and design perspectives categorized to help you build better frontend experiences.
      </p>
    </header>

    <!-- Main Grid: Primary Categories -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-16">
      @foreach ($categories as $category)

      <div class="group relative flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
        <div>
          <!-- Color Tab Indicator top-right -->
          <div class="absolute top-0 right-6 h-1.5 w-16 rounded-b-full bg-indigo-600 dark:bg-emerald-400"></div>
          
          <div class="inline-flex rounded-xl bg-indigo-50 p-3 text-indigo-600 dark:bg-emerald-500/10 dark:text-emerald-400 mb-4 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
            </svg>
          </div>
          <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-2 transition-colors">{{ $category->name }}</h2>
          <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed mb-6 transition-colors">
            Deep dives into framework architecture, specialized system layouts, optimization setups, and modular workflows.
          </p>
        </div>
        <div class="flex items-center justify-between border-t border-slate-100 pt-4 dark:border-slate-800/60 transition-colors">
          <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">42 Articles</span>
          <a href="{{ route('articles.index', ['category' => $category->slug]) }}" class="text-sm font-bold text-indigo-600 dark:text-emerald-400 hover:underline inline-flex items-center space-x-1">
            <span>Browse</span>
            <span>&rarr;</span>
          </a>
          <!-- Category Card 1: Engineering -->
        </div>
      </div>
      
      @endforeach

    </div>

    <!-- Secondary Structural Block: Trending Sub-tags / Filters -->
    <section class="border-t border-slate-200 dark:border-slate-800 pt-12 transition-colors">
      <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-6">
        Trending Sub-Tags & Technologies
      </h3>
      
      <div class="flex flex-wrap gap-3">
        <a href="#" class="inline-flex items-center space-x-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 dark:bg-slate-900/20 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
          <span class="h-2 w-2 rounded-full bg-sky-400"></span>
          <span>TailwindCSS</span>
          <span class="text-xs font-normal text-slate-400 dark:text-slate-500 ml-1">(14)</span>
        </a>
        <a href="#" class="inline-flex items-center space-x-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 dark:bg-slate-900/20 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
          <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
          <span>Vue.js</span>
          <span class="text-xs font-normal text-slate-400 dark:text-slate-500 ml-1">(9)</span>
        </a>
        <a href="#" class="inline-flex items-center space-x-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 dark:bg-slate-900/20 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
          <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
          <span>React</span>
          <span class="text-xs font-normal text-slate-400 dark:text-slate-500 ml-1">(22)</span>
        </a>
        <a href="#" class="inline-flex items-center space-x-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 dark:bg-slate-900/20 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
          <span class="h-2 w-2 rounded-full bg-amber-400"></span>
          <span>JavaScript</span>
          <span class="text-xs font-normal text-slate-400 dark:text-slate-500 ml-1">(31)</span>
        </a>
        <a href="#" class="inline-flex items-center space-x-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 dark:bg-slate-900/20 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
          <span class="h-2 w-2 rounded-full bg-purple-500"></span>
          <span>Web Accessibility</span>
          <span class="text-xs font-normal text-slate-400 dark:text-slate-500 ml-1">(6)</span>
        </a>
        <a href="#" class="inline-flex items-center space-x-2 rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50 dark:bg-slate-900/20 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
          <span class="h-2 w-2 rounded-full bg-rose-400"></span>
          <span>Figma Layouts</span>
          <span class="text-xs font-normal text-slate-400 dark:text-slate-500 ml-1">(11)</span>
        </a>
      </div>
    </section>

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