<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creator Dashboard - DevBlog</title>
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

<body class="bg-slate-50 text-slate-900 transition-colors duration-300 dark:bg-night dark:text-slate-100 font-sans antialiased overflow-x-hidden flex flex-col min-h-screen">

  @include('components.header')

  <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8 flex-grow w-full">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-slate-200 dark:border-slate-800 pb-6 mb-8 gap-4 transition-colors">
      <div>
        <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white sm:text-3xl">Welcome back, {{ auth()->user()->name }}</h1>
        <p class="mt-1 text-xs sm:text-sm text-slate-400 dark:text-slate-500">Manage your blog articles, customize layouts, and review content performance metrics.</p>
      </div>
      <div class="flex flex-wrap items-center gap-2.5">
        <a href="{{ route('preview', auth()->user()) }}" class="inline-flex items-center space-x-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/40 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 px-4 py-2 text-xs font-bold shadow-sm transition-all">
          <span>View Profile</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="inline-flex items-center space-x-2 rounded-xl bg-indigo-600 hover:opacity-90 text-white dark:bg-emerald-400 dark:text-night px-4 py-2 text-xs font-bold shadow-sm transition-all">
          <span>Settings</span>
        </a>
        @role('admin')
        <a href="{{ url('/admin') }}" class="inline-flex items-center space-x-2 rounded-xl bg-slate-900 text-white dark:bg-indigo-500/20 dark:text-indigo-400 border border-transparent dark:border-indigo-500/30 px-4 py-2 text-xs font-bold shadow-sm transition-all">
          <span>Admin Panel</span>
        </a>
        @endrole
      </div>
    </div>

    @role('admin|author')
    <section class="grid gap-4 grid-cols-2 sm:grid-cols-3 mb-8">
      <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-4 shadow-sm">
        <p class="text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Total Published Articles</p>
        <p class="text-lg font-extrabold text-slate-900 dark:text-white mt-0.5">{{ $posts->count() }}</p>
      </div>
      <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-4 shadow-sm">
        <p class="text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Saved Bookmarks</p>
        <p class="text-lg font-extrabold text-indigo-600 dark:text-emerald-400 mt-0.5">{{ $bookmarks->count() }}</p>
      </div>
      <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-4 shadow-sm col-span-2 sm:col-span-1">
        <p class="text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Gallery Assets</p>
        <p id="gallery-counter" class="text-lg font-extrabold text-indigo-600 dark:text-emerald-400 mt-0.5">{{ $galleries->count() }}</p>
      </div>
    </section>

    <div class="grid gap-8 lg:grid-cols-3 items-start">

      <div class="lg:col-span-2 space-y-4">
        <div class="flex items-center justify-between">
          <h2 class="text-xs font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
            Your Articles
          </h2>
          <a href="{{ route('create') }}" class="text-xs font-bold text-indigo-600 dark:text-emerald-400 hover:underline flex items-center space-x-1">
            <span>Write New Article</span>
            <span>&rarr;</span>
          </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900/20 transition-colors">
          <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-xs text-slate-500 dark:text-slate-400">
              <thead class="bg-slate-50/70 border-b border-slate-100 text-3xs font-black uppercase tracking-widest text-slate-400 dark:bg-slate-800/10 dark:border-slate-800/60 dark:text-slate-500">
                <tr>
                  <th scope="col" class="px-6 py-4">Article Title</th>
                  <th scope="col" class="px-4 py-4 hidden sm:table-cell">Category</th>
                  <th scope="col" class="px-4 py-4 hidden md:table-cell">Published</th>
                  <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100 dark:divide-slate-800/40 font-medium text-slate-700 dark:text-slate-300">
                @foreach ($posts as $post)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/10 transition-colors">
                  <td class="px-6 py-4">
                    <a href="{{ route('posts.show', $post) }}" class="font-bold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-emerald-400 transition-colors">
                      {{ $post->title }}
                    </a>
                    <span class="text-3xs text-slate-400 font-normal sm:hidden block mt-1">Published {{ $post->published_at ? $post->published_at->format('M j, Y') : 'Draft' }}</span>
                  </td>
                  <td class="px-4 py-4 hidden sm:table-cell">
                    <span class="inline-block rounded-full bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 px-2 py-0.5 text-3xs font-bold uppercase tracking-wider">{{ $post->category->name }}</span>
                  </td>
                  <td class="px-4 py-4 text-3xs font-mono text-slate-400 hidden md:table-cell">{{ $post->published_at ? $post->published_at->format('M j, Y') : '-' }}</td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end space-x-3 text-3xs uppercase tracking-wider font-bold">
                      <a href="{{ route('posts.edit', $post) }}" class="text-slate-400 hover:text-indigo-600 dark:hover:text-emerald-400 transition-colors">
                        Edit
                      </a>
                      <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-slate-400 hover:text-rose-500 transition-colors">
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
      </div>
      @endrole

      <div class="space-y-4">
        <h2 class="text-xs font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
          Saved Bookmarks
        </h2>

        <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-4 shadow-sm space-y-3">
          @forelse ($bookmarks as $bookmark)
          <div class="p-3 rounded-xl bg-slate-50/60 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/60 hover:bg-slate-100/60 dark:hover:bg-slate-800/60 transition-all flex items-center justify-between group">
            <div class="flex items-start space-x-3 min-w-0 flex-grow">
              <div class="text-indigo-500 dark:text-emerald-400 mt-0.5 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                  <path d="M3.75 3A1.75 1.75 0 0 0 2 4.75v12.5A1.25 1.25 0 0 0 3.94 18.3l6.06-4.545 6.06 4.545a1.25 1.25 0 0 0 1.94-1.05V4.75A1.75 1.75 0 0 0 16.25 3H3.75Z" />
                </svg>
              </div>

              <div class="min-w-0">
                <a href="{{ route('posts.show', $bookmark->post->slug) }}" class="text-xs font-bold text-slate-800 dark:text-slate-200 hover:text-indigo-600 dark:hover:text-emerald-400 transition-colors block truncate">
                  {{ $bookmark->post->title }}
                </a>
                <span class="text-3xs text-slate-400 block mt-0.5">
                  By {{ $bookmark->post->user->name }}
                </span>
              </div>
            </div>

            <div class="flex items-center space-x-2 flex-shrink-0 pl-3">
              <a href="{{ route('posts.show', $bookmark->post->slug) }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-50 dark:bg-slate-800 text-indigo-600 dark:text-emerald-400 px-2 py-1 text-3xs font-black uppercase tracking-wider hover:bg-indigo-100 dark:hover:bg-slate-700 transition-colors">
                Read
              </a>
              <form action="{{ route('bookmarks.destroy', $bookmark) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Remove bookmark?')" class="text-slate-400 hover:text-rose-500 transition-colors p-1 rounded-lg hover:bg-slate-100/80 dark:hover:bg-slate-800/80">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>
                </button>
              </form>
            </div>
          </div>
          @empty
          <div class="text-center py-6 text-slate-400 text-xs">
            You have no saved bookmarks.
          </div>
          @endforelse
        </div>
      </div>

    </div>

    @role('admin|author')
    <section class="mt-12 border-t border-slate-200 dark:border-slate-800 pt-8 space-y-4">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xs font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">
            Personal Gallery Space
          </h2>
          <p class="text-3xs text-slate-400 dark:text-slate-500 mt-0.5">Quick front-end preview for organizing your layout inspirations and game captures.</p>
        </div>
        <button type="button" id="open-modal-btn" class="inline-flex items-center space-x-1.5 rounded-xl bg-indigo-600 hover:opacity-90 text-white dark:bg-emerald-400 dark:text-night px-3 py-2 text-xs font-bold shadow-sm transition-all cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
          </svg>
          <span>Add New Photo</span>
        </button>
      </div>

      <div id="gallery-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach($galleries as $gallery)
        <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800/60 bg-white dark:bg-slate-900/20 p-3 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
          <div class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800 relative">
            <a href="{{ asset('storage/'. $gallery->image) }}" target="_blank">
              <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
            </a>
            <span class="absolute top-2.5 left-2.5 px-2 py-0.5 text-[10px] font-bold tracking-wide uppercase rounded-md bg-slate-900/60 text-white backdrop-blur-md border border-white/10 shadow-sm">
              {{ $gallery->is_public ? 'public' : 'private' }}
            </span>
          </div>

          <div class="pt-3 pb-1 px-1 flex flex-col space-y-1 flex-grow">
            <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 dark:text-emerald-400">
              @if($gallery->category)
              <a href="{{ route('articles.index', ['category' => $gallery->category->slug]) }}" class="hover:underline">
                {{ $gallery->category->name }}
              </a>
              @else
              No Category
              @endif
            </span>
            <h3 class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200 truncate group-hover:text-indigo-600 dark:group-hover:text-emerald-400 transition-colors">
              {{ $gallery->title }}
            </h3>
          </div>

          <div class="flex items-center justify-end space-x-1 border-t border-slate-100 dark:border-slate-800/60 pt-2 mt-2">
            <a href="{{ route('gallery.edit', $gallery) }}" class="inline-flex items-center space-x-1 rounded-lg px-2 py-1 text-[11px] font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-emerald-400 dark:hover:bg-emerald-500/10 transition-all duration-200">
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
    @endrole
  </main>

  <div id="add-photo-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 w-full max-w-md shadow-xl transition-colors">
      <h3 class="text-base font-black text-slate-900 dark:text-white mb-4">Add New Gallery Asset</h3>
      <div class="space-y-4">
        <div>
          <label for="img-title" class="block text-3xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Photo Title</label>
          <input type="text" id="img-title" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g., My Setup Workspace" />
        </div>
        <div>
          <label for="img-url" class="block text-3xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Image URL (Optional)</label>
          <input type="url" id="img-url" class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="https://unsplash.com/..." />
        </div>
      </div>
      <div class="flex items-center justify-end space-x-2 mt-6">
        <button type="button" id="close-modal-btn" class="rounded-xl border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 px-4 py-2 text-xs font-bold hover:bg-slate-50 dark:hover:bg-slate-800/60">Cancel</button>
        <button type="button" id="save-photo-btn" class="rounded-xl bg-indigo-600 text-white dark:bg-emerald-400 dark:text-night px-4 py-2 text-xs font-bold hover:opacity-90">Save Asset</button>
      </div>
    </div>
  </div>

  @include('components.footer')

  <script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

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
  </script>

  <script>
    const modal = document.getElementById('add-photo-modal');
    const openModalBtn = document.getElementById('open-modal-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const savePhotoBtn = document.getElementById('save-photo-btn');
    const galleryGrid = document.getElementById('gallery-grid');
    const galleryCounter = document.getElementById('gallery-counter');

    const imgTitleInput = document.getElementById('img-title');
    const imgUrlInput = document.getElementById('img-url');

    // Sync current counter with initial PHP records count safely
    let currentCount = parseInt(galleryCounter ? galleryCounter.textContent : 0) || 0;

    if (openModalBtn) {
      openModalBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    }
    if (closeModalBtn) {
      closeModalBtn.addEventListener('click', closeModal);
    }

    function closeModal() {
      modal.classList.add('hidden');
      imgTitleInput.value = '';
      imgUrlInput.value = '';
    }

    if (savePhotoBtn) {
      savePhotoBtn.addEventListener('click', () => {
        const title = imgTitleInput.value.trim();
        const url = imgUrlInput.value.trim() || 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=600&q=80';

        if (!title) {
          alert('Please enter a title for your photo.');
          return;
        }

        // Build HTML template seamlessly matching existing cards styling
        const newCardHTML = `
          <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800/60 bg-white dark:bg-slate-900/20 p-3 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md animate-fade-in">
            <div class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800 relative">
              <img src="${url}" alt="${title}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" />
              <span class="absolute top-2.5 left-2.5 px-2 py-0.5 text-[10px] font-bold tracking-wide uppercase rounded-md bg-slate-900/60 text-white backdrop-blur-md border border-white/10 shadow-sm">
                public
              </span>
            </div>
            <div class="pt-3 pb-1 px-1 flex flex-col space-y-1 flex-grow">
              <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 dark:text-emerald-400">Preview Asset</span>
              <h3 class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200 truncate group-hover:text-indigo-600 dark:group-hover:text-emerald-400 transition-colors">${title}</h3>
            </div>
            <div class="flex items-center justify-end space-x-1 border-t border-slate-100 dark:border-slate-800/60 pt-2 mt-2 opacity-40 pointer-events-none">
              <span class="text-[10px] italic">Just Added</span>
            </div>
          </div>
        `;

        if (galleryGrid) {
          galleryGrid.insertAdjacentHTML('beforeend', newCardHTML);
        }

        currentCount++;
        if (galleryCounter) {
          galleryCounter.textContent = currentCount;
        }

        closeModal();
      });
    }

    if (modal) {
      modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
      });
    }
  </script>
</body>

</html>