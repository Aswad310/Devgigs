<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="//unpkg.com/alpinejs"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#38DB77",
                    },
                },
            },
        };
    </script>
    <style>
        input:focus{
            outline: none !important;
            border-color: #38DB77;
        }
    </style>
    <title>DevGigs</title>
</head>
<body class="mb-48" style="font-family: 'Poppins', sans-serif;">
    {{-- Navbar --}}
    <nav class="flex justify-between items-center mb-2 ">
        <a href="/"><img class="w-16" src="{{asset('images/steve-jobs.png')}}" alt="" class="logo"/></a>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
                <li>
                    <span class="font-bold uppercase">
                        Welcome {{auth()->user()->name}}
                    </span>
                </li>
                <li>
                    <a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Listings</a>
                </li>
                <li>
                    <form class="inline" method="POST" action="/logout">
                        @csrf
                        <button type="submit"><i class="fa-solid fa-door-closed"></i> Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
                </li>
            @endauth
        </ul>
    </nav>
    {{-- VIEW OUTPUT --}}
    <main class="bg-slate-50">
        {{$slot}}
    </main>
    {{-- Footer --}}
    <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-16 mt-24 opacity-90 md:justify-center">
{{--        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>--}}

        <a href="https://github.com/aswad310"><span class="text-black">&#169; 2022 Aswad310  </span><i class="fa-brands fa-github" style="color: black"></i></a>
        <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a>
    </footer>
    <x-flash-message />
</body>
</html>

