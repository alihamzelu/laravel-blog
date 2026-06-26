<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Author Dashboard</title>

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

  <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">

    <header class="rounded-2xl border border-slate-200 bg-white p-6 md:p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 mb-12 transition-colors">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

        <div class="flex items-center space-x-5">
          <img class="h-16 w-16 sm:h-20 sm:w-20 rounded-full object-cover ring-4 ring-slate-100 dark:ring-slate-800" src="{{ avatarUrl() }}" alt="avatar">
          <div>
            <h1 class="text-xl sm:text-2xl font-black tracking-tight text-slate-900 dark:text-white">{{ $user->name }}</h1>
            <p class="text-xs sm:text-sm text-slate-400 dark:text-slate-500 font-medium">{{ $user->job }}</p>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2 max-w-xl leading-relaxed">
              {{ $user->bio }}
            </p>
          </div>
        </div>

        <div class="flex-shrink-0 sm:self-start">
          @auth
          <a href="{{ route('create') }}">
            <button onclick="handleNewPost()" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 text-sm font-bold shadow-md hover:shadow-lg transition-all dark:bg-emerald-400 dark:text-night dark:hover:bg-emerald-500">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
              <span>Write New Post</span>
            </button>
          </a>
          @endauth
        </div>

      </div>
    </header>

    <section>
      <div class="border-b border-slate-200 dark:border-slate-800 pb-4 mb-6 flex items-center justify-between transition-colors">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
          @auth
          Your Published Content (<span id="post-counter">{{ $postCount }}</span>)
          @else
          Account Published Content (<span id="post-counter">{{ $postCount }}</span>)
          @endauth
        </h2>
      </div>

      <div id="author-posts-grid" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        @forelse ($posts as $post)

        <article id="post-card-{{ $post->id }}" class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1.5 hover:border-slate-300/70 dark:border-slate-800 dark:bg-slate-900/40 dark:hover:border-slate-700/70 transition-all duration-300 ease-out">
          <div>
            <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
              <a href="{{ route('posts.show', $post->slug) }}">
                <img class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                  src="{{ asset('storage/' . $post->image) }}"
                  alt="Post thumbnail">
              </a>
            </div>

            <div class="p-5">
              <span class="inline-block rounded-full bg-indigo-50 text-indigo-700 dark:bg-emerald-500/10 dark:text-emerald-400 px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-2 transition-colors duration-200">
                <a href="{{ route('articles.index', ['category' => $post->category->slug]) }}">
                  {{ $post->category->name }}
                </a>
              </span>

              <a href="{{ route('posts.show', $post->slug) }}" class="block space-y-1.5">
                <h3 class="text-base font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug group-hover:text-indigo-600 dark:group-hover:text-emerald-400 transition-colors duration-200">
                  {{ $post->title }}
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">
                  {{ Str::limit($post->content, 150, '...') }}
                </p>
              </a>
            </div>
          </div>

          <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 dark:border-slate-800/60 bg-slate-50/50 dark:bg-slate-800/20">
            <span class="text-2xs text-slate-400">{{ $post->published_at }}</span>

            <div class="flex items-center space-x-1">
              @auth

              <a href="{{ route('posts.edit', $post) }}"
                class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-emerald-400 dark:hover:bg-emerald-500/10 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <span>Edit</span>
              </a>

              <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this post?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-rose-600 hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-500/10 transition-all duration-200 cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                  </svg>
                  <span>Delete</span>
                </button>
              </form>

              @endauth
            </div>
          </div>
        </article>

        @empty
        <div class="col-span-full flex flex-col items-center justify-center text-center p-12 bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl shadow-sm transition-all">
          <div class="w-16 h-16 bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500 rounded-2xl flex items-center justify-center mb-4 ring-8 ring-slate-50 dark:ring-slate-900/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.008 1.24l.885 1.77a2.25 2.25 0 0 0 2.007 1.24h1.98a2.25 2.25 0 0 0 2.007-1.24l.885-1.77a2.25 2.25 0 0 1 2.007-1.24h3.86m-18 0h18a2.25 2.25 0 0 1 2.25 2.25v4.25A2.25 2.25 0 0 1 19.5 21h-15a2.25 2.25 0 0 1-2.25-2.25V15.75A2.25 2.25 0 0 1 2.25 13.5Zm2.25-9h15a2.25 2.25 0 0 1 2.25 2.25v3h-19.5v-3A2.25 2.25 0 0 1 4.5 4.5Z" />
            </svg>
          </div>
          <h3 class="text-lg font-bold text-slate-900 dark:text-white">No Articles Found</h3>
          <p class="mt-1 text-sm text-slate-500 dark:text-slate-400 max-w-xs">It looks like there aren't any posts published yet. Stay tuned or create the very first one!</p>
          @auth
          <a href="{{ route('create') }}" class="mt-5 inline-flex items-center space-x-2 bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold text-xs px-4 py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
            <svg xmlns="http://www.w3.org/2000/xl" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Write First Post</span>
          </a>
          @endauth
        </div>

        @endforelse

      </div>

      <div id="author-empty-state" class="hidden text-center py-20 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mx-auto text-slate-300 dark:text-slate-700 mb-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3h-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-200">No articles posted yet</h3>
        <p class="text-xs text-slate-400 mt-1">Get started by creating your very first article above.</p>
      </div>
    </section>
    <section class="mt-16">
      <div class="border-b border-slate-200 dark:border-slate-800 pb-4 mb-6 flex items-center justify-between transition-colors">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
          Your Visual Galleries (<span>4</span>)
        </h2>
      </div>

      <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($galleries as $gallery)

        <div class="group flex flex-col overflow-hidden rounded-2xl bg-white border border-slate-200/80 transition-all duration-200 hover:-translate-y-1 hover:shadow-lg hover:border-indigo-500 dark:bg-slate-900/40 dark:border-slate-800 dark:hover:border-emerald-500 dark:hover:shadow-emerald-500/5">

          <div class="relative overflow-hidden aspect-square border-b border-slate-100 dark:border-slate-800/60">
            <a href="{{ asset('storage/'.$gallery->image) }}">
              <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/'.$gallery->image) }}" alt="Gallery Image" loading="lazy">
            </a>
            <a href="{{ route('preview', $gallery->user->username) }}">
              <span class="absolute top-3 left-3 rounded-md bg-slate-900/80 backdrop-blur-sm px-2 py-0.5 text-[10px] font-bold text-white tracking-wide">{{ $gallery->user->username }}</span>
            </a>
            <span class="absolute top-3 right-3 rounded-md bg-slate-900/80 backdrop-blur-sm px-2 py-0.5 text-[10px] font-bold text-white tracking-wide uppercase">{{ $gallery->is_public ? 'public' : 'private' }}</span>
          </div>

          <div class="p-4 flex flex-col justify-between flex-grow">
            <div>
              <a href="{{ route('articles.index', ['category' => $gallery->category->slug]) }}">
                <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 dark:text-emerald-400 block mb-1">{{ $gallery->category->name }}</span>
              </a>
              <h3 class="text-sm font-bold text-slate-900 dark:text-white line-clamp-1 group-hover:text-indigo-600 dark:group-hover:text-emerald-400 transition-colors">{{ $gallery->title }}</h3>
              <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400 line-clamp-2">{{ $gallery->description ?? 'It has no description' }}</p>
            </div>
          </div>

          <div class="flex items-center justify-end space-x-1 border-t border-slate-100 px-4 py-2.5 dark:border-slate-800/60 bg-slate-50/50 dark:bg-slate-800/20">

            <a href="{{ Route('gallery.edit', $gallery->slug) }}" class="inline-flex items-center space-x-1 rounded-lg px-2 py-1 text-[11px] font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-emerald-400 dark:hover:bg-emerald-500/10 transition-all duration-200">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>
              <span>Edit</span>
            </a>

            <form action="{{ route('gallery.destroy', $gallery) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this gallery?')">
              @csrf
              @method('DELETE')

              <button type="submit" class="inline-flex items-center space-x-1 rounded-lg px-2 py-1 text-[11px] font-bold text-rose-600 hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-500/10 transition-all duration-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                <span>Delete</span>
              </button>
            </form>

          </div>

        </div>

        @endforeach
      </div>
    </section>

  </main>

  @include('components.footer')

  <script>
    let internalPostCount = 3;

    function handleNewPost() {}

    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
      if (lightIcon) lightIcon.classList.remove('hidden');
    } else {
      document.documentElement.classList.remove('dark');
      if (darkIcon) darkIcon.classList.remove('hidden');
    }

    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', function() {
        if (darkIcon) darkIcon.classList.toggle('hidden');
        if (lightIcon) lightIcon.classList.toggle('hidden');
        if (document.documentElement.classList.contains('dark')) {
          document.documentElement.classList.remove('dark');
          localStorage.setItem('color-theme', 'light');
        } else {
          document.documentElement.classList.add('dark');
          localStorage.setItem('color-theme', 'dark');
        }
      });
    }

    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
      });
    }
  </script>
</body>

</html>