<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post: {{ $post->title }} - DevBlog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        night: '#0B1120'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-900 dark:bg-night dark:text-slate-100 font-sans antialiased min-h-screen transition-colors duration-200">

    @include('components.header')

    <main class="max-w-5xl mx-auto px-4 py-12">

        <div class="mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Edit Post</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Make changes to your article, update its cover photo, or re-categorize it.</p>
        </div>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="grid gap-8 lg:grid-cols-3">
            @csrf
            @method('PUT')

            <div class="lg:col-span-2 bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6 transition-colors">

                <div>
                    <label for="title" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Post Title</label>
                    <input type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $post->title) }}"
                        required
                        class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
                </div>

                <div>
                    <label for="content" class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Content</label>
                    <textarea id="content"
                        name="content"
                        rows="14"
                        required
                        class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all resize-y min-h-[250px]">{{ old('content', $post->content) }}</textarea>
                </div>

            </div>

            <div class="space-y-6">

                <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-6 shadow-sm space-y-5 transition-colors">

                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Category</label>
                        <select name="category_id" class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all cursor-pointer">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block mb-2">Cover Image</label>

                        @if($post->image)
                        <div class="mb-3 aspect-video rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm">
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover">
                        </div>
                        @endif

                        <input type="file" 
                               name="image" 
                               accept="image/*"
                               class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-emerald-500/10 dark:file:text-emerald-400 hover:file:opacity-90 file:cursor-pointer cursor-pointer bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl p-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white dark:bg-emerald-500 dark:text-night font-bold py-2.5 rounded-xl hover:opacity-95 shadow-sm transition-all flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        <span>Update Post</span>
                    </button>

                </div>

                <a href="{{ url()->previous() }}" class="text-xs text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 underline text-center block transition-colors">
                    Cancel and Go Back
                </a>

            </div>
        </form>

    </main>

</body>

</html>