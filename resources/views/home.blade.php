@extends('layout')

@section('content')



    @foreach($dashboardGroups as $group)
        <div class = "min-h-screen flex flex-col items-center">

        <div class = "w-fit uppercase text-secondary !bg-accent px-4 py-2 text-5xl font-semibold mb-10">
            {{$group->name}}
        </div>


        

<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96 bg-secondary">
        <div class = "hidden lg:block">
            @foreach($group->dashboards->chunk(3) as $chunk)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class = "grid grid-cols-3 gap-4 px-10 pt-10">
                        @foreach($chunk as $dashboard)
                        <a href="{{route('dashboard.show', $dashboard->id)}}" class="flex flex-col bg-primary border border-gray-200 rounded-lg shadow-sm md:max-w-md max-h-96 hover:bg-accent text-secondary transition duration-300 ease-in-out">
                            <img 
                                class="object-cover w-full rounded-t-lg h-[80%]"
                                src="https://api.apiflash.com/v1/urltoimage?access_key=9e53f2cbaeba44f6b5bcfa8782b0358b&wait_until=network_idle&url={{ $dashboard->link }}" 
                                alt="Website preview of {{ $dashboard->name }}"
                            />
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class=" text-secondary mb-2 text-lg font-bold tracking-tight">{{$dashboard->name}}</h5>
                                <p class="text-secondary mb-3 font-normal">{{$dashboard->description}}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="block lg:hidden px-4 pt-6 space-y-4">
            @foreach($group->dashboards as $dashboard)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <a href="{{ route('dashboard.show', $dashboard->id) }}"
                    class="h-[80%] flex flex-col bg-primary border border-gray-200 rounded-lg shadow-sm hover:bg-accent text-secondary transition duration-300 ease-in-out">
                        <img 
                            class="object-cover w-full rounded-t-lg h-[80%]"
                            src="https://api.apiflash.com/v1/urltoimage?access_key=9e53f2cbaeba44f6b5bcfa8782b0358b&wait_until=network_idle&url={{ $dashboard->link }}" 
                            alt="Website preview of {{ $dashboard->name }}" 
                        />
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="text-secondary mb-2 text-lg font-bold tracking-tight">{{ $dashboard->name }}</h5>
                            <p class="text-secondary mb-3 font-normal">{{ $dashboard->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-accent group-hover:bg-accent group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-secondary rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-accent group-hover:bg-accent group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-secondary rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

        </div>
    @endforeach

@endsection