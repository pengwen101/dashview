@extends('layout')


@section("content")

<form class="max-w-sm mx-auto"
    action="{{ isset($group) ? route('group.update', $group->id) : route('group.store')  }}"
    method="POST">
    @csrf

    @if(isset($group))
    @method('PUT')
    @endif
    <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-medium  dark:text-white">Name</label>
        <input type="text" id="name" name = "name"
            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
            value = "{{ isset($group) ? $group->name : ''}}"
            required />

        @error('name')
        <div class="text-red-500 text-sm mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>


    @if(isset($group))


    <button type="submit"
        class="text-secondary !bg-accent  focus:ring-4 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>

    @else
    <button type="submit"
        class="text-secondary !bg-accent  focus:ring-4 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add
        New</button>

    @endif
</form>
@endsection