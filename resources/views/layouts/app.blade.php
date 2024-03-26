{{-- app --}}
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    @yield('custom-css')
</head>
<body>
    @include('layouts.navbar')
    @include('layouts.script')
    @yield('content')
</body>
</html>
