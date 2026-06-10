<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - DevBlog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { night: '#0B1120' } } } }
  </script>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto w-full sm:max-w-md px-4">
    <div class="text-center mb-6">
      <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Reset Password</h2>
      <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
        Forgot your password? No problem. Enter your email to get a reset link.
      </p>
    </div>

    @if (session('status'))
      <div class="mb-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl p-4 text-sm font-medium">
        {{ session('status') }}
      </div>
    @endif

    <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-8 shadow-sm transition-colors">
      <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label for="email" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Email Address</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-slate-50 dark:bg-slate-800/60 border @error('email') border-red-500 @else border-slate-200 dark:border-slate-700 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" placeholder="you@example.com" />
          @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
          Email Password Reset Link
        </button>

        <div class="text-center pt-2">
          <a href="{{ route('login') }}" class="text-xs font-bold text-slate-400 hover:text-indigo-600 dark:hover:text-emerald-400 transition-colors">
            &larr; Back to Log in
          </a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>