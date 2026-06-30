<nav class="sticky top-0 z-50 border-b backdrop-blur-md dark:border-slate-800 dark:bg-night/80 transition-colors duration-300">
  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      <div class="flex items-center space-x-8">
        <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight text-indigo-600 dark:text-emerald-400">
          SimpleBlog.
        </a>

        <div class="hidden md:flex items-center space-x-6">
          <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-indigo-600 dark:text-emerald-400' : 'text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400' }} text-sm font-semibold transition-colors">Home</a>

          <div class="relative group">
            <a href="{{ route('categories.categories') }}">
              <button class="flex items-center space-x-1 text-sm font-medium transition-colors py-2 {{ request()->is('categories*') ? 'text-indigo-600 dark:text-emerald-400' : 'text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400' }}">
                <span>Categories</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 group-hover:rotate-180 transition-transform duration-200">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </button>
            </a>

            <div class="absolute left-0 mt-0 w-44 hidden group-hover:block pt-2 origin-top-left rounded-xl focus:outline-none z-50">
              <div class="rounded-xl border border-slate-200 bg-white py-1 shadow-lg dark:border-slate-800 dark:bg-slate-900">
                @foreach ($categories as $category)
                  <a href="{{ route('articles.index', ['category' => $category->slug]) }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">{{ $category->name }}</a>
                @endforeach
              </div>
            </div>
          </div>

          <a href="{{ route('articles.index') }}" class="{{ request()->is('articles*') ? 'text-indigo-600 dark:text-emerald-400' : 'text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400' }} text-sm font-semibold transition-colors">Articles</a>
          <a href="{{ route('galleries.index') }}" class="{{ request()->is('galleries*') ? 'text-indigo-600 dark:text-emerald-400' : 'text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400' }} text-sm font-semibold transition-colors">Gallery</a>
          <a href="{{ route('role-request.index') }}" class="{{ request()->is('role-request*') ? 'text-indigo-600 dark:text-emerald-400' : 'text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400' }} text-sm font-semibold transition-colors">Role Request</a>
          <a href="{{ route('donate.donors') }}" class="{{ request()->is('donate*') ? 'text-indigo-600 dark:text-emerald-400' : 'text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-emerald-400' }} text-sm font-semibold transition-colors">Donate</a>
        </div>
      </div>

      <div class="flex items-center space-x-3">

        <button id="global-theme-toggle" class="rounded-full p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 transition-colors duration-200 focus:outline-none">
          <svg id="theme-toggle-light-icon" class="hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.32a1 1 0 011.415 0l.708.708a1 1 0 01-1.414 1.414l-.708-.708a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-2.32 4.22a1 1 0 010 1.415l-.708.708a1 1 0 01-1.414-1.414l.708-.708a1 1 0 011.414 0zM10 18a1 1 0 01-1-1v-1a1 1 0 112 0v1a1 1 0 01-1 1zm-4.22-2.32a1 1 0 01-1.415 0l-.708-.708a1 1 0 011.414-1.414l.708.708a1 1 0 010 1.414zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.32-4.22a1 1 0 010-1.415l.708-.708a1 1 0 011.414 1.414l-.708.708a1 1 0 01-1.414 0z"></path>
            <path d="M10 6a4 4 0 100 8 4 4 0 000-8z"></path>
          </svg>
          <svg id="theme-toggle-dark-icon" class="hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
        </button>

        <div class="relative">
          <button id="notification-menu-button" class="rounded-full p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 transition-colors duration-200 relative focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
            @auth
              <span id="notification-badge" class="absolute top-1.5 right-1.5 flex h-2 w-2 {{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'hidden' }}">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 dark:bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600 dark:bg-emerald-400"></span>
              </span>
            @endauth
          </button>

          <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-64 origin-top-right rounded-xl border border-slate-200 bg-white py-1.5 shadow-lg dark:border-slate-800 dark:bg-slate-900 focus:outline-none z-50">
            <div class="px-4 py-1.5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center gap-2">
              <span class="text-xs font-bold text-slate-800 dark:text-slate-200">Notifications</span>
              @auth
                <div class="flex items-center space-x-2 space-x-reverse">
                  <span id="notification-count" class="text-[9px] bg-indigo-50 text-indigo-600 dark:bg-emerald-500/10 dark:text-emerald-400 px-1.5 py-0.5 rounded-md font-bold {{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'hidden' }}">
                    {{ auth()->user()->unreadNotifications->count() }} New
                  </span>
                  <button id="mark-all-read-btn" class="text-[10px] text-indigo-600 dark:text-emerald-400 hover:underline font-semibold cursor-pointer {{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'hidden' }}">
                    Mark all read
                  </button>
                </div>
              @endauth
            </div>
            
            <div id="notification-list" class="max-h-60 overflow-y-auto divide-y divide-slate-100 dark:divide-slate-800/40">
              @auth
                @forelse(auth()->user()->unreadNotifications as $notification)
                  <div data-id="{{ $notification->id }}" class="notification-item p-3 text-3xs text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-all duration-300 flex justify-between items-start gap-2">
                    <div class="flex-1">
                      <p class="font-medium text-slate-800 dark:text-slate-200 leading-normal">{{ $notification->data['message'] ?? 'New updates pending.' }}</p>
                      <span class="text-[9px] text-slate-400 dark:text-slate-500 block mt-1">{{ $notification->created_at?->diffForHumans() }}</span>
                    </div>
                    <button class="mark-single-read p-1 text-slate-400 hover:text-indigo-600 dark:hover:text-emerald-400 rounded transition-colors" title="Mark as read">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </button>
                  </div>
                @empty
                  <div id="no-notifications" class="p-4 text-center text-xs text-slate-400 dark:text-slate-500">
                    All caught up! 🎉
                  </div>
                @endforelse
              @else
                <div class="p-4 text-center text-xs text-slate-400 dark:text-slate-500">
                  Please <a href="{{ route('login') }}" class="text-indigo-600 dark:text-emerald-400 font-bold hover:underline">Login</a> to see alerts.
                </div>
              @endauth
            </div>
          </div>
        </div>

        <div class="relative">
          <button id="profile-menu-button" class="flex rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all">
            @if(auth()->check())
                <img class="h-8 w-8 rounded-full object-cover"
                    src="{{ auth()->user()->profile?->avatar ? asset('storage/' . auth()->user()->profile->avatar) : asset('storage/images/default-avatar.png') }}" alt="Avatar">
            @else
              <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/images/default-avatar.png') }}" alt="Default Avatar">
            @endif
          </button>
          
          <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 origin-top-right rounded-xl border border-slate-200 bg-white py-1 shadow-lg dark:border-slate-800 dark:bg-slate-900 focus:outline-none z-50">
            <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800">
              <p class="text-xs text-slate-400">Welcome</p>
              <p class="text-sm font-bold text-slate-700 dark:text-slate-200 truncate">
                @auth {{ Auth::user()->name }} @else guest @endauth
              </p>
            </div>

            @auth
              <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">Dashboard</a>
              <hr class="border-slate-100 dark:border-slate-800 my-1">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">Edit Profile</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10 cursor-pointer">
                  Sign Out
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">Login</a>
              <hr class="border-slate-100 dark:border-slate-800 my-1">
              <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800/50">Register</a>
            @endauth
          </div>
        </div>

        <button id="mobile-menu-button" class="rounded-xl p-2 md:hidden text-slate-500 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

      </div>
    </div>
  </div>

  <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-night px-4 pt-2 pb-4 space-y-1">
    @auth
      <a href="{{ route('dashboard') }}" class="block rounded-xl px-3 py-2 text-base font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">Dashboard</a>
    @endauth
    
    <div class="px-3 py-2 text-xs font-bold uppercase tracking-wider text-slate-400">Categories</div>
    @foreach ($categories as $category)
      <a href="{{ route('articles.index', ['category' => $category->slug]) }}" class="block rounded-xl pl-6 pr-3 py-1.5 text-sm text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">{{ $category->name }}</a>
    @endforeach
    
    <div class="border-t border-slate-100 dark:border-slate-800/60 my-2 pt-2"></div>
    <a href="{{ route('articles.index') }}" class="block rounded-xl px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">Articles</a>
    <a href="{{ route('galleries.index') }}" class="block rounded-xl px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">Gallery</a>
    <a href="{{ route('role-request.index') }}" class="block rounded-xl px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">Role Request</a>
    <a href="{{ route('donate.donors') }}" class="block rounded-xl px-3 py-2 text-base font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">Donate</a>
  </div>
