<section>
  <header>
    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Update Password</h2>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ensure your account is using a long, random password to stay secure.</p>
  </header>

  <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')

    <div>
      <label for="update_password_current_password" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Current Password</label>
      <input type="password" id="update_password_current_password" name="current_password" autocomplete="current-password" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('current_password', 'updatePassword') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="••••••••" />
      @error('current_password', 'updatePassword') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="update_password_password" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">New Password</label>
      <input type="password" id="update_password_password" name="password" autocomplete="new-password" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('password', 'updatePassword') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="••••••••" />
      @error('password', 'updatePassword') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="update_password_password_confirmation" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Confirm Password</label>
      <input type="password" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('password_confirmation', 'updatePassword') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="••••••••" />
      @error('password_confirmation', 'updatePassword') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-4 pt-2">
      <button type="submit" class="bg-indigo-600 text-white dark:bg-emerald-500 dark:text-slate-950 font-bold text-sm px-5 py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
        Update Password
      </button>

      @if (session('status') === 'password-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs text-slate-400 dark:text-emerald-400 font-medium">
          Saved.
        </p>
      @endif
    </div>
  </form>
</section>