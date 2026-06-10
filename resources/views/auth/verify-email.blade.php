<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify Email - DevBlog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class', theme: { extend: { colors: { night: '#0B1120' } } } }
  </script>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto w-full sm:max-w-md px-4">
    
    <div class="mx-auto w-16 h-16 bg-indigo-50 text-indigo-600 dark:bg-emerald-500/10 dark:text-emerald-400 rounded-2xl flex items-center justify-center mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
    </div>

    <div class="text-center mb-6">
      <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Verify Your Email</h2>
      <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 px-2">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
      </p>
    </div>

    @if (session('status') == 'verification-link-sent')
      <div class="mb-5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl p-4 text-xs font-medium text-center">
        A new verification link has been sent to the email address you provided during registration.
      </div>
    @endif

    <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 shadow-sm transition-colors flex flex-col sm:flex-row items-center justify-between gap-4">
      
      <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
        @csrf
        <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold text-sm px-5 py-2.5 rounded-xl hover:opacity-95 transition-all shadow-sm">
          Resend Verification Email
        </button>
      </form>

      <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
        @csrf
        <button type="submit" class="text-xs font-bold text-slate-400 hover:text-red-500 dark:hover:text-red-400 transition-colors uppercase tracking-wider">
          Log Out
        </button>
      </form>
      
    </div>
  </div>

</body>
</html>