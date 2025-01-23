@extends('layout.sidebar')

@section('title', 'New User')

@section('scripts')
<script src="{{asset('js/select_user.js')}}"></script>
@endsection


@section('content')
    <div class="add_user">
        <h1>Add New User</h1>
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
        <form class="add_user" method="POST" action="{{ route('admin.user.store') }}">
            @csrf
            <input class="user_name" type="text" name="name" placeholder="Username" required>
            <input class="user_email" type="email" name="email" placeholder="Email" required>
            <input class="user_password" type="password" name="password" placeholder="Password" required>
            <input class="user_password" type="password" name="password_confirmation" placeholder="Password Confirmation" required>

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
                </ul>
            </div>

            <input type="hidden" id="group-ids" name="group_ids" value="">

            <button class="save" type="submit">Save</button>
        </form>
    </div>
@endsection
