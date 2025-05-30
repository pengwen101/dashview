@extends('layout')
@section('content')


<div class ="flex flex-col items-center justify-center h-screen my-[-120px]">
    <div class="text-4xl font-bold mb-6">Welcome</div>
    <div class="text-lg mb-4">Please login to continue</div>
    <a href= "{{ route('google.auth') }}" class = "shadow-md rounded-full bg-accent text-secondary px-6 py-2 font-semibold text-3xl" data-aos="zoom-in" data-aos-delay="1000">
        Login with Google
    </a>

@endsection