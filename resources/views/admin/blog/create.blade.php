<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" enctype="multipart/form-data" action="{{ route('blog.admin.store') }}">

                        @csrf

                        @include('admin.blog.form')
                        <button type="submit" class="font-normal text-white  bg-green-700 p-2 px-4 rounded w-max text-sm" type="submit">
                            {{ __('Submit') }}
                        </button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
