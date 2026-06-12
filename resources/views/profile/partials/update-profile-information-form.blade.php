<section>
  <header>
    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Profile Information</h2>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update your account's profile information, email address, job title, and biography.</p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

  {{-- 👈 اتریبیوت enctype برای ارسال فایل به فرم اضافه شد --}}
  <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div>
      <label class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Profile Avatar</label>
      <div class="flex items-center space-x-4">
        
        <div class="flex-shrink-0 h-16 w-16 rounded-full overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
          @if($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
          @else
            <svg class="w-8 h-8 text-slate-400 dark:text-slate-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
          @endif
        </div>

        <div class="flex-1">
          <input type="file" 
                 id="avatar" 
                 name="avatar" 
                 accept="image/*" 
                 class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 hover:file:opacity-90 file:cursor-pointer cursor-pointer bg-slate-50 dark:bg-slate-800/60 border @error('avatar') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl p-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
          @error('avatar') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

      </div>
    </div>

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

    <div>
      <label for="job" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Job Title</label>
      <input type="text" id="job" name="job" value="{{ old('job', $user->job) }}" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('job') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="e.g. Full-Stack Developer" />
      @error('job') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label for="bio" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Biography</label>
      <textarea id="bio" name="bio" rows="4" class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('bio') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all resize-none" placeholder="Tell us about yourself, your skills, or what you write about...">{{ old('bio', $user->bio) }}</textarea>
      @error('bio') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
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