@extends('admin.system')

@section('page-title', 'Roles')
@section('page-description', 'Roles.')

@section('extra-breadcrumbs')
    <li><a href="{{route('dashboard')}}">Agent</a></li>
    <li><a href="{{route('options')}}">System Options</a></li>
    <li><a href="{{route('roles')}}">Roles</a></li>
@endsection

@section('sub-content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">Roles</h3>
        </div>

        <table class="table table-striped ahref">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>View Account</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role['id']}}</td>
                    <td>{{$role['name']}}</td>
                    <td><a href="{{route('roles.edit', $role['id'])}}">View Account</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
