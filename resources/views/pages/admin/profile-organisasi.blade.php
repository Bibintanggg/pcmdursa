<x-app-layout>
    <x-slot name="header">Pengguna</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" />
    </div>
</x-app-layout>
