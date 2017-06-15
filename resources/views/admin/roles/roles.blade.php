@extends('admin.system')

@section('page-title', 'Roles')
@section('page-description', 'Roles.')

@section('extra-breadcrumbs')
    <li><a href="{{route('roles')}}">Roles</a></li>
@endsection

@section('sub-content')
{{var_dump($roles)}}
@endsection
