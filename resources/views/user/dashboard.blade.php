@extends('layout.user_sidebar')

@section('title', 'User Dashboard')

@section('content')
    <h1>User Dashboard</h1>
    <h3>Welcome, {{ $user->name }}</h3>

    <h2>Permitted Methods</h2>
    @if ($permissions->isEmpty())
        <p>You have no assigned permissions.</p>
    @else
        <table class="permission-table">
            <thead>
                <tr>
                    <th>Controller Name</th>
                    <th>Method Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->controller_name }}</td>
                        <td>{{ $permission->method_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
