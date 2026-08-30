{{-- Sidebar navigation component --}}
<div class="flex flex-col h-full">

    {{-- Manual header --}}
    <div class="px-4 py-4 border-b border-slate-800">
        <div class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Source Manual</div>
        <div class="text-sm font-semibold text-white leading-tight">Cessna 172-Series</div>
        <div class="text-xs text-slate-400">Service Manual • 1969–1976</div>
    </div>

    {{-- Search shortcut --}}
    <div class="px-3 py-3">
        <a href="{{ route('search') }}" class="flex items-center gap-2 w-full px-3 py-2 bg-slate-800 hover:bg-slate-700 rounded-lg text-sm text-slate-400 hover:text-white transition-colors group">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <span class="flex-1 text-xs">Search manual...</span>
            <kbd class="text-xs bg-slate-700 group-hover:bg-slate-600 px-1.5 py-0.5 rounded font-mono">/</kbd>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-3 pb-6" aria-label="Manual sections">

        {{-- Quick links --}}
        <div class="sidebar-section-header">Quick Access</div>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="{{ route('manual.index') }}" class="sidebar-link {{ request()->routeIs('manual.*') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Full Manual
        </a>
        <a href="{{ route('inspection') }}" class="sidebar-link {{ request()->routeIs('inspection') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Inspection
        </a>
        <a href="{{ route('torque') }}" class="sidebar-link {{ request()->routeIs('torque') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            Torque Values
        </a>
        <a href="{{ route('wiring') }}" class="sidebar-link {{ request()->routeIs('wiring') ? 'active' : '' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Wiring Diagrams
        </a>

        {{-- Manual Sections --}}
        <div class="sidebar-section-header mt-5">Manual Sections</div>

        @php
        $manualSections = [
            ['num' => '01', 'title' => 'General Description',              'slug' => null],
            ['num' => '02', 'title' => 'Ground Handling & Servicing',      'slug' => null],
            ['num' => '03', 'title' => 'Fuselage',                         'slug' => null],
            ['num' => '04', 'title' => 'Wings & Empennage',                'slug' => null],
            ['num' => '05', 'title' => 'Landing Gear & Brakes',            'slug' => 'landing-gear'],
            ['num' => '06', 'title' => 'Aileron Control System',           'slug' => 'flight-controls'],
            ['num' => '07', 'title' => 'Wing Flap Control System',         'slug' => null],
            ['num' => '08', 'title' => 'Elevator Control System',          'slug' => null],
            ['num' => '09', 'title' => 'Elevator Trim Tab',                'slug' => null],
            ['num' => '10', 'title' => 'Rudder Control System',            'slug' => null],
            ['num' => '11', 'title' => 'Engine — Lycoming Blue-Streak',   'slug' => 'engine'],
            ['num' => '11A','title' => 'Engine — Continental',             'slug' => 'engine'],
            ['num' => '12', 'title' => 'Fuel System',                      'slug' => 'fuel-system'],
            ['num' => '13', 'title' => 'Propeller',                        'slug' => 'propeller'],
            ['num' => '14', 'title' => 'Utility Systems',                  'slug' => 'utility'],
            ['num' => '15', 'title' => 'Instruments & Instrument Systems', 'slug' => 'instruments'],
            ['num' => '16', 'title' => 'Electrical Systems',               'slug' => 'electrical'],
            ['num' => '17', 'title' => 'Electronic Systems — Deleted',     'slug' => null],
            ['num' => '18', 'title' => 'Structural Repair',                'slug' => 'structural'],
            ['num' => '19', 'title' => 'Painting',                         'slug' => null],
            ['num' => '20', 'title' => 'Wiring Diagrams',                  'slug' => 'wiring'],
        ];
        $activeSection = request()->route('section') ?? '';
        @endphp

        @foreach($manualSections as $sec)
        @php $isActive = $activeSection === $sec['num'] || $activeSection === $sec['slug']; @endphp
        <a href="{{ route('manual.section', $sec['num']) }}"
           class="sidebar-link {{ $isActive ? 'active' : '' }} group"
           title="{{ $sec['title'] }}">
            <span class="w-7 h-6 flex items-center justify-center text-[10px] font-bold font-mono
                         {{ $isActive ? 'bg-white/20' : 'bg-slate-800 group-hover:bg-slate-700' }}
                         rounded text-current flex-shrink-0 transition-colors">
                {{ $sec['num'] }}
            </span>
            <span class="text-xs leading-tight truncate">{{ $sec['title'] }}</span>
        </a>
        @endforeach

    </nav>

    {{-- Bottom admin link --}}
    <div class="px-3 py-3 border-t border-slate-800">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link text-slate-500 hover:text-slate-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span class="text-xs">Admin Panel</span>
        </a>
    </div>
</div>
