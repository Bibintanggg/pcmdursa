<x-app-layout>
    <x-slot name="header">Artikel</x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <x-data-table :columns="$columns" :rows="$rows" :addUrl="route('admin.articles.create')" editUrl="/admin/articles/{id}/edit"
            deleteUrl="/admin/articles/{id}" />
    </div>
</x-app-layout>
