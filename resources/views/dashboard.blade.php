<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creator Dashboard</title>

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

    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-slate-200 dark:border-slate-800 pb-6 mb-8 gap-4 transition-colors">
      <div>
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-3xl">Welcome back, Alex</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage your blog articles, customize layouts, and review content performance metrics.</p>
      </div>
      <div class="flex items-center space-x-3">
        <a href="{{ route('preview', auth()->user()) }}" class="inline-flex items-center space-x-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700/60 text-slate-700 dark:text-slate-200 px-4 py-2.5 text-sm font-bold shadow-sm transition-all">
          <span>View Profile Preview</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="inline-flex items-center space-x-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white dark:bg-emerald-400 dark:text-night dark:hover:bg-emerald-500 px-4 py-2.5 text-sm font-bold shadow-sm transition-all">
          <span>Edit Profile Settings</span>
        </a>
        @if (auth()->user()->admin)
        <a href="{{url('/admin')}}" class="inline-flex items-center space-x-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white dark:bg-blue-400 dark:text-night dark:hover:bg-emerald-500 px-4 py-2.5 text-sm font-bold shadow-sm transition-all">
          <span>Admin Panel</span>
        </a>
        @endif
      </div>
    </div>

    <section>
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
          Your Articles
        </h2>
        <button class="text-xs font-bold text-indigo-600 dark:text-emerald-400 hover:underline">
          <a href="{{ route('create') }}">
            Create New Article &rarr;
          </a>
        </button>
      </div>

      <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900/20 transition-colors">
        <div class="overflow-x-auto">
          <table class="w-full border-collapse text-left text-sm text-slate-500 dark:text-slate-400">
            <thead class="bg-slate-50 border-b border-slate-200 text-2xs font-bold uppercase tracking-wider text-slate-400 dark:bg-slate-900/60 dark:border-slate-800 dark:text-slate-500">
              <tr>
                <th scope="col" class="px-6 py-3.5">Article Title</th>
                <th scope="col" class="px-6 py-3.5 hidden sm:table-cell">Category</th>
                <th scope="col" class="px-6 py-3.5 hidden md:table-cell">Date Published</th>
                <th scope="col" class="px-6 py-3.5 text-right">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
              @foreach ($posts as $post)
              <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/40 transition-colors">
                <td class="px-6 py-4">
                  <a href="{{ route('posts.show', $post) }}" class=" font-bold hover:underline">
                    {{ $post->title }}
                  </a>
                  <span class="text-2xs text-slate-400 font-medium sm:hidden block mt-0.5"> &bull; Oct 12, 2023</span>
                </td>
                <td class="px-6 py-4 hidden sm:table-cell">
                  <span class="inline-block rounded-full bg-indigo-50 text-indigo-700 dark:bg-emerald-500/10 dark:text-emerald-400 px-2 py-0.5 text-2xs font-bold uppercase">{{ $post->category->name }}</span>
                </td>
                <td class="px-6 py-4 text-xs font-normal text-slate-400 hidden md:table-cell">{{ $post->published_at->format('M j, Y') }}</td>
                <td class="px-6 py-4 text-right text-xs">
                  <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('posts.edit', $post) }}"
                      class="text-indigo-600 dark:text-emerald-400 font-bold hover:underline">
                      Edit
                    </a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                      @csrf
                      @method('DELETE')

                      <button type="submit">
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </section>
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