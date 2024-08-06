<div>
    {{-- breadcrumb --}}
    <nav class="flex my-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">ការអនុញ្ញាត</span>
                </div>
            </li>
        </ol>
    </nav>
    {{-- end breadcrumb --}}

    {{-- modal --}}
    @include('livewire.dashboard.tutorial.form')

    <div class="bg-white p-8 rounded-xl">
        <div class="flex justify-between items-center">
            <div>បញ្ជីការអនុញ្ញាត</div>

            <button wire:click="openModal()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                បង្កើតថ្មី
            </button>
        </div>

        {{-- table --}}
        <div class="relative overflow-x-auto sm:rounded-lg mt-8">
            <table class="w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ឈ្មោះ
                        </th>
                        <th>ស្លក</th>
                        <th>ប្រភេទ</th>
                        <th>ស្ថានភាព</th>
                        <th>បង្ហាញ?</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">សកម្ម</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr
                        class="bg-white border-b hover:bg-gray-50 ">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $course->title }}
                        </td>
                        <td>
                            {{ $category->slug }}
                        </td>
                        <td>
                            @if($course->parent)
                            {{ $course->parent->name }}
                            @endif

                        </td>
                        <td>
                            @if($category->state == 1)
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                            @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Inactive</span>
                            @endif

                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="edit({{ $course->id }})" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button onclick="confirmDelete({{ $course->id }})"  class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-3 border border-red-500 hover:border-transparent rounded"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function confirmDelete(courseId) {
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
                    @this.call('delete', courseId);
                }
            })
        }

    </script>
    {{-- generate slug --}}
    <script>
        function generateSlug() {
            var name = document.getElementById('title').value;
            var slug = name.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with hyphens
                .replace(/^-+|-+$/g, ''); // Trim leading and trailing hyphens

            @this.set('slug', slug);
        }
    </script>

    <script>
        document.addEventListener('livewire:load', function () {

            // Initialize the modal
            const modalElement = document.getElementById('courseModal');
            const modal = new Modal(modalElement);

            Livewire.on('courseSaved', function () {
                // Close modal when a post is saved or deleted
                modal.hide();
            });

            window.addEventListener('show-modal', function () {
                modal.show();
            });

            window.addEventListener('hide-modal', function () {
                modal.hide();
            });
        });
    </script>

</div>
