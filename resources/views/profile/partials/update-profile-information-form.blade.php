<section>
  <header>
    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Profile Information</h2>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update your account's profile information and email address.</p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

  <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div>
      <label for="name" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Name</label>
      <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('name') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
      @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="email" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Email Address</label>
      <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('email') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
      @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-3 bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 p-3 rounded-xl text-xs">
          Your email address is unverified.
          <button form="send-verification" class="font-bold underline hover:opacity-80 ml-1">Click here to re-send the verification email.</button>
          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 font-medium text-emerald-600 dark:text-emerald-400">A new verification link has been sent to your email address.</p>
          @endif
        </div>
      @endif
    </div>

    <div class="flex items-center gap-4 pt-2">
      <button type="submit" class="bg-indigo-600 text-white dark:bg-emerald-500 dark:text-slate-950 font-bold text-sm px-5 py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
        Save Changes
      </button>

      @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs text-slate-400 dark:text-emerald-400 font-medium">
          Saved.
        </p>
      @endif
    </div>
  </form>
</section>