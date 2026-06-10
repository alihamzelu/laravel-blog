<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Articles - DevBlog</title>

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

    <div class="mb-10">
      <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl text-slate-900 dark:text-white transition-colors">
        All Articles
      </h1>
      <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
        Discover architectural case studies, layout deep dives, and system reviews.
      </p>
    </div>

    <div class="grid gap-8 lg:grid-cols-4 items-start">

      <aside class="space-y-6 lg:sticky lg:top-24 order-1 lg:order-1">

        <div class="relative rounded-2xl bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 p-4 transition-colors">
          <label for="search-input" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Search Content</label>
          <form action="{{ route('articles.index') }}" method="get">
            @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <div class="relative">
              <input value="{{ request('search') }}" type="text" id="search-input" name="search" placeholder="Type to filter..." class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-2 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
              <div class="absolute left-3 top-2.5 text-slate-400 dark:text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.604 10.604Z" />
                </svg>
              </div>
            </div>
          </form>
        </div>

        <div class="rounded-2xl bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 p-5 transition-colors">
          <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-3">Categories</h3>
          <div class="space-y-1 flex flex-row flex-wrap lg:flex-col gap-2 lg:gap-1" id="category-filters">

            <a href="{{ route('articles.index', request()->only('search')) }}"
              class="w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm transition-all {{ !request('category') ? 'font-bold bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night shadow-sm' : 'font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800/60' }}">
              All Posts
            </a>

            @foreach ($categories as $category)
            <a href="{{ route('articles.index', ['category' => $category->slug] + request()->only('search')) }}"
              class="w-full text-left px-3 py-2 rounded-xl text-xs sm:text-sm transition-all {{ request('category') === $category->slug ? 'font-bold bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night shadow-sm' : 'font-medium text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800/60' }}">
              {{ $category->name }}
            </a>
            @endforeach

          </div>
        </div>
      </aside>

      <div class="lg:col-span-3 order-2 lg:order-2">
        <div id="posts-container" class="grid gap-6 sm:grid-cols-2">

          @forelse ($posts as $post)
          <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40 flex flex-col justify-between">
            <div>
              <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('storage/' . $post->image) }}" alt="Article Cover">
              </div>

              <div class="p-5">
                <span class="inline-block rounded-full px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-3 bg-indigo-50 text-indigo-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                  {{ $post->category->name }}
                </span>

                <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 dark:text-white dark:group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                  <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </h3>

                <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 line-clamp-2 leading-relaxed">
                  {{ Str::limit($post->content, 150, '...') }}
                </p>
              </div>
            </div>

            <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3.5 dark:border-slate-800/60 text-2xs text-slate-400 font-medium">
              <span>{{ $post->user->name }}</span>
              <span>&bull;</span>
              <span>{{ $post->published_at }}</span>
            </div>
          </article>
          @empty
          <div class="col-span-full text-center py-16 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-slate-400 dark:text-slate-600 mb-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">No matching articles found</h3>
            <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Try refining your keyword query or changing categories.</p>
          </div>
          @endforelse

        </div>
      </div>

    </div>
  </main>

  @include('components.footer')

</body>

</html>