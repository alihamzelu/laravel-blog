<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - DevBlog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { night: '#0B1120' } } } }
  </script>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto w-full sm:max-w-md px-4">
    <div class="text-center mb-6">
      <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Welcome Back</h2>
      <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
        Don't have an account? 
        <a href="{{ route('register') }}" class="font-bold text-indigo-600 dark:text-emerald-400 hover:underline">Register here</a>
      </p>
    </div>

    <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-8 shadow-sm transition-colors">
      <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label for="email" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Email Address</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('email') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="you@example.com" />
          @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="password" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Password</label>
          <input type="password" id="password" name="password" required class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('password') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="••••••••" />
          @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center space-x-2 cursor-pointer select-none">
            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 dark:text-emerald-400 focus:ring-0 bg-slate-50 dark:bg-slate-800" />
            <span class="text-slate-500 dark:text-slate-400 text-xs font-medium">Remember me</span>
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-xs font-bold text-indigo-600 dark:text-emerald-400 hover:underline">Forgot password?</a>
          @endif
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
          Sign In
        </button>
      </form>
    </div>
  </div>

</body>
</html>