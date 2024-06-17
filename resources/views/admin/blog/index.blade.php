@props(['blogs'])

@php
    $records = json_decode($blogs);
    $records = (array) $records;

    foreach ($records as $index => $item) {
        $records[$index] = (array) $item;
    }

    $headings = collect([['Title' => 'title'], ['Description' => 'caption'], ['Author' => 'author_name']]);

    $parsedHeading = $headings;
    $parsedRecords = json_encode($records);

@endphp


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a class="text-white font-semibold bg-green-600 p-2 px-4 block my-3 w-max rounded-md" href="{{ route('blog.admin.create') }}">{{ __('Create New Blog') }}</a>
                    <x-data-table headings="{!! $parsedHeading !!}" records="{!! $parsedRecords !!}">
                    </x-data-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
