{{-- {{-- ============================================================
     DATA TABLE COMPONENT — shadcn/TanStack Style
     Laravel Blade + Tailwind CSS + Vanilla JS
     ============================================================
     Usage: @include('components.data-table')
     atau letakkan di resources/views/components/data-table.blade.php
     ============================================================ --}}

@props([
    'columns' => [],
    'rows'    => [],
    'title'   => 'Data Table',
    'perPage' => 10,
])

@php
/*
|--------------------------------------------------------------------------
| CONTOH DATA — ganti dengan data dari controller kamu
|--------------------------------------------------------------------------
| Di controller:
|   return view('your-view', [
|       'columns' => [...],
|       'rows'    => [...],
|   ]);
*/
$columns ??= [
    ['key' => 'name',       'label' => 'Nama',        'sortable' => true],
    ['key' => 'email',      'label' => 'Email',       'sortable' => true],
    ['key' => 'role',       'label' => 'Role',        'sortable' => true],
    ['key' => 'status',     'label' => 'Status',      'sortable' => false],
    ['key' => 'joined',     'label' => 'Bergabung',   'sortable' => true],
];

$rows ??= [
    ['name'=>'Arya Pratama',   'email'=>'arya@example.com',   'role'=>'Admin',     'status'=>'active',   'joined'=>'2024-01-15'],
    ['name'=>'Budi Santoso',   'email'=>'budi@example.com',   'role'=>'Editor',    'status'=>'inactive', 'joined'=>'2024-02-20'],
    ['name'=>'Citra Dewi',     'email'=>'citra@example.com',  'role'=>'Viewer',    'status'=>'active',   'joined'=>'2024-03-08'],
    ['name'=>'Dian Rahayu',    'email'=>'dian@example.com',   'role'=>'Editor',    'status'=>'active',   'joined'=>'2024-03-22'],
    ['name'=>'Eko Susilo',     'email'=>'eko@example.com',    'role'=>'Viewer',    'status'=>'pending',  'joined'=>'2024-04-11'],
    ['name'=>'Fajar Nugroho',  'email'=>'fajar@example.com',  'role'=>'Admin',     'status'=>'active',   'joined'=>'2024-04-29'],
    ['name'=>'Gita Lestari',   'email'=>'gita@example.com',   'role'=>'Viewer',    'status'=>'inactive', 'joined'=>'2024-05-03'],
    ['name'=>'Hana Wijaya',    'email'=>'hana@example.com',   'role'=>'Editor',    'status'=>'active',   'joined'=>'2024-05-18'],
    ['name'=>'Ivan Kurniawan', 'email'=>'ivan@example.com',   'role'=>'Viewer',    'status'=>'pending',  'joined'=>'2024-06-01'],
    ['name'=>'Julia Sari',     'email'=>'julia@example.com',  'role'=>'Admin',     'status'=>'active',   'joined'=>'2024-06-14'],
    ['name'=>'Kevin Halim',    'email'=>'kevin@example.com',  'role'=>'Editor',    'status'=>'active',   'joined'=>'2024-07-07'],
    ['name'=>'Lisa Amanda',    'email'=>'lisa@example.com',   'role'=>'Viewer',    'status'=>'inactive', 'joined'=>'2024-07-19'],
    ['name'=>'Marco Putra',    'email'=>'marco@example.com',  'role'=>'Admin',     'status'=>'active',   'joined'=>'2024-08-02'],
    ['name'=>'Nadia Putri',    'email'=>'nadia@example.com',  'role'=>'Viewer',    'status'=>'pending',  'joined'=>'2024-08-25'],
    ['name'=>'Oscar Tan',      'email'=>'oscar@example.com',  'role'=>'Editor',    'status'=>'active',   'joined'=>'2024-09-10'],
];
@endphp --}}

{{-- ============================================================
     STYLES — letakkan di <head> atau @push('styles')
     ============================================================ --}}
