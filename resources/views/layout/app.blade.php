<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, minimum-scale=1">
        @stack('styles')
        @stack('scripts')
        @yield('title')
    </head>
    <body>
        @yield('content')
    </body>
</html>
