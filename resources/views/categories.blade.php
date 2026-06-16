<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories</title>

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

  @include('components.header')

  <main class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">

    <header class="max-w-2xl mb-12">
      <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-slate-900 dark:text-white mb-4 transition-colors">
        Explore by Categories
      </h1>
      <p class="text-lg text-slate-500 dark:text-slate-400 transition-colors">
        Find deep dives, engineering guides, and design perspectives categorized to help you build better frontend experiences.
      </p>
    </header>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-16">
      @foreach ($categories as $category)

      <div class="group relative flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
        <div>
          <div class="absolute top-0 right-6 h-1.5 w-16 rounded-b-full bg-indigo-600 dark:bg-emerald-400"></div>

          <div class="inline-flex rounded-xl bg-indigo-50 p-3 text-indigo-600 dark:bg-emerald-500/10 dark:text-emerald-400 mb-4 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V6.75A2.25 2.25 0 0 1 4.5 4.5h4.379c.597 0 1.169.237 1.591.659l1.121 1.121c.422.422.994.659 1.591.659H19.5a2.25 2.25 0 0 1 2.25 2.25v7.5A2.25 2.25 0 0 1 19.5 18H4.5a2.25 2.25 0 0 1-2.25-2.25z" />
            </svg>
          </div>
          <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-2 transition-colors">{{ $category->name }}</h2>
          <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed mb-6 transition-colors">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident modi, consequatur quod autem,
          </p>
        </div>
        <div class="flex items-center justify-between border-t border-slate-100 pt-4 dark:border-slate-800/60 transition-colors">
          <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $category->posts->count() }} Articles</span>
          <a href="{{ route('articles.index', ['category' => $category->slug]) }}" class="text-sm font-bold text-indigo-600 dark:text-emerald-400 hover:underline inline-flex items-center space-x-1">
            <span>Browse</span>
            <span>&rarr;</span>
          </a>
        </div>
      </div>

      @endforeach

    </div>


  </main>

  @include('components.footer')

  <script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

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

    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      hamburgerIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
    });
  </script>
</body>

</html>