<style>
    [x-cloak] { display: none !important; }

    .dt-table-wrap { overflow-x: auto; }

    /* Animasi row masuk */
    @keyframes dt-row-in {
        from { opacity: 0; transform: translateY(4px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .dt-row-anim {
        animation: dt-row-in 0.18s ease both;
    }

    /* Sort icon */
    .dt-sort-icon { transition: transform 0.15s ease, opacity 0.15s ease; }
    .dt-sort-icon.asc  { transform: rotate(0deg);   opacity: 1; }
    .dt-sort-icon.desc { transform: rotate(180deg); opacity: 1; }
    .dt-sort-icon.none { opacity: 0.3; }

    /* Checkbox custom */
    .dt-checkbox {
        appearance: none;
        width: 16px; height: 16px;
        border: 1.5px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
        transition: border-color .15s, background-color .15s;
        flex-shrink: 0;
    }
    .dt-checkbox:checked {
        background-color: #09090b;
        border-color: #09090b;
    }
    .dt-checkbox:checked::after {
        content: '';
        position: absolute;
        left: 3px; top: 0px;
        width: 5px; height: 9px;
        border: 2px solid white;
        border-top: none;
        border-left: none;
        transform: rotate(40deg);
    }
    .dt-checkbox:indeterminate {
        background-color: #09090b;
        border-color: #09090b;
    }
    .dt-checkbox:indeterminate::after {
        content: '';
        position: absolute;
        left: 2px; top: 5px;
        width: 8px; height: 2px;
        background: white;
    }
    .dt-checkbox:focus-visible {
        outline: 2px solid #09090b;
        outline-offset: 2px;
    }

    /* Skeleton loading */
    @keyframes dt-shimmer {
        0%   { background-position: -400px 0; }
        100% { background-position: 400px 0; }
    }
    .dt-skeleton {
        background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
        background-size: 400px 100%;
        animation: dt-shimmer 1.4s infinite;
        border-radius: 4px;
        height: 14px;
    }
</style>

{{-- ============================================================
     MARKUP
     ============================================================ --}}
<div
    id="dt-root"
    class="w-full font-sans text-sm text-zinc-900"
    x-data="dataTable({{ json_encode($columns) }}, {{ json_encode($rows) }}, {{ $perPage }})"
    x-init="init()"
>

    {{-- ── Top Bar ── --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-4">

        {{-- Search --}}
        <div class="relative w-full sm:w-72">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-400 pointer-events-none"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0Z"/>
            </svg>
            <input
                type="text"
                x-model.debounce.300ms="search"
                @input="currentPage = 1"
                placeholder="Cari..."
                class="w-full pl-9 pr-4 py-2 text-sm bg-white border border-zinc-200 rounded-lg
                       placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900/10
                       focus:border-zinc-400 transition"
            />
        </div>

        {{-- Right controls --}}
        <div class="flex items-center gap-2 shrink-0">

            {{-- Filter status --}}
            <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm border border-zinc-200 rounded-lg
                           bg-white hover:bg-zinc-50 transition select-none"
                    :class="statusFilter ? 'border-zinc-400 text-zinc-900' : 'text-zinc-600'"
                >
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591L15.75 12.4A2.25 2.25 0 0 0 15 14v6.25a.75.75 0 0 1-1.079.672l-3-1.5A.75.75 0 0 1 10.5 18.75V14a2.25 2.25 0 0 0-.659-1.591L4.659 7.409A2.25 2.25 0 0 1 4 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z"/>
                    </svg>
                    <span x-text="statusFilter ? statusFilter : 'Filter'"></span>
                    <svg class="w-3.5 h-3.5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/>
                    </svg>
                </button>
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-1 w-36 bg-white border border-zinc-200 rounded-lg shadow-md z-10 py-1 text-sm"
                >
                    <button @click="statusFilter=''; open=false; currentPage=1"
                        class="w-full text-left px-3 py-1.5 hover:bg-zinc-50 text-zinc-500">
                        Semua
                    </button>
                    <button @click="statusFilter='active'; open=false; currentPage=1"
                        class="w-full text-left px-3 py-1.5 hover:bg-zinc-50">Active</button>
                    <button @click="statusFilter='inactive'; open=false; currentPage=1"
                        class="w-full text-left px-3 py-1.5 hover:bg-zinc-50">Inactive</button>
                    <button @click="statusFilter='pending'; open=false; currentPage=1"
                        class="w-full text-left px-3 py-1.5 hover:bg-zinc-50">Pending</button>
                </div>
            </div>

            {{-- Column visibility --}}
            <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm border border-zinc-200 rounded-lg
                           bg-white hover:bg-zinc-50 transition text-zinc-600 select-none"
                >
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5v15m6-15v15M3 9h18M3 15h18"/>
                    </svg>
                    <span>Kolom</span>
                </button>
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="absolute right-0 mt-1 w-44 bg-white border border-zinc-200 rounded-lg shadow-md z-10 py-2 px-1 text-sm"
                >
                    <template x-for="col in columns" :key="col.key">
                        <label class="flex items-center gap-2 px-2 py-1.5 rounded-md hover:bg-zinc-50 cursor-pointer select-none">
                            <input type="checkbox" class="dt-checkbox" :value="col.key" x-model="visibleCols" />
                            <span x-text="col.label"></span>
                        </label>
                    </template>
                </div>
            </div>

            {{-- Export CSV --}}
            <button
                @click="exportCSV()"
                class="flex items-center gap-1.5 px-3 py-2 text-sm bg-zinc-900 text-white rounded-lg
                       hover:bg-zinc-800 active:scale-[.98] transition select-none"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                </svg>
                Export
            </button>
        </div>
    </div>

    {{-- ── Selected banner ── --}}
    <div
        x-show="selected.length > 0"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="flex items-center justify-between mb-3 px-4 py-2.5 bg-zinc-900 text-white rounded-lg text-sm"
    >
        <span><span x-text="selected.length"></span> baris dipilih</span>
        <div class="flex items-center gap-2">
            <button @click="deleteSelected()"
                class="px-3 py-1 rounded-md bg-red-500 hover:bg-red-400 transition text-xs font-medium">
                Hapus
            </button>
            <button @click="selected = []"
                class="px-3 py-1 rounded-md bg-white/10 hover:bg-white/20 transition text-xs">
                Batal
            </button>
        </div>
    </div>

    {{-- ── Table ── --}}
    <div class="dt-table-wrap rounded-xl border border-zinc-200 bg-white">
        <table class="w-full text-sm border-collapse">

            {{-- HEAD --}}
            <thead>
                <tr class="border-b border-zinc-100">
                    {{-- Checkbox all --}}
                    <th class="w-10 px-4 py-3">
                        <input
                            type="checkbox"
                            class="dt-checkbox"
                            :checked="isAllChecked()"
                            :indeterminate.prop="isSomeChecked()"
                            @change="toggleAll($event.target.checked)"
                        />
                    </th>

                    <template x-for="col in visibleColumns()" :key="col.key">
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wide whitespace-nowrap select-none"
                            :class="col.sortable ? 'cursor-pointer hover:text-zinc-900 group' : ''"
                            @click="col.sortable && sort(col.key)"
                        >
                            <div class="flex items-center gap-1.5">
                                <span x-text="col.label"></span>
                                <template x-if="col.sortable">
                                    <svg class="w-3.5 h-3.5 dt-sort-icon"
                                         :class="sortKey === col.key ? (sortDir === 'asc' ? 'asc' : 'desc') : 'none'"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.354 4.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L8 7.293l2.646-2.647a.5.5 0 0 1 .708 0Z"/>
                                    </svg>
                                </template>
                            </div>
                        </th>
                    </template>

                    {{-- Actions col --}}
                    <th class="w-14 px-4 py-3"></th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody>
                {{-- Empty state --}}
                <template x-if="paginatedRows().length === 0">
                    <tr>
                        <td :colspan="visibleColumns().length + 2" class="py-16 text-center text-zinc-400">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-10 h-10 text-zinc-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75.125V5.625m0 12.75a1.125 1.125 0 0 1-.375-.875V5.625m.375 13.875a1.125 1.125 0 0 0 1.125-1.125M18 18.375a1.125 1.125 0 0 0 1.125 1.125M18 18.375V5.625m0 12.75c0 .621.504 1.125 1.125 1.125m-1.125-1.125V5.625m0 12.75a1.125 1.125 0 0 0 .375-.875V5.625M6 18.375V5.625m0 0A1.125 1.125 0 0 1 7.125 4.5h9.75A1.125 1.125 0 0 1 18 5.625"/>
                                </svg>
                                <p class="text-sm">Tidak ada data ditemukan</p>
                            </div>
                        </td>
                    </tr>
                </template>

                {{-- Rows --}}
                <template x-for="(row, i) in paginatedRows()" :key="rowKey(row, i)">
                    <tr
                        class="border-b border-zinc-50 last:border-0 hover:bg-zinc-50/60 transition-colors dt-row-anim"
                        :class="selected.includes(rowKey(row, i)) ? 'bg-zinc-50' : ''"
                        :style="'animation-delay:' + (i * 0.03) + 's'"
                    >
                        {{-- Row checkbox --}}
                        <td class="px-4 py-3">
                            <input
                                type="checkbox"
                                class="dt-checkbox"
                                :value="rowKey(row, i)"
                                x-model="selected"
                            />
                        </td>

                        {{-- Data cells --}}
                        <template x-for="col in visibleColumns()" :key="col.key">
                            <td class="px-4 py-3 whitespace-nowrap text-zinc-700">

                                {{-- Avatar for name --}}
                                <template x-if="col.key === 'name'">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-zinc-100 flex items-center justify-center
                                                    text-[11px] font-semibold text-zinc-500 shrink-0 uppercase"
                                             x-text="row[col.key].split(' ').map(w=>w[0]).join('').slice(0,2)">
                                        </div>
                                        <span class="font-medium text-zinc-900" x-text="row[col.key]"></span>
                                    </div>
                                </template>

                                {{-- Email --}}
                                <template x-if="col.key === 'email'">
                                    <span class="text-zinc-500" x-text="row[col.key]"></span>
                                </template>

                                {{-- Status badge --}}
                                <template x-if="col.key === 'status'">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium"
                                        :class="{
                                            'bg-green-50 text-green-700 ring-1 ring-inset ring-green-200':   row[col.key] === 'active',
                                            'bg-zinc-100 text-zinc-500 ring-1 ring-inset ring-zinc-200':    row[col.key] === 'inactive',
                                            'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-200':  row[col.key] === 'pending',
                                        }"
                                    >
                                        <span
                                            class="w-1.5 h-1.5 rounded-full"
                                            :class="{
                                                'bg-green-500': row[col.key] === 'active',
                                                'bg-zinc-400':  row[col.key] === 'inactive',
                                                'bg-amber-500': row[col.key] === 'pending',
                                            }"
                                        ></span>
                                        <span x-text="row[col.key]" class="capitalize"></span>
                                    </span>
                                </template>

                                {{-- Role badge --}}
                                <template x-if="col.key === 'role'">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium"
                                        :class="{
                                            'bg-violet-50 text-violet-700':  row[col.key] === 'Admin',
                                            'bg-blue-50 text-blue-700':      row[col.key] === 'Editor',
                                            'bg-zinc-50 text-zinc-600 border border-zinc-200': row[col.key] === 'Viewer',
                                        }"
                                        x-text="row[col.key]"
                                    ></span>
                                </template>

                                {{-- Date --}}
                                <template x-if="col.key === 'joined'">
                                    <span class="text-zinc-500 text-xs" x-text="formatDate(row[col.key])"></span>
                                </template>

                                {{-- Default fallback --}}
                                <template x-if="!['name','email','status','role','joined'].includes(col.key)">
                                    <span x-text="row[col.key]"></span>
                                </template>

                            </td>
                        </template>

                        {{-- Actions --}}
                        <td class="px-3 py-3">
                            <div class="relative flex justify-end" x-data="{ open: false }">
                                <button
                                    @click.stop="open = !open"
                                    class="p-1.5 rounded-md text-zinc-400 hover:text-zinc-700 hover:bg-zinc-100 transition"
                                >
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                                    </svg>
                                </button>
                                <div
                                    x-show="open"
                                    @click.outside="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    class="absolute right-0 top-8 w-36 bg-white border border-zinc-200 rounded-lg
                                           shadow-lg z-20 py-1 text-sm text-zinc-700"
                                >
                                    <button @click="editRow(row); open=false"
                                        class="w-full flex items-center gap-2 px-3 py-1.5 hover:bg-zinc-50 text-left">
                                        <svg class="w-3.5 h-3.5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    <button @click="copyRow(row); open=false"
                                        class="w-full flex items-center gap-2 px-3 py-1.5 hover:bg-zinc-50 text-left">
                                        <svg class="w-3.5 h-3.5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"/>
                                        </svg>
                                        Salin
                                    </button>
                                    <div class="my-1 border-t border-zinc-100"></div>
                                    <button @click="deleteRow(row); open=false"
                                        class="w-full flex items-center gap-2 px-3 py-1.5 hover:bg-red-50 text-left text-red-600">
                                        <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    {{-- ── Footer / Pagination ── --}}
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mt-4 text-sm text-zinc-500">

        {{-- Info --}}
        <div class="flex items-center gap-3">
            <span x-text="selectionInfo()"></span>
            <span class="text-zinc-200">|</span>
            <span>
                Tampilkan
                <select
                    x-model.number="perPage"
                    @change="currentPage = 1"
                    class="mx-1 px-1.5 py-0.5 border border-zinc-200 rounded-md bg-white text-sm
                           focus:outline-none focus:ring-2 focus:ring-zinc-900/10 focus:border-zinc-400"
                >
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
                per halaman
            </span>
        </div>

        {{-- Pagination --}}
        <div class="flex items-center gap-1">
            <button
                @click="currentPage = 1"
                :disabled="currentPage === 1"
                class="p-1.5 rounded-md border border-zinc-200 bg-white hover:bg-zinc-50 disabled:opacity-30 disabled:cursor-not-allowed transition"
                title="Pertama"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.72 9.47a.75.75 0 0 0 0 1.06l4.25 4.25a.75.75 0 1 0 1.06-1.06L6.31 10l3.72-3.72a.75.75 0 1 0-1.06-1.06L4.72 9.47Zm9.25-4.78a.75.75 0 0 1 0 1.06L10.25 9.47a.75.75 0 0 0 0 1.06l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
                </svg>
            </button>
            <button
                @click="prevPage()"
                :disabled="currentPage === 1"
                class="p-1.5 rounded-md border border-zinc-200 bg-white hover:bg-zinc-50 disabled:opacity-30 disabled:cursor-not-allowed transition"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/>
                </svg>
            </button>

            <template x-for="page in pageNumbers()" :key="page">
                <button
                    @click="page !== '…' && (currentPage = page)"
                    class="min-w-[32px] h-8 px-1.5 rounded-md border text-sm transition"
                    :class="page === currentPage
                        ? 'bg-zinc-900 text-white border-zinc-900'
                        : page === '…'
                            ? 'border-transparent text-zinc-400 cursor-default'
                            : 'bg-white border-zinc-200 hover:bg-zinc-50'"
                    :disabled="page === '…'"
                    x-text="page"
                ></button>
            </template>

            <button
                @click="nextPage()"
                :disabled="currentPage === totalPages()"
                class="p-1.5 rounded-md border border-zinc-200 bg-white hover:bg-zinc-50 disabled:opacity-30 disabled:cursor-not-allowed transition"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                </svg>
            </button>
            <button
                @click="currentPage = totalPages()"
                :disabled="currentPage === totalPages()"
                class="p-1.5 rounded-md border border-zinc-200 bg-white hover:bg-zinc-50 disabled:opacity-30 disabled:cursor-not-allowed transition"
                title="Terakhir"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M15.28 9.47a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 1 1-1.06-1.06L13.69 10 9.97 6.28a.75.75 0 0 1 1.06-1.06l4.25 4.25ZM6.03 4.69a.75.75 0 0 0 0 1.06l3.72 3.72a.75.75 0 0 1 0 1.06l-3.72 3.72a.75.75 0 1 0 1.06 1.06l4.25-4.25a.75.75 0 0 0 0-1.06L7.09 4.69a.75.75 0 0 0-1.06 0Z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Toast Notification ── --}}
    <div
        x-show="toast.show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-5 right-5 z-50 flex items-center gap-2.5 px-4 py-3 bg-zinc-900 text-white
               text-sm rounded-xl shadow-xl"
    >
        <span x-text="toast.message"></span>
    </div>

