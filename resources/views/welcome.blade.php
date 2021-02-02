@extends('layouts.guest')

@section('content')
    <div class="-mt-4 mb-4 md:mb-8 inline-block text-center shadow-md rounded-full">
        <img src="/me.jpg" class="object-cover w-40 h-40 md:w-52 md:h-52 rounded-full" alt="">
    </div>

    <div class="w-full">
        <span class="text-2xl font-bold" style="color: #387F4B">Who am I</span>

        <div class="mt-4 mb-48 md:mb-0 w-full md:w-1/3 md:flex-wrap md:justify-start items-center mx-auto font-bold text-xl" style="color: #337545">
            <div class="mx-4 text-justify">
                I am a Fullstack PHP developer that loves to create awesome web applications in particular
                for companies that want to optimize and secure their processes and obtain control of their assets.
            </div>
        </div>

        <div class="mb-10 md:mb-16 flex justify-center absolute inset-x-0 bottom-0 b-transition hover:b-transform"
             :class="[isOpen ? 'ml-10 md:ml-0 fixed z-10' : '']">
            <a href="https://github.com/albertorsesc"
               class="mr-4"
               title="Alberto's Github Repositories"
               target="_blank">
                <i class="fab fa-github text-5xl"></i>
            </a>
            <a href="https://exam.laravelcert.com/is/alberto-rosas-escareno/certified-since/2020-11-25"
               class="mr-4"
               title="Alberto's Laravel Certification"
               target="_blank">
                <img src="https://laravel.com/img/logomark.min.svg" class="w-12 h-12" alt="">
            </a>
            <a href="https://www.linkedin.com/in/albertorsesc/"
               class="mr-3"
               title="Alberto's LinkedIn Profile"
               target="_blank">
                <i class="fab fa-linkedin-in text-blue-600 text-5xl"></i>
            </a>
            <a href="https://twitter.com/bcryp7"
               title="Alberto's Twitter Account"
               target="_blank">
                <i class="fab fa-twitter text-blue-400 text-5xl"></i>
            </a>
        </div>
    </div>
@endsection
