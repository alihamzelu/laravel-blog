<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Author Dashboard - DevBlog</title>
  
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
          <button onclick="handleNewPost()" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 text-sm font-bold shadow-md hover:shadow-lg transition-all dark:bg-emerald-400 dark:text-night dark:hover:bg-emerald-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Write New Post</span>
          </button>
        </div>

      </div>
    </header>

    <section>
      <div class="border-b border-slate-200 dark:border-slate-800 pb-4 mb-6 flex items-center justify-between transition-colors">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
          Your Published Content (<span id="post-counter">3</span>)
        </h2>
      </div>

      <div id="author-posts-grid" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        
        <article id="post-card-1" class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
          <div>
            <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
              <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80" alt="Post thumbnail">
            </div>
            <div class="p-5">
              <span class="inline-block rounded-full bg-indigo-50 text-indigo-700 dark:bg-emerald-500/10 dark:text-emerald-400 px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-2">Engineering</span>
              <h3 class="text-base font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug">Mastering Tailwind CSS Layouts at Scale</h3>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 line-clamp-2">How to effectively structuralize production web platforms using utility grids without element styling bloat.</p>
            </div>
          </div>
          
          <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 dark:border-slate-800/60 bg-slate-50/50 dark:bg-slate-800/20">
            <span class="text-2xs text-slate-400">Oct 12, 2023</span>
            <div class="flex items-center space-x-1">
              <button onclick="handleEditPost(1, 'Mastering Tailwind CSS Layouts at Scale')" class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-emerald-400 dark:hover:bg-emerald-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                <span>Edit</span>
              </button>
              <button onclick="handleDeletePost(1)" class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-rose-600 hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                <span>Delete</span>
              </button>
            </div>
          </div>
        </article>

        <article id="post-card-2" class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
          <div>
            <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
              <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=600&q=80" alt="Post thumbnail">
            </div>
            <div class="p-5">
              <span class="inline-block rounded-full bg-rose-50 text-rose-700 dark:bg-fuchsia-500/10 dark:text-fuchsia-400 px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-2">Design</span>
              <h3 class="text-base font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug">The Power of Dark Mode Layout Design</h3>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 line-clamp-2">Analyzing depth layers, contrasting borders, and micro-interaction parameters across digital surfaces.</p>
            </div>
          </div>
          <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 dark:border-slate-800/60 bg-slate-50/50 dark:bg-slate-800/20">
            <span class="text-2xs text-slate-400">Sep 28, 2023</span>
            <div class="flex items-center space-x-1">
              <button onclick="handleEditPost(2, 'The Power of Dark Mode Layout Design')" class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-emerald-400 dark:hover:bg-emerald-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                <span>Edit</span>
              </button>
              <button onclick="handleDeletePost(2)" class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-rose-600 hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                <span>Delete</span>
              </button>
            </div>
          </div>
        </article>

        <article id="post-card-3" class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 dark:border-slate-800 dark:bg-slate-900/40">
          <div>
            <div class="overflow-hidden aspect-video relative border-b border-slate-100 dark:border-slate-800/60">
              <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="Post thumbnail">
            </div>
            <div class="p-5">
              <span class="inline-block rounded-full bg-amber-50 text-amber-700 dark:bg-cyan-500/10 dark:text-cyan-400 px-2.5 py-0.5 text-2xs font-bold uppercase tracking-wider mb-2">Life</span>
              <h3 class="text-base font-bold text-slate-900 dark:text-white line-clamp-2 leading-snug">Building a Remote Productivity System</h3>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5 line-clamp-2">Strategies on balancing fast engineering context requirements with deep work health intervals.</p>
            </div>
          </div>
          <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 dark:border-slate-800/60 bg-slate-50/50 dark:bg-slate-800/20">
            <span class="text-2xs text-slate-400">Aug 14, 2023</span>
            <div class="flex items-center space-x-1">
              <button onclick="handleEditPost(3, 'Building a Remote Productivity System')" class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-400 dark:hover:text-emerald-400 dark:hover:bg-emerald-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                <span>Edit</span>
              </button>
              <button onclick="handleDeletePost(3)" class="inline-flex items-center space-x-1 rounded-lg px-2.5 py-1.5 text-2xs font-bold text-rose-600 hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                <span>Delete</span>
              </button>
            </div>
          </div>
        </article>

      </div>

      <div id="author-empty-state" class="hidden text-center py-20 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mx-auto text-slate-300 dark:text-slate-700 mb-3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3h-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
        <h3 class="text-base font-bold text-slate-800 dark:text-slate-200">No articles posted yet</h3>
        <p class="text-xs text-slate-400 mt-1">Get started by creating your very first article above.</p>
      </div>
    </section>

  </main>

  @include('components.footer')

  <script>
    let internalPostCount = 3;

    // Simulated Dashboard Event Handlers
    function handleNewPost() {
      alert("Frontend Trigger: Open New Post Composition Modal / Redirect to editor suite.");
    }

    function handleEditPost(id, title) {
      alert(`Frontend Trigger: Editing Post ID [${id}]\n"${title}"`);
    }

    function handleDeletePost(id) {
      if (confirm("Are you sure you want to delete this post?")) {
        const targetCard = document.getElementById(`post-card-${id}`);
        if (targetCard) {
          // Visual fade out transition
          targetCard.classList.add('opacity-0', 'scale-95');
          setTimeout(() => {
            targetCard.remove();
            internalPostCount--;
            document.getElementById('post-counter').textContent = internalPostCount;
            
            // Check if grid is entirely empty
            if (internalPostCount === 0) {
              document.getElementById('author-posts-grid').classList.add('hidden');
              document.getElementById('author-empty-state').classList.remove('hidden');
            }
          }, 200);
        }
      }
    }

    // Navigation & Global Shell Logic
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