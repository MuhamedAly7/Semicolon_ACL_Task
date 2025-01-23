@extends('layout.sidebar')

@section('title', 'Dashboard')

@section('content')
    <h1>Admin Dashboard</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Groups</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        @foreach ($user->groups as $group)
                            <span class="badge">{{ $group->name }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user) }}" class="action-button edit">Edit</a>
                        <form method="POST" action="{{ route('admin.user.delete', $user) }}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $users->links() }}
    </div>
@endsection
