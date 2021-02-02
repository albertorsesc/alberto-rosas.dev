@extends('layouts.guest')

@section('content')
    <div class="my-10 mt-20 md:mt-0">
        <span class="text-3xl md:text-5xl text-gray-900 font-semibold">Companies I've worked with/for</span>
    </div>
    <div class="md:flex">
        <a href="{{ route('portfolio.gt-transport') }}" class="md:mr-4">
            <div class="md:mt-0 inline-block bg-white shadow items-center text-center shadow-md rounded-lg py-5 px-16 b-transition hover:b-transform hover:shadow-xl">
                <img src="/img/companies/gt-transport.png" class="object-contain bottom-0 w-52 h-52" alt="">
                <span class="text-3xl font-semibold text-gray-800">GT Transport</span>
                <p class="mt-2 text-xl font-light text-gray-800">Admin web app</p>
            </div>
        </a>
        <a href="{{ route('portfolio.global-cybersec') }}" class="md:mr-4">
            <div class="mt-4 md:mt-0 inline-block bg-white shadow items-center align-middle text-center shadow-md rounded-lg py-5 px-16 b-transition hover:b-transform hover:shadow-xl">
                <img src="/img/companies/global-cybersec.png" class="object-cover object-center bottom-0 w-52 h-52" alt="">
                <span class="text-3xl font-semibold text-gray-800">Global Cybersec</span>
                <p class="mt-2 text-xl font-light text-gray-800">Ecosystem of web apps</p>
            </div>
        </a>
        <a href="{{ route('portfolio.fulcrum-digital') }}" class="md:mr-4">
            <div class="mt-4 md:mt-0 inline-block bg-white shadow items-center text-center shadow-md rounded-lg py-5 px-16 b-transition hover:b-transform hover:shadow-xl">
                <img src="/img/companies/fulcrum-digital.jpeg" height="200" class="object-contain bottom-0 w-52 h-52 py-10" alt="">
                <span class="text-3xl font-semibold text-gray-800">Fulcrum Digital</span>
                <p class="mt-2 text-xl font-light text-gray-800">Medical System</p>
            </div>
        </a>
    </div>
@endsection
