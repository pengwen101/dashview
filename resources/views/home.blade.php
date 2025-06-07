@extends('layout')

@section('content')



@foreach($dashboardGroups as $group)
<div class="min-h-screen flex flex-col items-center">

    <div class="w-fit uppercase text-secondary !bg-accent px-4 py-2 text-5xl font-semibold mb-10">
        {{$group->name}}
    </div>

    <div id="default-carousel" class="relative w-full" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-[55vh] overflow-hidden lg:h-[65vh] rounded-lg bg-secondary">
            <div id = "carousel-laptop-view" class = "hidden lg:block">
                @foreach($group->dashboards->chunk(3) as $chunk)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="grid grid-cols-3 gap-4 h-full px-10 pt-10 pb-14">
                        @foreach($chunk as $dashboard)
                        <a href="{{route('dashboard.show', $dashboard->id)}}"
                            class="flex flex-col bg-primary border border-gray-200 rounded-lg shadow-sm md:max-w-md max-h-96 hover:bg-accent text-secondary transition duration-300 ease-in-out">
                            <img class="object-cover w-full rounded-t-lg h-[80%]"
                                src="https://api.apiflash.com/v1/urltoimage?access_key=9e53f2cbaeba44f6b5bcfa8782b0358b&wait_until=network_idle&url={{ $dashboard->link }}"
                                alt="Website preview of {{ $dashboard->name }}" />
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class=" text-secondary mb-2 text-lg font-bold tracking-tight">{{$dashboard->name}}
                                </h5>
                                <p class="text-secondary mb-3 font-normal">{{$dashboard->description}}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div id = "carousel-mobile-view" class="block lg:hidden">
                @foreach($group->dashboards as $dashboard)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class = "px-10 pt-6 pb-14 h-full">
                        <a href="{{ route('dashboard.show', $dashboard->id) }}"
                            class="h-full flex flex-col bg-primary border border-gray-200 rounded-lg shadow-sm hover:bg-accent text-secondary transition duration-300 ease-in-out">
                            <img class="object-cover w-full rounded-t-lg h-[80%]"
                                src="https://api.apiflash.com/v1/urltoimage?access_key=9e53f2cbaeba44f6b5bcfa8782b0358b&wait_until=network_idle&url={{ $dashboard->link }}"
                                alt="Website preview of {{ $dashboard->name }}" />
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="text-secondary mb-2 text-lg font-bold tracking-tight">{{ $dashboard->name }}</h5>
                                <p class="text-secondary mb-3 font-normal">{{ $dashboard->description }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
        <!-- Slider indicators -->
        <div class="relative w-full h-full">
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <div id = "button-laptop-view" class = "hidden lg:block">
                    @foreach($group->dashboards->chunk(3) as $index => $chunk)
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                    @endforeach
                </div>
                <div id = "button-mobile-view" class = "block lg:hidden">
                    @foreach($group->dashboards as $index => $dashboard)
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-accent group-hover:bg-accent group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-secondary rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-accent group-hover:bg-accent group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-secondary rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

</div>
@endforeach

@endsection

@section('library-js')

<script>
    if (window.innerWidth < 1024) {
        const carousel = document.querySelector('#carousel-laptop-view');
        console.log(carousel);
        carousel.remove();

        document.querySelector('#button-laptop-view').remove();
    }else{
        const carousel = document.querySelector('#carousel-mobile-view');
        console.log(carousel);
        carousel.remove();
        document.querySelector('#button-mobile-view').remove();
    }


</script>


@endsection