</nav>

<script>
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

  const profileBtn = document.getElementById('profile-menu-button');
  const profileDropdown = document.getElementById('profile-dropdown');
  const notificationBtn = document.getElementById('notification-menu-button');
  const notificationDropdown = document.getElementById('notification-dropdown');
  const mobileBtn = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('hidden');
    notificationDropdown.classList.add('hidden');
  });

  notificationBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    notificationDropdown.classList.toggle('hidden');
    profileDropdown.classList.add('hidden'); 
    
    // در این حالت نشانگرها با کلیک مخفی نمی‌شوند تا کاربر خودش مدیریت کند (اختیاری)
  });

  mobileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    mobileMenu.classList.toggle('hidden');
  });

  document.addEventListener('click', () => {
    profileDropdown.classList.add('hidden');
    notificationDropdown.classList.add('hidden');
    mobileMenu.classList.add('hidden');
  });

  // --- کدهای مدیریت عملیات نوتیفیکیشن‌ها ---
  @auth
    const listContainer = document.getElementById('notification-list');
    const badge = document.getElementById('notification-badge');
    const countBadge = document.getElementById('notification-count');
    const markAllBtn = document.getElementById('mark-all-read-btn');

    // تابع کمکی برای نمایش وضعیت "خالی بودن"
    function checkEmptyState() {
      const items = listContainer.querySelectorAll('.notification-item');
      if (items.length === 0) {
        listContainer.innerHTML = `<div id="no-notifications" class="p-4 text-center text-xs text-slate-400 dark:text-slate-500">All caught up! 🎉</div>`;
        if (badge) badge.classList.add('hidden');
        if (countBadge) countBadge.classList.add('hidden');
        if (markAllBtn) markAllBtn.classList.add('hidden');
      }
    }

    // ۱. خوانده شدن تکی نوتیفیکیشن‌ها
    listContainer.addEventListener('click', function(e) {
      const button = e.target.closest('.mark-single-read');
      if (!button) return;

      const item = button.closest('.notification-item');
      const notifId = item.getAttribute('data-id');

      if (!notifId) {
        // اگر نوتیفیکیشن تازه و لایو آمده بود و شناسه دیتابیس نداشت، فقط در فرانت حذف شود
        item.classList.add('opacity-0', 'scale-95');
        setTimeout(() => { item.remove(); checkEmptyState(); }, 300);
        return;
      }

      fetch(`/notifications/${notifId}/mark-as-read`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          item.classList.add('opacity-0', 'scale-95');
          setTimeout(() => {
            item.remove();
            checkEmptyState();
          }, 300);
        }
      }).catch(err => console.error(err));
    });

    // ۲. خوانده شدن همه‌ی نوتیفیکیشن‌ها به صورت یکجا
    if (markAllBtn) {
      markAllBtn.addEventListener('click', function() {
        fetch('/notifications/mark-as-read', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            const items = listContainer.querySelectorAll('.notification-item');
            items.forEach(item => item.classList.add('opacity-0', 'scale-95'));
            setTimeout(() => {
              listContainer.innerHTML = `<div id="no-notifications" class="p-4 text-center text-xs text-slate-400 dark:text-slate-500">All caught up! 🎉</div>`;
              if (badge) badge.classList.add('hidden');
              if (countBadge) countBadge.classList.add('hidden');
              markAllBtn.classList.add('hidden');
            }, 300);
          }
        }).catch(err => console.error(err));
      });
    }

    // ۳. گوش دادن به نوتیفیکیشن‌های زنده (Laravel Echo)
    const userId = "{{ auth()->id() }}";
    if (typeof window.Echo !== 'undefined') {
      window.Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
          const noNotifElem = document.getElementById('no-notifications');
          if (noNotifElem) noNotifElem.remove();

          const newNotif = document.createElement('div');
          newNotif.setAttribute('data-id', notification.id || ''); // شناسه اختصاصی نوتیف لایو در صورت وجود
          newNotif.className = "notification-item p-3 text-3xs text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-all duration-300 flex justify-between items-start gap-2";
          
          newNotif.innerHTML = `
            <div class="flex-1">
              <p class="font-medium text-slate-800 dark:text-slate-200 leading-normal">${notification.message || 'New updates pending.'}</p>
              <span class="text-[9px] text-slate-400 dark:text-slate-500 block mt-1">Just now</span>
            </div>
            <button class="mark-single-read p-1 text-slate-400 hover:text-indigo-600 dark:hover:text-emerald-400 rounded transition-colors" title="Mark as read">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
              </svg>
            </button>
          `;

          listContainer.insertBefore(newNotif, listContainer.firstChild);

          if (badge) badge.classList.remove('hidden');
          if (markAllBtn) markAllBtn.classList.remove('hidden');
        });
    }
  @endauth
</script>