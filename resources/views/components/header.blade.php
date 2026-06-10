<!-- Universal Header Component for Laravel Blade -->
<nav class="sticky top-0 z-50 border-b backdrop-blur-md dark:border-slate-800 dark:bg-night/80 transition-colors duration-300">
  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      <!-- Left Section: Logo & Main Navigation -->
      <div class="flex items-center space-x-8">
        <a href="" class="text-2xl font-black tracking-tight text-indigo-600 dark:text-emerald-400">
          DevBlog.
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-6">
          <a href="{{ route("home") }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400 transition-colors">Home</a>

          <!-- CATEGORIES HOVER DROPDOWN -->
          <div class="relative group">
            <a href="{{ route('categories.categories') }}">

              <button class="flex items-center space-x-1 text-sm font-medium text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400 transition-colors py-2">
                <span>Categories</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 group-hover:rotate-180 transition-transform duration-200">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </button>

            </a>


            <!-- Dropdown Menu Item List (Pure CSS Hover) -->
            <div class="absolute left-0 mt-0 w-44 hidden group-hover:block pt-2 origin-top-left rounded-xl focus:outline-none z-50">
              <div class="rounded-xl border border-slate-200 bg-white py-1 shadow-lg dark:border-slate-800 dark:bg-slate-900">
                @foreach ($categories as $category)

                <a href="{{ route('articles.index', ['category' => $category->slug]) }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">{{ $category->name }}</a>

                @endforeach
              </div>
            </div>
          </div>
          <a href="{{ route('articles.index') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400 transition-colors">Articles</a>

        </div>
      </div>

      <!-- Right Section: Actions & User Dropdown -->
      <div class="flex items-center space-x-4">

        <!-- Theme Toggle Button -->
        <button id="global-theme-toggle" class="rounded-full p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 transition-colors duration-200">
          <svg id="theme-toggle-light-icon" class="hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.32a1 1 0 011.415 0l.708.708a1 1 0 01-1.414 1.414l-.708-.708a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-2.32 4.22a1 1 0 010 1.415l-.708.708a1 1 0 01-1.414-1.414l.708-.708a1 1 0 011.414 0zM10 18a1 1 0 01-1-1v-1a1 1 0 112 0v1a1 1 0 01-1 1zm-4.22-2.32a1 1 0 01-1.415 0l-.708-.708a1 1 0 011.414-1.414l.708.708a1 1 0 010 1.414zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.32-4.22a1 1 0 010-1.415l.708-.708a1 1 0 011.414 1.414l-.708.708a1 1 0 01-1.414 0z"></path>
            <path d="M10 6a4 4 0 100 8 4 4 0 000-8z"></path>
          </svg>
          <svg id="theme-toggle-dark-icon" class="hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
        </button>

        <!-- Profile Avatar & Menu Dropdown -->
        <div class="relative">
          <button id="profile-menu-button" class="flex rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all">
            <img class="h-8 w-8 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User avatar">
          </button>

          <!-- Dropdown Card (Click trigger via JS) -->
          <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 origin-top-right rounded-xl border border-slate-200 bg-white py-1 shadow-lg dark:border-slate-800 dark:bg-slate-900 focus:outline-none transition-all">

            <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800">
              <p class="text-xs text-slate-400">Welcome</p>
              <p class="text-sm font-bold text-slate-700 dark:text-slate-200 truncate">
                {{ Auth::user()->name }}
              </p>
            </div>

            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
              Dashboard
            </a>

            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">
              Edit Profile
            </a>

            <hr class="border-slate-100 dark:border-slate-800 my-1">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="block w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10">
                    Sign Out
                </button>
            </form>

          </div>
        </div>

        <!-- Mobile Menu Hamburger Button -->
        <button id="mobile-menu-button" class="rounded-xl p-2 md:hidden text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

      </div>
    </div>
  </div>

  <!-- Mobile Dropdown Panel -->
  <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-night px-4 pt-2 pb-4 space-y-1">
    <a href="/dashboard" class="block rounded-xl px-3 py-2 text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">Dashboard</a>
    <div class="px-3 py-2 text-xs font-bold uppercase tracking-wider text-slate-400">Categories</div>
    <a href="/categories/engineering" class="block rounded-xl pl-6 pr-3 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Engineering</a>
    <a href="/categories/design" class="block rounded-xl pl-6 pr-3 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Design</a>
    <a href="/categories/life" class="block rounded-xl pl-6 pr-3 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">Life</a>
    <a href="/posts/create" class="block rounded-xl px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">Create Post</a>
  </div>
</nav>

<!-- Component Interaction Script -->
<script>
  // 1. Color Theme Manager (Dark / Light Mode)
  const themeToggleBtn = document.getElementById('global-theme-toggle');
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

  // 2. Profile Dropdown Control Toggle
  const profileBtn = document.getElementById('profile-menu-button');
  const profileDropdown = document.getElementById('profile-dropdown');

  profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('hidden');
  });

  // 3. Mobile Hamburger Menu Toggle
  const mobileBtn = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    mobileMenu.classList.toggle('hidden');
  });

  // Close open layers on external viewport click events
  document.addEventListener('click', () => {
    profileDropdown.classList.add('hidden');
    mobileMenu.classList.add('hidden');
  });
</script>