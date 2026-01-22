<header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
    <div class="flex items-center gap-4">
        <button class="md:hidden text-gray-600">
            <i class="ph ph-list text-2xl"></i>
        </button>
        <h2 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
    </div>
    
    <div class="flex items-center gap-4">
        <button class="p-2 text-gray-400 hover:text-blue-900 relative">
            <i class="ph ph-bell text-xl"></i>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>
        <div class="hidden md:flex items-center gap-2 text-sm font-medium text-gray-600 bg-blue-50 px-3 py-1 rounded-full">
            <span class="w-2 h-2 bg-green-500 rounded-full"></span> Online
        </div>
    </div>
</header>