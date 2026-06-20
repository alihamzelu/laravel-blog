@if(session('error'))
    <div class="fixed top-26 right-5 z-50">
        <div class="flex items-start gap-3 bg-red-500 text-white px-4 py-3 rounded-xl shadow-lg animate-fade-in">
            
            <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            <div class="text-sm font-medium">
                {{ session('error') }}
            </div>

        </div>
    </div>
@endif