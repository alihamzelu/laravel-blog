<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creator Dashboard - DevBlog</title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Tailwind Configuration for Dark Mode -->
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

  <!-- Navigation -->

  @include('components.header')

  <!-- Dashboard Container -->
  <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
    
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-slate-200 dark:border-slate-800 pb-6 mb-8 gap-4 transition-colors">
      <div>
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-3xl">Welcome back, Alex</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage your blog articles, customize layouts, and review content performance metrics.</p>
      </div>
      <div class="flex items-center space-x-3">
        <!-- Quick Nav to Preview Mode Page -->
        <a href="{{ route('preview') }}" class="inline-flex items-center space-x-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700/60 text-slate-700 dark:text-slate-200 px-4 py-2.5 text-sm font-bold shadow-sm transition-all">
          <span>View Profile Preview</span>
        </a>
        <!-- Quick Nav to Edit Info Page -->
        <a href="{{ route('profile.edit') }}" class="inline-flex items-center space-x-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white dark:bg-emerald-400 dark:text-night dark:hover:bg-emerald-500 px-4 py-2.5 text-sm font-bold shadow-sm transition-all">
          <span>Edit Profile Settings</span>
        </a>
      </div>
    </div>

    <!-- Analytics Stats Overview Grid -->
    <section class="grid gap-5 grid-cols-2 lg:grid-cols-4 mb-10">
      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 transition-colors">
        <p class="text-2xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Total Views</p>
        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">14.2k</h3>
        <span class="text-2xs text-emerald-500 font-bold mt-1 inline-block">&uarr; 12% this month</span>
      </div>
      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 transition-colors">
        <p class="text-2xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Published Posts</p>
        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">3</h3>
        <span class="text-2xs text-slate-400 dark:text-slate-500 font-medium mt-1 inline-block">No draft items pending</span>
      </div>
      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 transition-colors">
        <p class="text-2xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Avg. Read Time</p>
        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">6.3m</h3>
        <span class="text-2xs text-indigo-500 dark:text-emerald-400 font-medium mt-1 inline-block">Highly engaging depth</span>
      </div>
      <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900/40 transition-colors">
        <p class="text-2xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Profile Followers</p>
        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">842</h3>
        <span class="text-2xs text-emerald-500 font-bold mt-1 inline-block">&uarr; 34 new this week</span>
      </div>
    </section>

    <!-- Content Management Block -->
    <section>
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
          Your Articles
        </h2>
        <button class="text-xs font-bold text-indigo-600 dark:text-emerald-400 hover:underline">
          Create New Article &rarr;
        </button>
      </div>

      <!-- Desktop Table / Responsive Cards Layout Wrapper -->
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
              
              <!-- Row 1 -->
              <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/40 transition-colors">
                <td class="px-6 py-4">
                  <span class="font-bold text-slate-900 dark:text-white block truncate max-w-xs sm:max-w-md">Mastering Tailwind CSS Layouts at Scale</span>
                  <span class="text-2xs text-slate-400 font-medium sm:hidden block mt-0.5">Engineering &bull; Oct 12, 2023</span>
                </td>
                <td class="px-6 py-4 hidden sm:table-cell">
                  <span class="inline-block rounded-full bg-indigo-50 text-indigo-700 dark:bg-emerald-500/10 dark:text-emerald-400 px-2 py-0.5 text-2xs font-bold uppercase">Engineering</span>
                </td>
                <td class="px-6 py-4 text-xs font-normal text-slate-400 hidden md:table-cell">Oct 12, 2023</td>
                <td class="px-6 py-4 text-right text-xs">
                  <div class="flex items-center justify-end space-x-3">
                    <button class="text-indigo-600 dark:text-emerald-400 font-bold hover:underline">Edit</button>
                    <button class="text-rose-600 font-bold hover:underline">Delete</button>
                  </div>
                </td>
              </tr>

              <!-- Row 2 -->
              <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/40 transition-colors">
                <td class="px-6 py-4">
                  <span class="font-bold text-slate-900 dark:text-white block truncate max-w-xs sm:max-w-md">The Power of Dark Mode Layout Design</span>
                  <span class="text-2xs text-slate-400 font-medium sm:hidden block mt-0.5">Design &bull; Sep 28, 2023</span>
                </td>
                <td class="px-6 py-4 hidden sm:table-cell">
                  <span class="inline-block rounded-full bg-rose-50 text-rose-700 dark:bg-fuchsia-500/10 dark:text-fuchsia-400 px-2 py-0.5 text-2xs font-bold uppercase">Design</span>
                </td>
                <td class="px-6 py-4 text-xs font-normal text-slate-400 hidden md:table-cell">Sep 28, 2023</td>
                <td class="px-6 py-4 text-right text-xs">
                  <div class="flex items-center justify-end space-x-3">
                    <button class="text-indigo-600 dark:text-emerald-400 font-bold hover:underline">Edit</button>
                    <button class="text-rose-600 font-bold hover:underline">Delete</button>
                  </div>
                </td>
              </tr>

              <!-- Row 3 -->
              <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/40 transition-colors">
                <td class="px-6 py-4">
                  <span class="font-bold text-slate-900 dark:text-white block truncate max-w-xs sm:max-w-md">Building a Remote Productivity System</span>
                  <span class="text-2xs text-slate-400 font-medium sm:hidden block mt-0.5">Life &bull; Aug 14, 2023</span>
                </td>
                <td class="px-6 py-4 hidden sm:table-cell">
                  <span class="inline-block rounded-full bg-amber-50 text-amber-700 dark:bg-cyan-500/10 dark:text-cyan-400 px-2 py-0.5 text-2xs font-bold uppercase">Life</span>
                </td>
                <td class="px-6 py-4 text-xs font-normal text-slate-400 hidden md:table-cell">Aug 14, 2023</td>
                <td class="px-6 py-4 text-right text-xs">
                  <div class="flex items-center justify-end space-x-3">
                    <button class="text-indigo-600 dark:text-emerald-400 font-bold hover:underline">Edit</button>
                    <button class="text-rose-600 font-bold hover:underline">Delete</button>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>

  <!-- Script Engine for Dark/Light Themes -->
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