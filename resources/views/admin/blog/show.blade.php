@props(['blog'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold capitalize text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog') }} - {{ $blog->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <img src="{{ $blog->thumbnail->url }}" class="w-[300px] h-[200px] md:h-[300px] object-cover" alt="{{ $blog->title }}">

                    <div class="flex gap-1 flex-col mt-3">
                        <span class="font-semibold">{{ __( 'Author' ) }}:</span>
                        <span>{{ $blog->user->name }}</span>
                    </div>

                       <div class="flex flex-col gap-1 mt-5">
                        <span class="font-semibold">{{ __('Title') }}:</span>
                        <span>{{ $blog->title }}</span>
                    </div>


                       <div class="flex flex-col gap-1 mt-5">
                        <span class="font-semibold">{{ __('Description') }}:</span>
                        <span>{{ $blog->body }}</span>
                    </div>

                    <a href="{{ route('blog.admin.edit', ['blog' => $blog->id]) }}" class="text-white bg-blue-600 p-2 rounded px-4 block mt-5 w-max">Edit Blog</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
