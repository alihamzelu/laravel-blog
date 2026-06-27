<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - DevBlog</title>

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

<body
    class="bg-slate-50 text-slate-900 transition-colors duration-300 dark:bg-night dark:text-slate-100 font-sans antialiased overflow-x-hidden flex flex-col min-h-screen">

    @include('components.header')

    <main class="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:px-8 flex-grow w-full">

        <div class="border-b border-slate-200 dark:border-slate-800 pb-6 mb-8">

            <div class="flex items-center space-x-2 text-3xs uppercase tracking-wider font-bold text-slate-400 dark:text-slate-500 mb-1">
                <a href="/" class="hover:text-indigo-600 dark:hover:text-emerald-400">Home</a>
                <span>/</span>
                <span class="text-slate-600 dark:text-slate-300">Donate</span>
            </div>

            <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white sm:text-3xl">
                Support the Developer ❤️
            </h1>

            <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                If you like this blog, you can support its development.
            </p>

        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:border-emerald-800/30 dark:text-emerald-400 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700 dark:bg-red-500/10 dark:border-red-800/30 dark:text-red-400 text-xs font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <form action="/donate/pay" method="POST" class="space-y-6">

            @csrf

            <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 shadow-sm space-y-6">

                <!-- Amount -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                        Select Amount
                    </label>

                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="amount" value="10000" class="hidden peer" checked>
                            <div class="peer-checked:bg-indigo-600 peer-checked:text-white border border-slate-200 dark:border-slate-800 rounded-xl p-3 text-center text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                10K
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="amount" value="50000" class="hidden peer">
                            <div class="peer-checked:bg-indigo-600 peer-checked:text-white border border-slate-200 dark:border-slate-800 rounded-xl p-3 text-center text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                50K
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="amount" value="100000" class="hidden peer">
                            <div class="peer-checked:bg-indigo-600 peer-checked:text-white border border-slate-200 dark:border-slate-800 rounded-xl p-3 text-center text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                100K
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Custom Message (Optional) -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                        Message (Optional)
                    </label>

                    <textarea
                        name="message"
                        rows="4"
                        class="w-full rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 px-4 py-3 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Write a message..."></textarea>
                </div>

            </div>

            <!-- Submit -->
            <div class="flex justify-end">

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 hover:bg-indigo-700 dark:bg-emerald-400 dark:hover:bg-emerald-300 dark:text-black text-white px-6 py-3 text-sm font-bold transition">

                    Donate Now ❤️

                </button>

            </div>

        </form>

    </main>

    @include('components.footer')

</body>

</html>