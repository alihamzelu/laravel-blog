<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Gallery - DevBlog</title>
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

<body class="bg-slate-50 text-slate-900 transition-colors duration-300 dark:bg-night dark:text-slate-100 font-sans antialiased overflow-x-hidden flex flex-col min-h-screen">

    @include('components.header')

    <main class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8 flex-grow w-full">

        <div class="border-b border-slate-200 dark:border-slate-800 pb-6 mb-8 flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-2 text-3xs uppercase tracking-wider font-bold text-slate-400 dark:text-slate-500 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 dark:hover:text-emerald-400">Dashboard</a>
                    <span>/</span>
                    <span class="text-slate-600 dark:text-slate-300">Create Gallery</span>
                </div>
                <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white sm:text-3xl">Create New Gallery</h1>
                <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Setup a gorgeous visual grid for your project screenshots or design resources.</p>
            </div>
        </div>

        <form class="space-y-6" action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 shadow-sm space-y-4">
                <h2 class="text-xs font-black uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Gallery Information</h2>

                <div class="grid gap-4 sm:grid-cols-4">

                    <div class="sm:col-span-2">
                        <label class="block text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Gallery Title</label>
                        <input name="title" type="text" placeholder="e.g., Resident Evil Concept Arts" class="w-full text-xs font-medium px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 dark:focus:border-emerald-400 transition-colors" />
                    </div>

                    <div class="sm:col-span-1">
                        <label class="block text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Category</label>
                        <select name="category_id" class="w-full text-xs font-medium px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 dark:focus:border-emerald-400 transition-colors">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="block text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Visibility</label>
                        <select name="is_public" class="w-full text-xs font-medium px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 dark:focus:border-emerald-400 transition-colors">
                            <option value="1" selected>Public</option>
                            <option value="0">Private</option>
                        </select>
                    </div>

                </div>

                <div>
                    <label class="block text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Gallery Cover Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl bg-slate-50/30 dark:bg-slate-950/40 hover:bg-slate-100/50 dark:hover:bg-slate-900/30 cursor-pointer transition-colors group relative">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-slate-400 group-hover:text-indigo-600 dark:group-hover:text-emerald-400 transition-colors mb-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <p id="upload-text" class="text-3xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                    <span class="text-indigo-600 dark:text-emerald-400">Upload a cover image</span> or drag and drop
                                </p>
                                <p id="upload-subtext" class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">PNG, JPG or WEBP up to 5MB</p>
                            </div>
                            <input id="gallery-image" name="image" type="file" accept="image/*" class="hidden" onchange="previewFileName()" />
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Description</label>
                    <textarea name="description" rows="4" placeholder="Describe the vibe, assets, or tools used in this gallery..." class="w-full text-xs font-medium px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-500 dark:focus:border-emerald-400 transition-colors resize-none"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ url()->previous() }}">

                    <button type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-900 text-xs font-bold transition-all">
                        Cancel
                    </button>
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:opacity-90 text-white dark:bg-emerald-400 dark:text-night text-xs font-bold shadow-md transition-all">
                    Publish Gallery
                </button>
            </div>

        </form>
    </main>

    @include('components.footer')

    <script>
        function previewFileName() {
            const fileInput = document.getElementById('gallery-image');
            const uploadText = document.getElementById('upload-text');
            const uploadSubtext = document.getElementById('upload-subtext');

            if (fileInput.files && fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                uploadText.innerHTML = `<span class="text-indigo-600 dark:text-emerald-400 font-black">✓ Selected:</span> ${fileName}`;
                uploadSubtext.textContent = "Click again or drop another file to replace";
            } else {
                uploadText.innerHTML = `<span class="text-indigo-600 dark:text-emerald-400">Upload a cover image</span> or drag and drop`;
                uploadSubtext.textContent = "PNG, JPG or WEBP up to 5MB";
            }
        }
    </script>
</body>

</html>