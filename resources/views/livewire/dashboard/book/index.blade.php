<div>
    {{-- breadcrumb --}}
    <nav class="flex my-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
              </svg>
              ផ្ទាំងគ្រប់គ្រង
            </a>
          </li>

          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">សៀវភៅ</span>
            </div>
          </li>
        </ol>
      </nav>
    {{-- end breadcrumb --}}

    <div class="relative overflow-x-auto sm:rounded-lg  bg-white p-8 rounded-xl">
        <div x-data="{ open: @entangle('isOpen') }" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="flex justify-between items-center">
                <div>បញ្ជីសៀវភៅ</div>
                <button @click="open = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-plus"></i> បង្កើតថ្មី
                  </button>
            </div>
            <div x-show="open" class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex items-end justify-center min-w-full min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div x-show="open" style="min-width:900px;" class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 min-w-[350px] sm:min-w-[600px] md:min-w-[800px] lg:min-w-[1200px] sm:p-6">
                        <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">

                            <button type="button" wire:click="closeModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div>
                            @include('dashboard.content.form')
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class=" mt-5">
        <table id="datatable" class="w-full display">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th>ក្រប</th>
                    <th scope="col" class="px-6 py-3">
                        ចំណងជើង
                    </th>
                    <th>ប្រភេទ</th>
                    <th>ស្ថានភាព</th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">សកម្ម</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td>
                        <img class="w-10 h-10" src="{{ $book->cover_image_path }}" alt="">
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>
                        @if($book->state == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button wire:click="edit({{ $book->id }})" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded"><i class="fa-solid fa-pen-to-square"></i></button>
                        {{-- onclick="confirm('Are you sure to delete?')" wire:click="delete({{ $role->id }})" --}}
                        <button onclick="confirmDelete({{ $book->id }})"  class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-3 border border-red-500 hover:border-transparent rounded"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    {{-- @endif --}}

    <script>
        function confirmDelete(bookId) {
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
                    @this.call('delete', bookId);
                }
            })
        }

    </script>
</div>
