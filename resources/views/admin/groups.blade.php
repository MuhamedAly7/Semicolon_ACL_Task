@extends('layout.sidebar')

@section('title', 'Groups')

@section('content')
    <h1>Groups</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="styled-table">
        <thead>
            <tr>
                <th>Group Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->name }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.group.delete', $group->id) }}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button delete" onclick="return confirm('Are you sure you want to delete this group?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
