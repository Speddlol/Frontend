
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-1WpdEfwIuvfgzJmBjK8UGl5X5v5x+jZ5Qj1i8DGwWQQLvCjKt/ybbJtj8bPss3qpr/7A1jbmGzMmjEpAz+fK3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap');

       
            body {
                    min-height:calc(100vh);
                    background:#3b3b47;
                    background:-moz-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);
                    background:-webkit-gradient(left top,left bottom,color-stop(0,#202027),color-stop(19%,#202027),color-stop(50%,#3e3e4a),color-stop(80%,#202027),color-stop(100%,#202027));
                    background:-webkit-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);background:-o-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);background:-ms-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%)}@media (max-width:767px){body{-webkit-user-select:none;
                    -webkit-tap-highlight-color:transparent;-webkit-touch-callout:none}}img{max-width:100%
                    }
                    </style>
    </head>


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
