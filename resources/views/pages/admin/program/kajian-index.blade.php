<x-app-layout>
    <x-slot name="header">Kelola Jadwal Kajian</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.jadwal-kajian.create')" editUrl="/admin/jadwal-kajian/{id}/edit"
            deleteUrl="/admin/jadwal-kajian/{id}" />
    </div>
</x-app-layout>
