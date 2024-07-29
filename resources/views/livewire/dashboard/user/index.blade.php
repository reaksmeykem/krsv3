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
                    <span
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">អ្នកប្រើប្រាស់</span>
                </div>
            </li>
        </ol>
    </nav>
    {{-- end breadcrumb --}}

    <div class="bg-white p-8 rounded-xl">
        <div class="mb-5">
            <div class="flex justify-between items-center my-8">
                <div>បញ្ជីការអ្នកប្រើប្រាស់</div>
                <button wire:click="openModal()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    បង្កើតថ្មី
                </button>
            </div>
            <div x-data="{ open: @entangle('isOpen') }" x-show="open" class="fixed inset-0 flex items-center justify-center z-40">
                <div class="fixed inset-0 bg-slate-900 bg-opacity-75" wire:click="closeModal()"></div>
                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="bg-white p-6 rounded shadow-lg z-40 my-8 w-full lg:w-1/3 overflow-y-auto max-h-screen">
                    <div>
                        <form wire:ignore.self class="w-full">
                            <div>
                                បង្កើតអ្នកប្រើប្រាស់ថ្មី
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">

                                <div class="grid gird-cols-1 gap-2">
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                                        <input type="text" wire:model="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            placeholder="Enter name" />
                                        @error('name')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                                        <input type="text" wire:model="username"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            placeholder="Enter username" />
                                        @error('username')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                        <input type="text" wire:model="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            placeholder="Enter email" />
                                        @error('email')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-4">
                                        <label for=""
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Role</label>
                                        <select wire:model="role"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option selected>Choose a role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    @if ($role->name == $userRole) selected @endif>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4 {{ $passwordDisabled ? 'hidden' : '' }}">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                                        <input type="text" wire:model="password"
                                            {{ $passwordDisabled ? 'disabled' : '' }}
                                            class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            placeholder="Enter name" />
                                        @error('name')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 {{ $passwordDisabled ? 'hidden' : '' }}">
                                        <label
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Confirm
                                            Password</label>
                                        <input type="text" wire:model="confirm_password"
                                            {{ $passwordDisabled ? 'disabled' : '' }}
                                            class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ="
                                            placeholder="Enter name" />
                                        @error('confirm_password')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Photo</label>
                                    <div class="flex space-x-6 items-center">
                                        <div class="shrink-0">

                                            @if($editing)
                                                <img class="h-16 w-16 object-cover rounded-full"
                                                    src="{{ $existPhoto }}" alt="Current profile photo" />
                                            @else
                                                @if($tempUrl)
                                                    <div class="mt-2">
                                                        <img src="{{ $tempUrl }}" alt="Preview" class="h-16 w-16 object-cover rounded-full">
                                                    </div>
                                                @else
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/photos/13/defaultphoto/no-photo.jpg') }}" alt="Preview" class="h-16 w-16 object-cover rounded-full">
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                        <label class="block">
                                            <span class="sr-only">Choose profile photo</span>
                                            <input type="file" wire:model="photo"
                                                class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                " />
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div class="sm:flex sm:flex-row-reverse">
                            <button type="submit" wire:click.prevent="save"
                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">{{ $editing ? 'រក្សាទុក' : 'រក្សាទុក' }}</button>
                            <button type="button" wire:click="closeModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">ចាកចេញ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto sm:rounded-lg ">

            <table class="w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">រូបភាព</th>
                        <th scope="col" class="px-6 py-3">ឈ្មោះ</th>
                        <th scope="col" class="px-6 py-3">អ៊ីម៉ែល</th>
                        <th scope="col" class="px-6 py-3">ពាក្យសម្ងាត់</th>
                        <th>មុខងារ</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">សកម្មភាព</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b text-slate-900">
                            <td>{{ $user->id }}</td>
                            <td>
                                <img class="w-10 rounded-xl" src="{{ Storage::url($user->photo) }}" alt="">
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $user->name }}
                            </td>

                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $user->email }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                *****
                            </td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-right flex space-x-2">
                                @can('edit user')
                                    <button wire:click="edit({{ $user->id }})"
                                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-3 border border-blue-500 hover:border-transparent rounded"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                @endcan
                                @if (Auth::user()->id != $user->id)
                                    @can('delete user')
                                        <button onclick="confirmDelete({{ $user->id }})"
                                            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-3 border border-red-500 hover:border-transparent rounded"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    @endcan
                                @endif
                                @can('change_password user')
                                    @include('dashboard.user.change-password')
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <script>
        function confirmDelete(userId) {
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
                    @this.call('delete', userId);
                }
            })
        }
    </script>
</div>
