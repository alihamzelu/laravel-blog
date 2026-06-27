<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donors</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            night: '#0B1120',
          }
        },
      },
    }
  </script>
</head>

<body class="bg-slate-50 text-slate-900 transition-colors duration-300 dark:bg-night dark:text-slate-100 font-sans antialiased overflow-x-hidden">

  @include("components.header")

  <main class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-16 flex-wrap gap-6">

      <div class="text-center md:text-left">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl text-slate-900 dark:text-white">
          Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-emerald-400 dark:to-cyan-400">
            Donors
          </span>
        </h1>

        <p class="mt-4 text-lg text-slate-500 dark:text-slate-400 max-w-2xl">
          People who supported this project ❤️
        </p>
      </div>

      <a href="/donate"
         class="inline-flex items-center px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold transition dark:bg-emerald-400 dark:hover:bg-emerald-300 dark:text-black">
        Support This Project ❤️
      </a>

    </div>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

      @foreach ($donations as $donation)

      <div class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-200 hover:-translate-y-1.5 hover:shadow-xl dark:bg-slate-800/50 dark:ring-slate-700 dark:hover:ring-emerald-500/50">

        <div class="p-6 flex flex-col gap-4">

          <div class="flex items-center space-x-3">

            <img class="h-10 w-10 rounded-full"
              src="{{ $donation->user?->profile?->avatar ? asset('storage/' . $donation->user->profile->avatar) : asset('images/default-avatar.png') }}"
              alt="Donor">

            <div>
              <h3 class="text-sm font-bold text-slate-900 dark:text-white">
                {{ $donation->user?->name ?? 'Anonymous' }}
              </h3>

              <p class="text-xs text-slate-500 dark:text-slate-400">
                Just supported ❤️
              </p>
            </div>

          </div>

          <div class="mt-2">
            <p class="text-2xl font-extrabold text-indigo-600 dark:text-emerald-400">
              {{ number_format($donation->amount) }} Toman
            </p>

            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
              {{ $donation->created_at->format('Y-m-d') }}
            </p>
          </div>

          <div>
            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
              Successful Donation
            </span>
          </div>

        </div>
      </div>

      @endforeach

    </div>

  </main>

  @include('components.footer')

</body>
</html>