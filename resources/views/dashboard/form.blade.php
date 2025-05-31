@extends('layout')


@section("content")

<form class="max-w-sm mx-auto"
    action="{{ isset($dashboard) ? route('dashboard.update', $dashboard->id) : route('dashboard.store')  }}"
    method="POST">
    @csrf

    @if(isset($dashboard))
    @method('PUT')
    @endif
    <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-medium dark:text-white">Name</label>
        <input type="text" id="name" name = "name"
            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
            value = "{{ isset($dashboard) ? $dashboard->name : ''}}"
            required />

        @error('name')
        <div class="text-red-500 text-sm mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-5">
        <label for="description"
            class="block mb-2 text-sm font-medium dark:text-white">Description</label>
        <input type="text" id="description" name = "description"
            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
            value = "{{ isset($dashboard) ? $dashboard->description : ''}}"
            required />

        @error('description')
        <div class="text-red-500 text-sm mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-5">
        <label for="link" class="block mb-2 text-sm font-medium  dark:text-white">Link</label>
        <input type="text" id="link" name = "link"
            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
            value = "{{ isset($dashboard) ? $dashboard->link : ''}}"
            required />

        @error('link')
        <div class="text-red-500 text-sm mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
        @if($dashboardGroups->count() > 0)
            <div class="mb-5 existing_group">
                <label for="group_id" class="block mb-2 text-sm font-medium  dark:text-white">Group</label>
                <select id="group_id" name = "group_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($dashboardGroups as $group)
                    <option value='{{$group->id}}' {{isset($dashboard) && $dashboard->group->name == $group->name ? 'selected' :
                        ''}}>{{$group->name}}</option>
                    @endforeach
                </select>
                @error('group_id')
                <div class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="is_new" type="checkbox" name = "is_new"
                        class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                         />
                </div>
                <label for="is_new" class="ms-2 text-sm font-medium  dark:text-gray-300">New Group</label>
            </div>

        
            <div class = "new_group mb-5 hidden">
                <label for="group_name" class="block mb-2 text-sm font-medium  dark:text-white">Group</label>
                <input type="text" id="group_name" name = "group_name"
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                     />

                @error('group_name')
                <div class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

        @else
            <div class = "mb-5">
                <label for="group_name" class="block mb-2 text-sm font-medium  dark:text-white">Group</label>
                <input type="text" id="group_name" name = "group_name"
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                    required />

                @error('group_name')
                <div class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
        @endif

    @if(isset($dashboard))


    <button type="submit"
        class="text-secondary !bg-accent  focus:ring-4 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>

    @else
    <button type="submit"
        class="text-secondary !bg-accent  focus:ring-4 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add
        New</button>

    @endif

</form>


@endsection

@section('library-js')

<script>

    document.querySelector('#is_new').addEventListener('change', (event)=>{
        if (event.currentTarget.checked) {
            document.querySelector('.new_group').classList.remove('hidden');
            document.querySelector('.existing_group').classList.add('hidden');

        } else {
            document.querySelector('.new_group').classList.add('hidden');
            document.querySelector('.existing_group').classList.remove('hidden');
        }
    })

</script>

@endsection