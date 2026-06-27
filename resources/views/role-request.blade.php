<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Request - DevBlog</title>

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
                <span class="text-slate-600 dark:text-slate-300">Role Request</span>
            </div>

            <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white sm:text-3xl">
                Request a New Role
            </h1>

            <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                Request to become an Author or Editor.
            </p>
        </div>

        @if(session('success'))
            <div
                class="mb-6 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:border-emerald-800/30 dark:text-emerald-400 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div
                class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700 dark:bg-red-500/10 dark:border-red-800/30 dark:text-red-400 text-xs font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('role-request.store') }}" method="POST" class="space-y-6">

            @csrf

            <div
                class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 shadow-sm space-y-5">

                <div>
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                        Requested Role
                    </label>

                    <select
                        name="requested_role"
                        class="w-full rounded-xl border @error('requested_role') border-red-500 @else border-slate-200 dark:border-slate-800 @enderror bg-slate-50 dark:bg-slate-950 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">

                        <option value="">Choose a role...</option>

                        @foreach($roles as $role)
                            <option
                                value="{{ $role->name }}"
                                {{ old('requested_role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach

                    </select>

                    @error('requested_role')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                        Why should we approve your request?
                    </label>

                    <textarea
                        name="message"
                        rows="6"
                        class="w-full rounded-xl border @error('message') border-red-500 @else border-slate-200 dark:border-slate-800 @enderror bg-slate-50 dark:bg-slate-950 px-4 py-3 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Tell us about yourself, your experience, why you want this role, or anything that helps us review your request...">{{ old('message') }}</textarea>

                    @error('message')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex justify-end">

                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 hover:bg-indigo-700 dark:bg-emerald-400 dark:hover:bg-emerald-300 dark:text-black text-white px-6 py-3 text-sm font-bold transition">

                    Submit Request

                </button>

            </div>

        </form>

    </main>

    @include('components.footer')

</body>

</html>