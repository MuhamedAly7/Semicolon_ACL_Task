<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{asset('css/dashboard_style.css')}}">
</head>
<body>
    <header>
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>
    <div class="container">
        <div class="sidebar">
            <h2>Navigation</h2>
            <a href="{{ route('user.dashboard') }}">dashboard</a>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
</html>
