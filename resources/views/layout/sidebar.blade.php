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
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>
    <div class="container">
        <div class="sidebar">
            <h2>Navigation</h2>
            <a href="{{ route('admin.dashboard') }}">dashboard</a>
            <a href="{{ route('admin.group.index') }}">groups</a>
            <a href="{{ route('admin.group.add') }}">Add new group</a>
            <a href="{{ route('admin.user.add') }}">Add new user</a>
            <a href="{{ route('permissions.manage') }}">Permissions</a>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
</html>
