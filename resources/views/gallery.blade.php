<!DOCTYPE html>
<html class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery</title>

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

<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased overflow-x-hidden">

@include('components.header')

<main class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">

  <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">

    @foreach ($galleries as $photo)

      @if($photo->is_public)

        <div class="group flex flex-col overflow-hidden rounded-2xl bg-white border border-slate-200/80 dark:bg-slate-900/40 dark:border-slate-800 hover:shadow-lg transition">

          <div class="relative aspect-square overflow-hidden border-b border-slate-100 dark:border-slate-800">

            <a href="{{ asset('storage/'.$photo->image) }}">
              <img
                src="{{ asset('storage/'.$photo->image) }}"
                class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500"
                loading="lazy"
              >
            </a>

            @if($photo->user)
              <a href="{{ route('preview', $photo->user->username) }}"
                 class="absolute top-3 left-3 rounded-md bg-slate-900/80 px-2 py-0.5 text-[10px] font-bold text-white backdrop-blur-sm">
                {{ $photo->user->username }}
              </a>
            @endif

            <span class="absolute top-3 right-3 rounded-md bg-slate-900/80 px-2 py-0.5 text-[10px] font-bold text-white uppercase backdrop-blur-sm">
              public
            </span>

          </div>

          <div class="p-4 flex flex-col gap-2">

            @if($photo->category)
              <a href="{{ route('articles.index', ['category' => $photo->category->slug]) }}"
                 class="text-[10px] font-black uppercase tracking-wider text-indigo-600 dark:text-emerald-400">
                {{ $photo->category->name }}
              </a>
            @endif

            <h3 class="text-sm font-bold line-clamp-1 group-hover:text-indigo-600 dark:group-hover:text-emerald-400">
              {{ $photo->title }}
            </h3>

            <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-2">
              {{ $photo->description ?? 'It has no description' }}
            </p>

          </div>

        </div>

      @endif

    @endforeach

  </div>

</main>

<script>
  const themeToggleBtn = document.getElementById('theme-toggle');
  const darkIcon = document.getElementById('dark-icon');
  const lightIcon = document.getElementById('light-icon');

  if (themeToggleBtn) {
    if (
      localStorage.getItem('theme') === 'dark' ||
      (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark');
    }

    themeToggleBtn.addEventListener('click', () => {
      document.documentElement.classList.toggle('dark');
      localStorage.setItem(
        'theme',
        document.documentElement.classList.contains('dark') ? 'dark' : 'light'
      );
    });
  }
</script>

</body>
</html>