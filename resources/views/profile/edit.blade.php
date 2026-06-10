<x-app-layout>
  @include('components.header')

  <div class="py-12 bg-slate-50 text-slate-900 dark:bg-[#0B1120] dark:text-slate-100 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      
      <div class="px-4 sm:px-0 mb-4">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Account Settings</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage your profile information, password security, and account status.</p>
      </div>

      <div class="p-6 sm:p-8 bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 shadow-sm rounded-2xl transition-colors">
        <div class="max-w-xl">
          @include('profile.partials.update-profile-information-form')
        </div>
      </div>

      <div class="p-6 sm:p-8 bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 shadow-sm rounded-2xl transition-colors">
        <div class="max-w-xl">
          @include('profile.partials.update-password-form')
        </div>
      </div>

      <div class="p-6 sm:p-8 bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800 shadow-sm rounded-2xl transition-colors">
        <div class="max-w-xl">
          @include('profile.partials.delete-user-form')
        </div>
      </div>

    </div>
  </div>
</x-app-layout>