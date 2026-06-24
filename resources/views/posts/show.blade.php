<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $post->title }}</title>
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
    <div class="grid gap-10 lg:grid-cols-3 items-start">

      <div class="lg:col-span-2">

        <header class="mb-8">
          <a href="{{ route('articles.index', ['category' => $post->category->slug]) }}" class="inline-flex rounded-full bg-indigo-100 px-3 py-1 text-xs font-bold text-indigo-700 dark:bg-emerald-500/20 dark:text-emerald-400 mb-4 transition-colors">
            {{ $post->category->name }}
          </a>
          <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-slate-900 dark:text-white leading-tight transition-colors">
            {{ $post->title }}
          </h1>

          <div class="flex items-center space-x-4 border-b border-slate-200 dark:border-slate-800 py-6 mt-6 transition-colors">
            <img class="h-11 w-11 rounded-full object-cover" src="{{ asset('storage/' . $post->user->avatar) }}" alt="">
            <div class="text-sm">
              <p class="font-bold text-slate-900 dark:text-slate-200">{{ $post->user->name }}</p>
              <div class="flex items-center space-x-2 text-xs text-slate-400 mt-0.5">
                <span>Published {{ $post->published_at }}</span>
              </div>
            </div>
          </div>
        </header>

        <div class="overflow-hidden rounded-2xl mb-10 shadow-sm border border-slate-200 dark:border-slate-800 transition-colors">
          <img class="w-full h-[320px] sm:h-[400px] object-cover" src="{{ asset('storage/' . $post->image) }}" alt="Workspace development code display">
        </div>

        <div class="text-slate-700 dark:text-slate-300 text-base sm:text-lg leading-relaxed space-y-6 antialiased transition-colors">
          <p>{{ $post->content }}</p>
        </div>

        <div class="border-y border-slate-200 dark:border-slate-800 py-6 my-10 flex items-center justify-between transition-colors">
          <div class="flex items-center space-x-3">

            <form action="{{ route('posts.like', $post) }}" method="POST">
              @csrf
              <button
                type="submit"
                class="flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition-all hover:bg-slate-100 hover:text-rose-500 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800/80 dark:hover:text-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904M14.25 9.664V6c0-1.152-.26-2.243-.723-3.218M5.904 19.5H3c-1.105 0-2-.895-2-2V10c0-1.105.895-2 2-2h2.904m0 11.5V8.25" />
                </svg>
                <span>{{ $post->likes_count }}</span>
              </button>
            </form>

            <form action="{{ Route('posts.bookmark', $post)  }}" method="POST">
              @csrf

              <button
                type="submit"
                class="flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition-all hover:bg-slate-100 hover:text-indigo-600 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800/80 dark:hover:text-emerald-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0z" />
                </svg>
                <span>Save</span>
              </button>
            </form>

          </div>
          <div class="flex items-center space-x-2">
            <a href="#" class="text-xs font-semibold text-slate-400 hover:text-indigo-600 dark:hover:text-emerald-400 transition-colors">Share to Twitter</a>
          </div>
        </div>

        <section class="mt-12">
          <h3 class="text-xl font-black text-slate-900 dark:text-white mb-6">Discussion ({{ $post->comments->count() }})</h3>
          @auth
          <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
              <textarea name="body" id="comment" rows="4" required class="w-full bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 rounded-2xl px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all placeholder-slate-400" placeholder="Join the discussion..."></textarea>
            </div>
            <div class="flex justify-end">
              <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 text-white px-5 py-2.5 text-xs font-bold hover:opacity-90 dark:bg-emerald-400 dark:text-night transition-all">
                Post Comment
              </button>
            </div>
          </form>
          @else
          <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Please <a href="{{ route('login') }}" class="text-indigo-600 dark:text-emerald-400 hover:underline">log in</a> to join the discussion.</p>
          @endauth

          <div class="space-y-5">
            @foreach ($post->comments as $comment)
            <div class="flex items-start space-x-4 text-sm">
              <img class="h-9 w-9 rounded-full object-cover flex-shrink-0" src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}">
              <div class="flex-grow bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-4 transition-colors">
                <div class="flex items-center justify-between mb-1">
                  <span class="font-bold text-slate-900 dark:text-slate-200">{{ $comment->user->name }}</span>
                  <span class="text-3xs font-mono text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed text-xs sm:text-sm">
                  {{ $comment->body }}
                </p>
              </div>
            </div>
            @endforeach
          </div>
        </section>

      </div>

      <aside class="space-y-6 lg:sticky lg:top-24">

        <div class="rounded-2xl bg-white border border-slate-200 dark:bg-slate-800/40 dark:border-slate-800 p-5 transition-colors">
          <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-3">Written By</h3>
          <div class="flex items-center space-x-3 mb-3">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $post->user->avatar) }}" alt="">
            <div>
              <p class="text-sm font-bold text-slate-900 dark:text-slate-200">{{ $post->user->name }}</p>
              <p class="text-2xs text-slate-400 dark:text-slate-500">{{ $post->user->job }}</p>
            </div>
          </div>
          <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
            {{ $post->user->bio }}
          </p>
          <a href="{{ route('preview', $post->user) }}" class="inline-block mt-3 text-xs font-bold text-indigo-600 dark:text-emerald-400 hover:underline">View Profile &rarr;</a>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 dark:border-slate-800 dark:bg-slate-800/40">
          <h3 class="mb-5 text-xs font-bold uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">
            Related Posts
          </h3>

          <div class="space-y-4">
            @foreach ($relatedPosts as $relatedPost)
            <a href="{{ route('posts.show', $relatedPost) }}" class="flex gap-4 group">
              <img
                src="{{ asset('storage/' . $relatedPost->image) }}"
                class="h-12 w-12 rounded-xl object-cover transition group-hover:scale-105"
                alt="">

              <div class="flex-1">
                <h4 class="text-sm font-semibold text-slate-900 dark:text-slate-100 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-emerald-400 transition">
                  {{ $relatedPost->title }}
                </h4>
                <p class="mt-1 text-3xs text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wider">
                  {{ $relatedPost->category->name }}
                </p>
              </div>
            </a>
            @endforeach
          </div>
        </div>

      </aside>

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
        if (mobileMenu) mobileMenu.classList.toggle('hidden');
        if (hamburgerIcon) hamburgerIcon.classList.toggle('hidden');
        if (closeIcon) closeIcon.classList.toggle('hidden');
      });
    }
  </script>
</body>

</html>