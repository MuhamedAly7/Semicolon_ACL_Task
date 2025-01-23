@extends('layout.sidebar')

@section('title', 'Edit User')

@section('scripts')
<script src="{{ asset('js/select_edit_user.js') }}"></script>
@endsection

@section('content')
<div class="add_user">
    <h1>Edit User</h1>
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
    <form class="add_user" method="POST" action="{{ route('admin.user.update', $user->id) }}">
        @csrf
        @method('PATCH')
        <label>username</label>
        <input class="user_name" type="text" name="name" placeholder="Username" value="{{ $user->name }}" required>
        {{-- <input class="user_email" type="email" name="email" placeholder="Email" value="{{ $user->email }}" required> --}}
        {{-- <input class="user_password" type="password" name="password" placeholder="Password"> --}}
        {{-- <input class="user_password" type="password" name="password_confirmation" placeholder="Password Confirmation"> --}}

        <div class="group-selection">
            <label for="group-select">Select Group:</label>
            <select class="group_select" id="group-select" name="group">
                <option value="" disabled selected>Choose a group</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            <button class="add_group" type="button" id="add-group">Add Group</button>
        </div>

        <div class="selected-groups">
            <h4>Selected Groups:</h4>
            <ul id="selected-groups-list">
                @foreach ($user->groups as $group)
                    <li data-group-id="{{ $group->id }}">
                        {{ $group->name }}
                        {{-- <button type="button" class="remove-group">Remove</button> --}}
                    </li>
                @endforeach
            </ul>
        </div>

        <input type="hidden" id="group-ids" name="group_ids" value="{{ $user->groups->pluck('id')->join(',') }}">

        <button class="save" type="submit">Submit</button>
    </form>
</div>
@endsection
