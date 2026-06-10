<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Preview - DevBlog</title>
  
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
<body class="bg-slate-50 text-slate-900 transition-colors duration-300 dark:bg-night dark:text-slate-100 font-sans antialiased overflow-x-hidden pt-10">

  <div class="fixed top-0 left-0 right-0 z-50 bg-amber-500 text-night text-xs font-bold uppercase tracking-wider py-2 text-center shadow-md select-none">
    You are viewing a live layout preview
  </div>

  @include('components.header')

  <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
    
    <header class="rounded-2xl border border-slate-200 bg-white p-6 md:p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 mb-12 transition-colors">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        
        <div class="flex items-center space-x-5">
          <img class="h-16 w-16 sm:h-20 sm:w-20 rounded-full object-cover ring-4 ring-slate-100 dark:ring-slate-800" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Alex Reed avatar">
          <div>
            <h1 class="text-xl sm:text-2xl font-black tracking-tight text-slate-900 dark:text-white">Alex Reed</h1>
            <p class="text-xs sm:text-sm text-slate-400 dark:text-slate-500 font-medium">Frontend Systems Lead &bull; SF, California</p>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2 max-w-xl leading-relaxed">
              Building modular CSS tools and checking out micro-interactions. Sharing architectural case studies weekly.
            </p>
          </div>
        </div>

        <div class="flex-shrink-0 sm:self-start">
          <button onclick="window.history.back()" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700/60 text-slate-700 dark:text-slate-200 px-5 py-3 text-sm font-bold shadow-sm transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12l7.5-7.5M21 12H3" />
            </svg>
            <span>Back to Dashboard</span>
          </button>
        </div>

      </div>
    </header>

    <section>
      <div class="border-b border-slate-200 dark:border-slate-800 pb-4 mb-6 transition-colors">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
          Published Articles (3)
        </h2>
      </div>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        
        <article class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
          <div>
            <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80" alt="Thumbnail">
            </div>
            <div class="p-5">
              <span class="inline-block rounded-full bg-indigo-50 text-indigo-700 dark:bg-emerald-500/10 dark:text-emerald-400 px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-2">Engineering</span>
              <h3 class="text-base font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug">Mastering Tailwind CSS Layouts at Scale</h3>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 line-clamp-2">How to effectively structuralize production web platforms using utility grids without element styling bloat.</p>
            </div>
          </div>
          <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3.5 dark:border-slate-800/60 text-2xs text-slate-400 font-medium">
            <span>Oct 12, 2023</span>
            <span>8 min read</span>
          </div>
        </article>

        <article class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
          <div>
            <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&q=80" alt="Thumbnail">
            </div>
            <div class="p-5">
              <span class="inline-block rounded-full bg-rose-50 text-rose-700 dark:bg-fuchsia-500/10 dark:text-fuchsia-400 px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-2">Design</span>
              <h3 class="text-base font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug">The Power of Dark Mode Layout Design</h3>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 line-clamp-2">Analyzing depth layers, contrasting borders, and micro-interaction parameters across digital surfaces.</p>
            </div>
          </div>
          <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3.5 dark:border-slate-800/60 text-2xs text-slate-400 font-medium">
            <span>Sep 28, 2023</span>
            <span>6 min read</span>
          </div>
        </article>

        <article class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
          <div>
            <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="Thumbnail">
            </div>
            <div class="p-5">
              <span class="inline-block rounded-full bg-amber-50 text-amber-700 dark:bg-cyan-500/10 dark:text-cyan-400 px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-2">Life</span>
              <h3 class="text-base font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug">Building a Remote Productivity System</h3>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 line-clamp-2">Strategies on balancing fast engineering context requirements with deep work health intervals.</p>
            </div>
          </div>
          <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3.5 dark:border-slate-800/60 text-2xs text-slate-400 font-medium">
            <span>Aug 14, 2023</span>
            <span>5 min read</span>
          </div>
        </article>

      </div>
    </section>

  </main>

    @include('components.footer')


  <script>
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