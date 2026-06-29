<aside class="w-[260px] bg-[#f6f8fc] flex flex-col flex-shrink-0 h-screen overflow-hidden">
    <!-- Logo Area -->
    <div class="h-16 flex items-center px-6 flex-shrink-0">
        <a href="{{ route('erp.dashboard') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
            </div>
            <div>
                <span class="text-[15px] font-bold text-gray-800 leading-none block">Dewata Glamping</span>
                <span class="text-[10px] text-gray-400 uppercase tracking-wider">ERP System</span>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-2 flex flex-col">
        
        <!-- Primary Action / "Compose" Button -->
        <div class="px-3 mb-4">
            <a href="{{ route('erp.transaksi.reservasi.create') }}" class="inline-flex items-center gap-4 px-4 py-3.5 bg-[#c2e7ff] hover:bg-[#b5dfff] text-gray-900 rounded-2xl shadow-sm transition-all duration-200">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                <span class="text-[14px] font-medium pr-2">Buat Reservasi</span>
            </a>
        </div>

        <div class="space-y-0.5 pr-4">
            <!-- MAIN -->
            <a href="{{ route('erp.dashboard') }}" class="flex items-center gap-4 px-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                {{ request()->routeIs('erp.dashboard') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('erp.dashboard') ? 'text-[#041e49]' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                Dashboard
            </a>

            <!-- MASTER DROPDOWN -->
            @hasanyrole('admin|front_office')
            @php $isMasterActive = request()->routeIs('erp.master.*'); @endphp
            <div x-data="{ open: {{ $isMasterActive ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between gap-4 px-6 py-2 text-[14px] font-medium text-gray-700 hover:bg-gray-100 rounded-r-full transition-all duration-150">
                    <div class="flex items-center gap-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        Master Data
                    </div>
                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity class="mt-0.5 space-y-0.5">
                    <a href="{{ route('erp.master.units.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.master.units.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Unit Glamping
                    </a>
                    <a href="{{ route('erp.master.menu.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.master.menu.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Menu F&B
                    </a>
                    <a href="{{ route('erp.master.customers.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.master.customers.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Data Customer
                    </a>
                    @role('admin')
                    <a href="{{ route('erp.master.staff.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.master.staff.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Data Staff
                    </a>
                    <a href="{{ route('erp.master.tarif.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.master.tarif.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Tarif Dasar
                    </a>
                    @endrole
                </div>
            </div>
            @endhasanyrole

            <!-- TRANSAKSI DROPDOWN -->
            @hasanyrole('admin|front_office|fnb_staff|housekeeping|finance')
            @php $isTransaksiActive = request()->routeIs('erp.transaksi.*'); @endphp
            <div x-data="{ open: {{ $isTransaksiActive ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between gap-4 px-6 py-2 text-[14px] font-medium text-gray-700 hover:bg-gray-100 rounded-r-full transition-all duration-150">
                    <div class="flex items-center gap-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"></path></svg>
                        Operasional
                    </div>
                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity class="mt-0.5 space-y-0.5">
                    @hasanyrole('admin|front_office')
                    <a href="{{ route('erp.transaksi.reservasi.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.transaksi.reservasi.index') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Semua Reservasi
                    </a>
                    <a href="{{ route('erp.transaksi.checkin.form') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.transaksi.checkin.*') || request()->routeIs('erp.transaksi.checkout.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Check-in / Out
                    </a>
                    @endhasanyrole

                    @hasanyrole('admin|fnb_staff')
                    <a href="{{ route('erp.transaksi.fnb.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.transaksi.fnb.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Pesanan F&B
                    </a>
                    @endhasanyrole

                    @hasanyrole('admin|finance')
                    <a href="{{ route('erp.transaksi.pembayaran.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.transaksi.pembayaran.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Pembayaran
                    </a>
                    @endhasanyrole

                    @hasanyrole('admin|housekeeping')
                    <a href="{{ route('erp.transaksi.housekeeping.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.transaksi.housekeeping.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Housekeeping
                    </a>
                    @endhasanyrole
                </div>
            </div>
            @endhasanyrole

            <!-- ANALYTICS DROPDOWN -->
            @role('admin')
            @php $isAnalyticsActive = request()->routeIs('erp.crm.*') || request()->routeIs('erp.dss.*'); @endphp
            <div x-data="{ open: {{ $isAnalyticsActive ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between gap-4 px-6 py-2 text-[14px] font-medium text-gray-700 hover:bg-gray-100 rounded-r-full transition-all duration-150">
                    <div class="flex items-center gap-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Analytics
                    </div>
                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity class="mt-0.5 space-y-0.5">
                    <a href="{{ route('erp.crm.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.crm.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        CRM Pelanggan
                    </a>
                    <a href="{{ route('erp.dss.index') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.dss.*') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        DSS Harga
                    </a>
                </div>
            </div>
            @endrole

            <!-- LAPORAN DROPDOWN -->
            @hasanyrole('admin|finance')
            @php $isLaporanActive = request()->routeIs('erp.laporan.*'); @endphp
            <div x-data="{ open: {{ $isLaporanActive ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between gap-4 px-6 py-2 text-[14px] font-medium text-gray-700 hover:bg-gray-100 rounded-r-full transition-all duration-150">
                    <div class="flex items-center gap-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Laporan
                    </div>
                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition.opacity class="mt-0.5 space-y-0.5">
                    <a href="{{ route('erp.laporan.reservasi') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.laporan.reservasi') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Reservasi
                    </a>
                    <a href="{{ route('erp.laporan.pendapatan') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.laporan.pendapatan') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Pendapatan
                    </a>
                    <a href="{{ route('erp.laporan.okupansi') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.laporan.okupansi') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Okupansi
                    </a>
                    <a href="{{ route('erp.laporan.fnb') }}" class="flex items-center gap-4 pl-[3.25rem] pr-6 py-2 text-[14px] transition-all duration-150 rounded-r-full
                        {{ request()->routeIs('erp.laporan.fnb') ? 'bg-[#d3e3fd] text-[#041e49] font-semibold' : 'text-gray-700 font-medium hover:bg-gray-100' }}">
                        Penjualan F&B
                    </a>
                </div>
            </div>
            @endhasanyrole
        </div>
    </nav>
</aside>
