<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-7 pt-4 pb-7">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if($isOpen)
                @include('livewire.create')
            @endif
            @if (Auth::user()->id == $posts[0]->user_id  )
                <div class="float-right">
                    <button wire:click="edit({{ $posts[0]->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                    <button wire:click="delete({{ $posts[0]->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                </div>
            @endif

            <h1 class="text-5xl mb-3">{{ $posts[0]->title }}</h1>

            <hr /><br />
            <p class="text-2xl">{{ $posts[0]->body }}</p>
        </div>
    </div>
</div>
