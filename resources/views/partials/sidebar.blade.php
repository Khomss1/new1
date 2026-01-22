<aside class="w-64 bg-white shadow-xl z-50 flex flex-col transition-all duration-300 hidden md:flex">
    <!-- Logo Area -->
    <div class="h-16 flex items-center justify-center border-b border-gray-200 bg-blue-900 text-white">
        <div class="flex items-center gap-2">
            <i class="ph ph-scales text-2xl text-yellow-500"></i>
            <span class="text-lg font-bold tracking-wide">e-Monev 2026</span>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-4">
        <div class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Utama</div>
        
        <!-- Helper Class -->
        @php $menuClass = 'flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors '; @endphp
        
        <!-- 1. DASHBOARD -->
        <a href="{{ route('dashboard') }}" 
           class="{{ request()->routeIs('dashboard') ? 'bg-blue-900 text-white border-r-4 border-yellow-500' : 'text-gray-700 hover:bg-gray-100' }} {{ $menuClass }}">
            <i class="ph ph-squares-four text-xl"></i> Dashboard
        </a>

        <!-- 2. DATA BADAN PUBLIK (Pindah ke sini agar tidak masuk dropdown) -->
        <a href="{{ route('admin.bp.index') }}" 
           class="{{ request()->is('admin.bp.*') ? 'bg-blue-900 text-white border-r-4 border-yellow-500' : 'text-gray-700 hover:bg-gray-100' }} {{ $menuClass }}">
            <i class="ph ph-users-three text-xl"></i> Data Badan Publik
        </a>

        <!-- 3. EVALUASI (DENGAN SUB-MENU DROPDOWN) -->
        <div class="relative group">
            <!-- Link Utama (Menu Hasil Kuesioner) -->
            <a href="{{ route('admin.evaluasi.index', ['status' => 'all']) }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin.evaluasi.*') ? 'bg-blue-900 text-white border-r-4 border-yellow-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="ph ph-clipboard-text text-xl"></i> Hasil Kuesioner
                <i class="ph ph-caret-down ml-auto text-xs opacity-70"></i>
            </a>

            <!-- KOTAK SUB-MENU -->
            <div class="pl-10 pr-4 py-1 space-y-1 {{ request()->is('admin.evaluasi.*') ? 'block' : 'hidden group-hover:block' }} bg-gray-50 rounded-lg shadow-sm">
                
                <!-- LOGIKA PHP DIPERBAIKI -->
                <?php
                    $inputStatus = request()->input('status');
                    $isEvaluasiActive = request()->is('admin.evaluasi.*');
                    
                    $isMenungguVerifikasi = $isEvaluasiActive && $inputStatus === 'Menunggu Verifikasi';
                    $isDikembalikan     = $isEvaluasiActive && $inputStatus === 'Dikembalikan';
                    $isTelahDiperbaiki  = $isEvaluasiActive && $inputStatus === 'Telah Diperbaiki';
                    $isTerverifikasi    = $isEvaluasiActive && $inputStatus === 'Terverifikasi';
                    
                    // PERBAIKAN UTAMA: Definisi variabel $isSemuaDataActive yang benar
                    $isSemuaDataActive = $isEvaluasiActive && ($inputStatus == 'all' || empty($inputStatus));
                ?>

                <!-- Sub: Menunggu Verifikasi -->
                <a href="{{ route('admin.evaluasi.index', ['status' => 'Menunggu Verifikasi']) }}" 
                   class="block px-4 py-2 text-sm rounded-md 
                          {{ $isMenungguVerifikasi ? 'bg-yellow-100 text-yellow-800 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} 
                          transition-colors">
                    <i class="ph ph-clock text-yellow-600 mr-2"></i> Menunggu Verifikasi
                </a>

                <!-- Sub: Dikembalikan -->
                <a href="{{ route('admin.evaluasi.index', ['status' => 'Dikembalikan']) }}" 
                   class="block px-4 py-2 text-sm rounded-md 
                          {{ $isDikembalikan ? 'bg-red-100 text-red-800 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} 
                          transition-colors">
                    <i class="ph ph-arrow-u-up-left text-red-600 mr-2"></i> Dikembalikan
                </a>

                <!-- Sub: Telah Diperbaiki (TYPO DIKOREKSI) -->
                <a href="{{ route('admin.evaluasi.index', ['status' => 'Telah Diperbaiki']) }}" 
                   class="block px-4 py-2 text-sm rounded-md 
                          {{ $isTelahDiperbaiki ? 'bg-orange-100 text-orange-800 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} 
                          transition-colors">
                    <i class="ph ph-pencil-simple text-orange-600 mr-2"></i> Telah Diperbaiki
                </a>

                <!-- Sub: Terverifikasi -->
                <a href="{{ route('admin.evaluasi.index', ['status' => 'Terverifikasi']) }}" 
                   class="block px-4 py-2 text-sm rounded-md 
                          {{ $isTerverifikasi ? 'bg-green-100 text-green-800 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} 
                          transition-colors">
                    <i class="ph ph-check-circle text-green-600 mr-2"></i> Terverifikasi
                </a>
                
                <!-- Pembatas -->
                <div class="border-t border-gray-200 my-1"></div>

                <!-- Sub: Semua Data -->
                <a href="{{ route('admin.evaluasi.index', ['status' => 'all']) }}" 
                   class="block px-4 py-2 text-sm rounded-md 
                          {{ $isSemuaDataActive ? 'bg-blue-50 text-blue-900 font-bold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }} 
                          transition-colors">
                    <i class="ph ph-squares-four text-blue-600 mr-2"></i> Semua Data
                </a>
            </div>
        </div>
    </nav>

    <!-- Profil & Logout -->
    <div class="p-4 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center gap-3 mb-3">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=1e3a8a&color=fff" class="w-10 h-10 rounded-full border border-gray-200">
            <div>
                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Badan Publik' }}</p>
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left text-xs font-semibold text-red-600 hover:text-red-800 flex items-center gap-2 transition-colors">
                <i class="ph ph-sign-out text-lg"></i> Keluar
            </button>
        </form>
    </div>
</aside>