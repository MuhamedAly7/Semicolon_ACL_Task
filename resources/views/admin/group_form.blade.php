@extends('layout.sidebar')

@section('title', 'New Group')

@section('content')
    <div class="add_group">
        <h1>Add New Group</h1>
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.group.store') }}">
            @csrf
            <input class="group_name" type="text" name="group_name" placeholder="group name" required>
            <button class="save" type="submit">Save</button>
        </form>
    </div>
@endsection