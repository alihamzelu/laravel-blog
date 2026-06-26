<!DOCTYPE html>
<html class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>gallery</title>

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

  <main class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8 flex flex-col items-center">

    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 w-full justify-center">

      @foreach ($galleries as $photo)
      @if($photo->is_public)
      <div class="group flex flex-col overflow-hidden rounded-2xl bg-white border border-slate-200/80 transition-all duration-200 hover:-translate-y-1 hover:shadow-lg hover:border-indigo-500 dark:bg-slate-900/40 dark:border-slate-800 dark:hover:border-emerald-500 dark:hover:shadow-emerald-500/5">

        <div class="relative overflow-hidden aspect-square border-b border-slate-100 dark:border-slate-800/60">
          <a href="{{ asset('storage/'.$photo->image) }}">
            <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/'.$photo->image) }}" alt="Gallery Image" loading="lazy">
          </a>

          <span class="absolute top-3 left-3 rounded-md bg-slate-900/80 backdrop-blur-sm px-2 py-0.5 text-[10px] font-bold text-white tracking-wide">
            <a href="{{ route('preview', $photo->user->username) }}">
              {{ $photo->user->username }}
            </a>
          </span>

          <span class="absolute top-3 right-3 rounded-md bg-slate-900/80 backdrop-blur-sm px-2 py-0.5 text-[10px] font-bold text-white tracking-wide uppercase">
            {{ $photo->is_public ? 'public' : 'private' }}
        </div>

        <div class="p-4 flex flex-col justify-between flex-grow">
          <div>
            <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 dark:text-emerald-400 block mb-1">
            <a href="{{ route('articles.index', ['category' => $photo->category->slug]) }}">
              {{ $photo->category->name ?? 'Gaming' }} </span>
            </a>

            <h3 class="text-sm font-bold text-slate-900 dark:text-white line-clamp-1 group-hover:text-indigo-600 dark:group-hover:text-emerald-400 transition-colors">
              {{ $photo->title }}
            </h3>

            <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400 line-clamp-2">
              {{ $photo->description ?? 'It has no description' }}
            </p>
          </div>
        </div>
        @endif


      </div>

      @endforeach

    </div>
  </main>
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