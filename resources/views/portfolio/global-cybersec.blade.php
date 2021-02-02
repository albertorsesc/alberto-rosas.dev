@extends('layouts.guest')

@section('content')
    <a href="https://globalcybersec.com/" target="_blank">
        <div class="bg-white mt-2 md:mt-0 inline-block items-center text-center shadow-md rounded-lg b-transition hover:b-transform hover:shadow-xl">
            <img src="/img/companies/global-cybersec.png" class="object-cover object-center w-72 h-40 sm:w-80 md:w-96 md:h-44 rounded-lg" alt="">
        </div>
    </a>

    <div class="mb-20 md:mb-0 my-6 w-full md:w-1/2 md:flex-wrap md:justify-start items-center mx-auto text-gray-600 font-bold text-xl">
        <div class="mx-4 text-justify">
            Global Cybersec is a Managed Security Service Provider (MSSP) and the first private CSIRT (Computer Security Incident Response Team)
            in obtaining international certifications based in Mexico City.
            Providing services from network monitoring and incident response team (BlueTeam) to Penetration testing/Ethical Hacking (RedTeam),
            hardening and many other managed services related to Cybersecurity.
        </div>

        <div class="mx-4 text-justify mt-6 md:mt-4">
            As the head of internal applications development (YellowTeam; 3 developers) I created a main app used for
            storing and securing common data as well as a permission's panel for accessing child applications:
            <div class="my-2">
                <p>&bullet; GCS-IRM (Incident Response Manager),</p>
                <p>&bullet; GCS-Helpedesk (Internal Ticket System),</p>
                <p>&bullet; and Legacy IRM.</p>
            </div>
        </div>

        <div class="mx-4 text-justify mt-6 md:mt-4">
            As of today I continue to provide my services as a contractor due to the need for other internal applications
            which has led me to increase my information security experience and helped me leverage cybersecurity
            in every project I work on.
        </div>
    </div>
@endsection
