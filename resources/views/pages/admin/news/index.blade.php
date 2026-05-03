<x-app-layout>
    <x-slot name="header">Kelola Berita</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table
            :columns="$columns"
            :rows="$rows"
            title="Kelola Berita"
            :per-page="10"
            add-url="{{ route('berita.create') }}"
            edit-url="/admin/berita/{id}/edit"
            delete-url="/admin/berita/{id}"
        />
    </div>
</x-app-layout>
