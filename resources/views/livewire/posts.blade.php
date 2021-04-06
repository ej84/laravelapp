<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>
            @if($isOpen)
                @include('livewire.create')
            @endif
            <div class="float-right">
                <span class="mr-3 d-inline">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" wire:model="viewAll" value="0">
                        <span class="ml-2">My Posts</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" class="form-radio" wire:model="viewAll" value="1">
                        <span class="ml-2">All Posts</span>
                    </label>
                </span>
                <input type="text" wire:model="title_filter" placeholder="Search by Title">
            </div>

            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No.</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Body</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)

                    <tr>
                        <td class="border px-4 py-2">{{ $post->id }}</td>
                        <td class="border px-4 py-2 overflow-ellipsis truncate ">{{ $post->title }}</td>
                        <td class="border px-4 py-2 overflow-ellipsis truncate">{{ $post->body }}</td>
                        <td class="border px-4 py-2">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"><a href="/posts/{{ $post->id }}">View</a></button>
                            @if (Auth::user()->id == $post->user_id  )
                                <button wire:click="delete({{ $post->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
