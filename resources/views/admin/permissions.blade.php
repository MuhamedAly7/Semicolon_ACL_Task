@extends('layout.sidebar')

@section('title', 'Manage Permissions')

@section('content')
<h2 class="page-title">Manage Permissions</h2>

<form action="{{ route('permissions.manage') }}" method="GET" class="controller-form">
    <select name="controller_name" id="controller_name" class="form-control controller-dropdown" onchange="this.form.submit()">
        <option value="">Select Controller</option>
        @foreach($controllers as $controller)
            <option value="{{ $controller }}" {{ request()->controller_name == $controller ? 'selected' : '' }}>
                {{ $controller }}
            </option>
        @endforeach
    </select>
</form>

@if(request()->controller_name)
<table class="table permissions-table">
    <thead>
        <tr>
            <th class="table-header">Controller Name</th>
            <th class="table-header">Method Name</th>
            <th class="table-header">Groups</th>
            <th class="table-header">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($methods as $method)
            <tr class="permissions-row">
                <td class="controller-name">{{ request()->controller_name }}</td>
                <td class="method-name">{{ $method->method_name }}</td>
                <td class="group-checkboxes">
                    <!-- Each row has its own form -->
                    <form class="group-checkboxes" action="{{ route('permissions.save') }}" method="POST" class="permissions-form">
                        @csrf
                        <input type="hidden" name="controller_name" value="{{ request()->controller_name }}">
                        <input type="hidden" name="method_id" value="{{ $method->id }}">
                        
                        @foreach($groups as $group)
                            <label class="group-label">
                                <input type="checkbox" class="group-checkbox" name="permissions[{{ $method->id }}][]" value="{{ $group->id }}"
                                    {{ $group->permissions->contains($method) ? 'checked' : '' }}>
                                {{ $group->name }}
                            </label>
                        @endforeach
                        
                        <td class="action-cell">
                            <button type="submit" class="btn btn-primary save-button">Save</button>

                            @if(session('success') && session('updated_method_id') == $method->id)
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </td>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
