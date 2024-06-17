@props(['records', 'headings'])

@php
    $records = json_decode($records);
    $headings = json_decode($headings);

    foreach ($headings as $index => $heading) {
        $headings[$index] = (array) $heading;
    }

    foreach ($records as $index => $record) {
        $records[$index] = (array) $record;
    }
@endphp


<table id="inputs" class="font-[Visby Round CF] w-full text-[14px] font-normal rounded-xl bg-white">
    <thead class="bg-[#F9FAFB] text-left">
        <tr>

            {{-- Headings --}}

            @foreach ($headings as $key => $heading)
                @foreach ($heading as $label => $_k)
                    @if ($label !== 'id')
                        <th class="uppercase font-semibold" v-for="column in columns">{{ $label }}</th>
                    @endif
                @endforeach
            @endforeach

            <th class="uppercase font-semibold" v-for="column in columns">Actions</th>


        </tr>
    </thead>
    <tbody>


        @forelse ($records as $record)
            <tr>

                @php
                    $id = $record['id'];
                @endphp
                @foreach ($headings as $heading)
                    @php
                        $key = array_values($heading)[0];
                    @endphp

                    <td class="font-normal text-black p-3 capitalize">
                        <div class="flex gap-2 items-center">{{ $record[$key] }}</div>
                    </td>
                @endforeach

                {{-- Actions --}}
                <td>
                     <div class="font-semibold flex items-center gap-1 text-black p-3 capitalize">
                                <!-- Show Action -->
                                <a href="{{ route('blog.admin.show', [
                                    'blog' => $id,
                                ]) }}"
                                    class="hover:bg-green-700 transition-all duration-200 hover:duration-200 overflow-hidden stroke-gray-100 block group rounded-full w-[30px] h-[30px] p-[6px] bg-green-500"
                                    title="View">
                                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        class="w-full h-full group-hover:stroke-white stroke-gray-100">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z">
                                        </path>
                                    </svg>
                                </a>

                                <!-- Edit Action -->
                                <a href="{{ route( 'blog.admin.edit', [
                                'blog' => $id] ) }}" class="hover:bg-yellow-700 transition-all duration-200 hover:duration-200 overflow-hidden stroke-gray-100 block group rounded-full w-[30px] h-[30px] p-[6px] bg-yellow-500"
                                    title="View">
                                    <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        class="w-full h-full group-hover:stroke-white stroke-gray-100">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                                        </path>
                                    </svg>
                                </a>

                                <!-- Delete Action -->
                                <form method="post" action="{{ route( 'blog.admin.destroy', ['blog' => $id] ) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="hover:bg-red-700 transition-all duration-200 hover:duration-200 overflow-hidden stroke-gray-100 block group rounded-full w-[30px] h-[30px] p-[6px] bg-red-500"
                                        title="View">
                                        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            class="w-full h-full group-hover:stroke-white stroke-gray-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>

                                        </svg>
                                    </button>
                                </form>
                            </div>
                </td>

            </tr>
        @empty
            <tr v-else>
                <td class="font-semibold text-lg font-Poppins text-gray-700 p-3 py-7 h-[100px] capitalize text-center"
                    colspan="10">No Results Found</td>
            </tr>
        @endforelse

    </tbody>
</table>
