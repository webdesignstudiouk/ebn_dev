@extends('admin.roles.role')

@section('page-title', 'Roles')
@section('page-description', 'Roles.')

@section('extra-breadcrumbs')
    <li><a href="#">Edit</a></li>
@endsection

@section('sub-content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>Edit {{$role->name}}</b>
            </h3>
        </div>
        {{Form::open([route('roles.update',$role->id), 'method'=>'post'])}}
        {{Form::input('hidden','role_id', $role->id, ['class'=>'form-control'])}}
        {{Form::token()}}
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            {{Form::input('text', 'name', $role->name, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Slug</label>
            {{Form::input('text', 'slug', $role->slug, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Description</label>
            {{Form::textarea('description', $role->description, ['class'=>'form-control', 'rows'=>'2'])}}
        </div>


        {{Form::input('submit', 'Update Role', null, ['class'=>'btn btn-success'])}}

        {{Form::close()}}
    </div>
@endsection


