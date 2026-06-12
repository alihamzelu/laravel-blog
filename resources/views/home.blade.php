<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>simple blog</title>

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

  @include("components.header")

  <main class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">

    <div class="mb-16 text-center md:text-left">
      <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl text-slate-900 dark:text-white transition-colors duration-300">
        Explore the <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-emerald-400 dark:to-cyan-400 transition-colors duration-300">Blog</span>
      </h1>
      <p class="mt-4 text-lg text-slate-500 dark:text-slate-400 transition-colors duration-300 max-w-2xl">
        Notes on coding, creativity, and building better websites
      </p>
    </div>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($posts as $post)

      <article class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-200 ease-in-out hover:-translate-y-1.5 hover:shadow-xl dark:bg-slate-800/50 dark:ring-slate-700 dark:hover:ring-emerald-500/50 dark:hover:shadow-emerald-500/10">
        <div class="relative overflow-hidden">
          <img class="h-56 w-full object-cover transition-transform duration-200 ease-in-out group-hover:scale-105" src="{{ asset('storage/' . $post->image) }}" alt="Code on screen">
          <div class="absolute top-4 left-4 rounded-full bg-indigo-100 px-3 py-1 text-xs font-bold text-indigo-700 dark:bg-emerald-500/20 dark:text-emerald-400 dark:border dark:border-emerald-500/30 transition-colors duration-200">
            <a href="{{ route('articles.index', ['category' => $post->category->slug]) }}">
              {{ $post->category->name }}
            </a>
          </div>
        </div>
        <div class="flex flex-1 flex-col justify-between p-6">
          <div class="flex-1">
            <a href="{{ route('posts.show', $post->slug) }}" class="block">
              <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 dark:text-white dark:group-hover:text-emerald-400 transition-colors duration-200">{{ $post->title }}</h3>
              <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 line-clamp-3 transition-colors duration-200">{{ Str::limit($post->content, 150, '...') }}</p>
            </a>
          </div>
          <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4 dark:border-slate-700/50 transition-colors duration-200">
            <div class="flex items-center space-x-3">
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Author">
              <a href="{{ route('preview', $post->user) }}">
                <span class="text-sm font-medium text-slate-900 dark:text-slate-200 transition-colors duration-200">{{ $post->user->name }}</span>
              </a>
            </div>
            <p class="text-xs font-medium text-slate-500 dark:text-slate-500">{{ $post->published_at }}</p>
          </div>
        </div>
      </article>

      @endforeach




    </div>
  </main>

  @include('components.footer')


  <script>
    // Theme Toggle Elements
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    // Mobile Menu Elements
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