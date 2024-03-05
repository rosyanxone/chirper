<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- pusher --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        let token = document.querySelector('meta[name="csrf-token"]').content;

        var pusher = new Pusher('{!! env('PUSHER_APP_KEY') !!}', {
            cluster: "ap1",
            channelAuthorization: {
                endpoint: "/broadcasting/auth",
                headers: { "X-CSRF-Token": token },
            },
        });

        const userId = {!! json_encode(Auth::user()->id) !!}
        var channel = pusher.subscribe(`private-App.Models.User.${userId}`);
        channel.bind("chirp-event", function (data) {
            alert(data.chirp.message + " at " + data.chirp.created_at);
        });
    </script>

    {{-- echo --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.16.0/echo.js"></script> --}}
    <script>
        // const Echo = new Echo({
        //     broadcaster: "pusher",
        //     key: "db7f0a566972cb492eac",
        //     cluster: "ap1",
        //     forceTLS: true,
        //     authEndpoint: "/broadcasting/auth",
        //     enabledTransports: ["ws", "wss"],
        // });
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
