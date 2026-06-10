<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Password - DevBlog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { night: '#0B1120' } } } }
  </script>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto w-full sm:max-w-md px-4">
    <div class="text-center mb-6">
      <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Set New Password</h2>
      <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
        Choose a strong password to secure your account.
      </p>
    </div>

    <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-8 shadow-sm transition-colors">
      <form action="{{ route('password.store') }}" method="POST" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
          <label for="email" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Email Address</label>
          <input type="checkbox" class="hidden" checked disabled />
          <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('email') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
          @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="password" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">New Password</label>
          <input type="password" id="password" name="password" required class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('password') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="••••••••" />
          @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="password_confirmation" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Confirm New Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="••••••••" />
          @error('password_confirmation') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
          Reset Password
        </button>
      </form>
    </div>
  </div>

</body>
</html>