<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <title>Donation Failed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 dark:bg-slate-900 flex items-center justify-center min-h-screen">

    <div class="text-center p-10 bg-white dark:bg-slate-800 rounded-2xl shadow-lg">

        <h1 class="text-2xl font-bold text-red-500 mb-4">
            Payment Failed ❌
        </h1>

        <p class="text-slate-600 dark:text-slate-300">
            Your payment was not completed. Please try again.
        </p>

        <a href="{{ route('donate.donors') }}"
           class="inline-block mt-6 px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
            Try Again
        </a>

    </div>

</body>
</html>