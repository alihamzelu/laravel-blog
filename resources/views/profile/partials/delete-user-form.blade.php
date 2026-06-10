<section class="space-y-6">
  <header>
    <h2 class="text-lg font-bold text-red-600 dark:text-red-400">Delete Account</h2>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
  </header>

  <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl hover:bg-red-700 transition-all shadow-sm">
    Delete Account
  </button>

  <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl">
      @csrf
      @method('delete')

      <h2 class="text-lg font-bold text-slate-900 dark:text-white">Are you sure you want to delete your account?</h2>
      <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Please enter your password to confirm you would like to permanently delete your account.</p>

      <div class="mt-6">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('password', 'userDeletion') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all" placeholder="Enter your password to confirm" />
        @error('password', 'userDeletion') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="mt-6 flex justify-end gap-3">
        <button type="button" x-on:click="$dispatch('close')" class="bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 font-bold text-sm px-4 py-2.5 rounded-xl hover:opacity-90 transition-all">
          Cancel
        </button>

        <button type="submit" class="bg-red-600 text-white font-bold text-sm px-4 py-2.5 rounded-xl hover:bg-red-700 transition-all shadow-sm">
          Delete Account Permanently
        </button>
      </div>
    </form>
  </x-modal>
</section>