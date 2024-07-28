@extends('dashboard.master')
@section('content')
{{-- breadcrumb --}}
<nav class="flex my-5" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600  ">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                ផ្ទាំងគ្រប់គ្រង
            </a>
        </li>

        <li aria-current="page">
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">បញ្ជីប្លុក</span>
            </div>
        </li>
    </ol>
</nav>
{{-- end breadcrumb --}}

<div class="bg-white p-8 rounded-xl">

    <div class="flex justify-between items-center">
        <div>បញ្ជីប្លុក</div>
        {{-- <button wire:click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">បង្កើតថ្មី</button> --}}
        <a href="{{ route('post.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            បង្កើតថ្មី
        </a>
    </div>

    {{-- table --}}
    <div class="relative overflow-x-auto sm:rounded-lg mt-8">
        <table class="w-full">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th>ID</th>
                    <th>គម្រប</th>
                    <th scope="col" class="px-6 py-3">ចំណងជើង</th>
                    <th scope="col" class="px-6 py-3">ប្រភេទ</th>
                    <th scope="col" class="px-6 py-3">កាលបរិច្ឆេទផ្សាយ</th>
                    <th scope="col" class="px-6 py-3">ចេញផ្សាយ​ដោយ</th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">សកម្មភាព</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr
                    class="bg-white border-b ">
                    <td>{{ $post->id }}</td>
                    <td>
                        <img class="w-10 rounded" src="{{ Storage::url($post->thumbnail_path) }}" alt="">
                    </td>
                    <td scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        {{ $post->title }}
                    </td>

                    <td scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        {{ $post->category->name }}
                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        {{ $post->created_at->format('F d,Y') }}
                    </td>
                    <td class="px-6 py-4 text-right flex space-x-2">
                        <button wire:click="edit({{ $post->id }})" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button onclick="confirmDelete({{ $post->id }})" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-3 border border-red-500 hover:border-transparent rounded"><i class="fa-solid fa-trash-can"></i></button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


{{-- <script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', postId);
            }
        })
    }
</script> --}}

@endsection