</div>

{{-- ============================================================
     SCRIPTS — letakkan sebelum </body> atau @push('scripts')
     ============================================================ --}}

{{-- Alpine.js CDN (skip jika sudah ada) --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
function dataTable(columns, rows, perPage) {
    return {
        // ── State ──────────────────────────────────────────────
        columns,
        allRows: [...rows],
        perPage: perPage,
        currentPage: 1,
        search: '',
        sortKey: '',
        sortDir: 'asc',
        selected: [],
        visibleCols: columns.map(c => c.key),
        statusFilter: '',
        toast: { show: false, message: '', _t: null },

        // ── Init ───────────────────────────────────────────────
        init() {},

        // ── Helpers ────────────────────────────────────────────
        rowKey(row, i) {
            return row.email ?? String(i);
        },

        formatDate(val) {
            if (!val) return '';
            const d = new Date(val);
            return d.toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' });
        },

        showToast(msg) {
            clearTimeout(this.toast._t);
            this.toast.message = msg;
            this.toast.show = true;
            this.toast._t = setTimeout(() => this.toast.show = false, 2500);
        },

        // ── Derived data ───────────────────────────────────────
        visibleColumns() {
            return this.columns.filter(c => this.visibleCols.includes(c.key));
        },

        filteredRows() {
            let r = this.allRows;

            if (this.statusFilter) {
                r = r.filter(row => row.status === this.statusFilter);
            }

            if (this.search.trim()) {
                const q = this.search.trim().toLowerCase();
                r = r.filter(row =>
                    Object.values(row).some(v => String(v).toLowerCase().includes(q))
                );
            }

            if (this.sortKey) {
                r = [...r].sort((a, b) => {
                    const av = String(a[this.sortKey] ?? '').toLowerCase();
                    const bv = String(b[this.sortKey] ?? '').toLowerCase();
                    return this.sortDir === 'asc'
                        ? av.localeCompare(bv)
                        : bv.localeCompare(av);
                });
            }

            return r;
        },

        totalPages() {
            return Math.max(1, Math.ceil(this.filteredRows().length / this.perPage));
        },

        paginatedRows() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredRows().slice(start, start + this.perPage);
        },

        selectionInfo() {
            const total = this.filteredRows().length;
            const start = total === 0 ? 0 : (this.currentPage - 1) * this.perPage + 1;
            const end   = Math.min(this.currentPage * this.perPage, total);
            return `${start}–${end} dari ${total} baris`;
        },

        // ── Pagination ─────────────────────────────────────────
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        nextPage() { if (this.currentPage < this.totalPages()) this.currentPage++; },

        pageNumbers() {
            const total = this.totalPages();
            const cur   = this.currentPage;
            const pages = [];

            if (total <= 7) {
                for (let i = 1; i <= total; i++) pages.push(i);
                return pages;
            }

            pages.push(1);
            if (cur > 3)           pages.push('…');
            for (let i = Math.max(2, cur - 1); i <= Math.min(total - 1, cur + 1); i++) {
                pages.push(i);
            }
            if (cur < total - 2)   pages.push('…');
            pages.push(total);

            return pages;
        },

        // ── Sort ───────────────────────────────────────────────
        sort(key) {
            if (this.sortKey === key) {
                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortKey = key;
                this.sortDir = 'asc';
            }
            this.currentPage = 1;
        },

        // ── Selection ──────────────────────────────────────────
        isAllChecked() {
            const keys = this.paginatedRows().map((r, i) => this.rowKey(r, i));
            return keys.length > 0 && keys.every(k => this.selected.includes(k));
        },

        isSomeChecked() {
            const keys = this.paginatedRows().map((r, i) => this.rowKey(r, i));
            const some = keys.some(k => this.selected.includes(k));
            return some && !this.isAllChecked();
        },

        toggleAll(checked) {
            const keys = this.paginatedRows().map((r, i) => this.rowKey(r, i));
            if (checked) {
                const merged = new Set([...this.selected, ...keys]);
                this.selected = [...merged];
            } else {
                this.selected = this.selected.filter(k => !keys.includes(k));
            }
        },

        // ── Actions ────────────────────────────────────────────
        editRow(row) {
            this.showToast('Edit: ' + (row.name ?? 'baris'));
            // TODO: buka modal / navigasi ke halaman edit
        },

        copyRow(row) {
            navigator.clipboard?.writeText(JSON.stringify(row))
                .then(() => this.showToast('Data disalin ke clipboard!'))
                .catch(() => this.showToast('Gagal menyalin data'));
        },

        deleteRow(row) {
            if (!confirm('Hapus baris ini?')) return;
            const key = row.email ?? '';
            this.allRows = this.allRows.filter(r => r.email !== key);
            this.selected = this.selected.filter(s => s !== key);
            if (this.currentPage > this.totalPages()) this.currentPage = this.totalPages();
            this.showToast('Baris dihapus');
        },

        deleteSelected() {
            if (!confirm(`Hapus ${this.selected.length} baris yang dipilih?`)) return;
            this.allRows = this.allRows.filter(r => !this.selected.includes(r.email ?? ''));
            this.selected = [];
            if (this.currentPage > this.totalPages()) this.currentPage = this.totalPages();
            this.showToast('Baris dipilih telah dihapus');
        },

        // ── Export CSV ─────────────────────────────────────────
        exportCSV() {
            const cols = this.visibleColumns();
        const rows = this.filteredRows();
            const header = cols.map(c => c.label).join(',');
            const body   = rows.map(row =>
                cols.map(c => `"${String(row[c.key] ?? '').replace(/"/g, '""')}"`).join(',')
            ).join('\n');
            const csv  = header + '\n' + body;
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const url  = URL.createObjectURL(blob);
            const a    = document.createElement('a');
            a.href     = url;
            a.download = 'data-export.csv';
            a.click();
            URL.revokeObjectURL(url);
            this.showToast('CSV berhasil diexport!');
        },
    };
}
</script>
