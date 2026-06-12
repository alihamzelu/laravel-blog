<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Admin Panel - DevBlog</title>
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

    <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8 flex-grow w-full">

        <section class="grid gap-5 grid-cols-2 lg:grid-cols-4 mb-8">
            <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-5 shadow-sm flex items-center space-x-4">
                <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Total Posts</p>
                    <p class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">{{ $totalPosts }}</p>
                </div>
            </div>
            <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-5 shadow-sm flex items-center space-x-4">
                <div class="p-3 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Authors</p>
                    <p class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl p-5 shadow-sm flex items-center space-x-4">
                <div class="p-3 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a1.44 1.44 0 0 0 2.037 0l4.318-4.318a1.44 1.44 0 0 0 0-2.036L11.159 4.239a2.25 2.25 0 0 0-1.591-.659Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-3xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Categories</p>
                    <p class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">{{ $totalCategories }}</p>
                </div>
            </div>

        </section>

        <div class="border-b border-slate-200 dark:border-slate-800 mb-6 flex items-center justify-between">
            <nav class="flex space-x-6" aria-label="Tabs">
                <button id="tab-posts-btn" type="button" onclick="switchTab('posts')" class="border-indigo-600 dark:border-emerald-400 text-indigo-600 dark:text-emerald-400 border-b-2 py-4 px-1 text-sm font-bold focus:outline-none transition-all">
                    Articles Management
                </button>
                <button id="tab-categories-btn" type="button" onclick="switchTab('categories')" class="border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 border-b-2 py-4 px-1 text-sm font-medium focus:outline-none transition-all">
                    Categories Inventory
                </button>
            </nav>
        </div>

        <div id="panel-posts" class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-black text-slate-900 dark:text-white">Active Articles</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Modify, inspect, or trash your published content blocks.</p>
                </div>
                <a href="{{ route('create') }}" class="inline-flex items-center justify-center space-x-2 rounded-xl bg-indigo-600 text-white px-4 py-2 text-xs font-bold hover:opacity-90 dark:bg-emerald-400 dark:text-night transition-all">
                    <span>+ Write Article</span>
                </a>
            </div>

            <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 dark:border-slate-800/60 bg-slate-50/70 dark:bg-slate-800/10 text-3xs uppercase tracking-widest font-black text-slate-400 dark:text-slate-500">
                                <th class="py-4 px-6">Title</th>
                                <th class="py-4 px-4">Category</th>
                                <th class="py-4 px-4">Author</th>
                                <th class="py-4 px-4">Status</th>
                                <th class="py-4 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/40 text-xs text-slate-700 dark:text-slate-300">
                            @foreach ($posts as $post)

                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="py-4 px-6 font-bold text-slate-900 dark:text-white">{{ $post->title }}</td>
                                <td class="py-4 px-4"><span class="text-3xs px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">{{ $post->category->name }}</span></td>
                                <td class="py-4 px-4">{{ $post->user->name }}</td>
                                <td class="py-4 px-4"><span class="text-3xs font-bold text-emerald-600 dark:text-emerald-400">● Published</span></td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('posts.edit', $post) }}"
                                        class="text-indigo-600 dark:text-emerald-400 font-bold hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="panel-categories" class="space-y-6 hidden">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-black text-slate-900 dark:text-white">System Categories</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Structure your articles using high-level taxonomy classes.</p>
                </div>
                <button type="button" onclick="toggleModal('modal-category')" class="inline-flex items-center justify-center space-x-2 rounded-xl bg-indigo-600 text-white px-4 py-2 text-xs font-bold hover:opacity-90 dark:bg-emerald-400 dark:text-night transition-all cursor-pointer">
                    <span>+ Add Category</span>
                </button>
            </div>

            <div class="bg-white border border-slate-200 dark:bg-slate-900/40 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 dark:border-slate-800/60 bg-slate-50/70 dark:bg-slate-800/10 text-3xs uppercase tracking-widest font-black text-slate-400 dark:text-slate-500">
                                <th class="py-4 px-6">Category Name</th>
                                <th class="py-4 px-4">URL Slug</th>
                                <th class="py-4 px-4">Linked Posts</th>
                                <th class="py-4 px-4">Created At</th>
                                <th class="py-4 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/40 text-xs text-slate-700 dark:text-slate-300">
                            @foreach ($categories as $category)
                            
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="py-4 px-6 font-bold text-slate-900 dark:text-white flex items-center space-x-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                    <span>{{ $category->name }}</span>
                                </td>
                                <td class="py-4 px-4 font-mono text-3xs text-slate-400">{{ $category->slug }}</td>
                                <td class="py-4 px-4 font-bold">{{ $category->posts->count() }} posts</td>
                                <td class="py-4 px-4 font-mono text-3xs text-slate-400">{{ $category->created_at->format('Y-m-d') }}</td>
                                <td class="py-4 px-6 text-right">
                                    
                                
                                
                            </tr>

                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <div id="modal-category" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden transition-all">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl w-full max-w-md overflow-hidden shadow-xl">

            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800/60 flex items-center justify-between">
                <h3 id="modal-title" class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">Create New Category</h3>
                <button type="button" onclick="toggleModal('modal-category')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-lg font-bold focus:outline-none">&times;</button>
            </div>

            <form onsubmit="event.preventDefault(); toggleModal('modal-category');" class="p-6 space-y-4">
                <div>
                    <label for="cat-name" class="text-3xs font-bold uppercase tracking-wider text-slate-400 block mb-2">Category Title</label>
                    <input type="text" id="cat-name" required placeholder="e.g. Machine Learning" class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all" />
                </div>

                <div>
                    <label for="cat-slug" class="text-3xs font-bold uppercase tracking-wider text-slate-400 block mb-2">URL Slug</label>
                    <input type="text" id="cat-slug" required placeholder="e.g. machine-learning" class="w-full bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-emerald-400 transition-all font-mono text-xs" />
                </div>

                <div class="flex items-center justify-end space-x-3 pt-2">
                    <button type="button" onclick="toggleModal('modal-category')" class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">Cancel</button>
                    <button type="submit" id="modal-submit-btn" class="bg-indigo-600 text-white dark:bg-emerald-400 dark:text-night font-bold text-xs px-5 py-2.5 rounded-xl hover:opacity-95 transition-all">Save Category</button>
                </div>
            </form>

        </div>
    </div>

    @include('components.footer')

    <script>
        function switchTab(tabName) {
            const btnPosts = document.getElementById('tab-posts-btn');
            const btnCategories = document.getElementById('tab-categories-btn');
            const panelPosts = document.getElementById('panel-posts');
            const panelCategories = document.getElementById('panel-categories');

            if (!btnPosts || !btnCategories || !panelPosts || !panelCategories) return;

            if (tabName === 'posts') {
                panelPosts.classList.remove('hidden');
                panelCategories.classList.add('hidden');
                btnPosts.className = "border-indigo-600 dark:border-emerald-400 text-indigo-600 dark:text-emerald-400 border-b-2 py-4 px-1 text-sm font-bold focus:outline-none transition-all";
                btnCategories.className = "border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 border-b-2 py-4 px-1 text-sm font-medium focus:outline-none transition-all";
            } else {
                panelPosts.classList.add('hidden');
                panelCategories.classList.remove('hidden');
                btnPosts.className = "border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 border-b-2 py-4 px-1 text-sm font-medium focus:outline-none transition-all";
                btnCategories.className = "border-indigo-600 dark:border-emerald-400 text-indigo-600 dark:text-emerald-400 border-b-2 py-4 px-1 text-sm font-bold focus:outline-none transition-all";
            }
        }

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            modal.classList.toggle('hidden');
            if (modal.classList.contains('hidden')) {
                document.getElementById('modal-title').innerText = "Create New Category";
                document.getElementById('cat-name').value = "";
                document.getElementById('cat-slug').value = "";
            }
        }

        function openEditModal(name, slug) {
            const modalTitle = document.getElementById('modal-title');
            const catName = document.getElementById('cat-name');
            const catSlug = document.getElementById('cat-slug');
            const modalCategory = document.getElementById('modal-category');

            if (modalTitle && catName && catSlug && modalCategory) {
                modalTitle.innerText = "Modify Existing Category";
                catName.value = name;
                catSlug.value = slug;
                modalCategory.classList.remove('hidden');
            }
        }

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>

</html>