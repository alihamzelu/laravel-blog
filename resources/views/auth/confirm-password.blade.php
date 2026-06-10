<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Password - DevBlog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { night: '#0B1120' } } } }
  </script>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto w-full sm:max-w-md px-4">
    <div class="text-center mb-6">
      <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">Secure Area</h2>
      <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
        This is a secure area of the application. Please confirm your password before continuing.
      </p>
    </div>

    <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-8 shadow-sm transition-colors">
      <form action="{{ route('password.confirm') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label for="password" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Password</label>
          <input type="password" id="password" name="password" required autocomplete="current-password" autofocus class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('password') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="••••••••" />
          @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
          Confirm Password
        </button>
      </form>
    </div>
  </div>

</body>
</html>