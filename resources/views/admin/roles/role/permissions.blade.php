@extends('admin.roles.role')

@section('page-title', 'Roles')
@section('page-description', 'Role - Permissions.')

@section('extra-breadcrumbs')
    <li><a href="#">Permissions</a></li>
@endsection

@section('sub-content')
    @foreach($permissionModel->groupBy('group_id')->select('group_id')->get() as $permission)
        @if($permission->group->hidden == 0)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$permission->group_id}}" aria-expanded="false" aria-controls="collapseOne">
                            #{{$permission->group->id}} - {{$permission->group->name}} Permissions
                        </a>
                    </h4>
                </div>
                <div id="collapse_{{$permission->group_id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Has Permission</th>
                                <th>Name</th>
                                <th>Slug</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{Form::open(['route'=> 'permissions.update', 'method'=>'post'])}}
                            {{Form::token()}}
                            {{Form::input('hidden', 'group_id', $permission->group_id)}}
                            {{Form::input('hidden', 'role_id', $role->id)}}
                            @foreach($permissionModel->where('group_id', $permission->group_id)->orderBy('slug')->get() as $group_permission)
                                <tr class='!clickable-row' style='cursor:pointer' data-href="{{url('admin/roles/'.$role->id.'/permissions/'.$group_permission->id)}}">
                                    <td>
                                        <div class="form-group">
                                            @php $found = false; @endphp
                                            @foreach($role->permissions->toArray() as $check_permission)
                                                @if($group_permission->id == $check_permission['pivot']['permission_id'])
                                                    @php
                                                        $found = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if($found)
                                                <input class="iswitch iswitch-secondary"
                                                       id="hasPermission"
                                                       checked="checked"
                                                       name="permission[{{$group_permission->id}}]"
                                                       type="checkbox"
                                                       value="1">
                                            @else
                                                <input class="iswitch iswitch-secondary"
                                                       id="hasPermission"
                                                       name="permission[{{$group_permission->id}}]"
                                                       type="checkbox"
                                                       value="1">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$group_permission->name}}</td>
                                    <td>{{$group_permission->slug}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{Form::submit('Update Permissions', ['class'=>'btn btn-success', 'style'=>'width:100%;'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading" style="margin-bottom:20px;">--}}
    {{--<h3 class="panel-title">--}}
    {{--<b>Add Permission</b>--}}
    {{--</h3>--}}
    {{--</div>--}}
    {{--{{Form::open(['route' => ['permissions.add', $role->id],'method'=>'post'])}}--}}
    {{--{{Form::token()}}--}}
    {{--{{Form::input('hidden','role_id', $role->id)}}--}}
    {{--<div class="form-group">--}}
    {{--<label for="name" class="control-label">Permission</label>--}}
    {{--{{Form::select('permission_id', $permissions, null, ['class'=>'form-control'])}}--}}
    {{--</div>--}}
    {{--{{Form::input('submit', 'Add Permission', null, ['class'=>'btn btn-success'])}}--}}
    {{--{{Form::close()}}--}}
    {{--</div>--}}

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>Create Permission</b>
            </h3>
        </div>
        {{Form::open(['route'=> 'permissions.create', 'method'=>'post'])}}
        {{Form::token()}}
        {{Form::input('hidden','role_id', $role->id)}}
        <div class="form-group">
            <label for="group_id" class="control-label">Group ID</label>
            {{Form::input('text','group_id', null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            {{Form::input('text','name', null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Slug</label>
            {{Form::input('text','slug', null, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Description</label>
            {{Form::input('text','description', null, ['class'=>'form-control'])}}
        </div>
        {{Form::input('submit', 'Create Permission', null, ['class'=>'btn btn-success'])}}
        {{Form::close()}}
    </div>
@endsection
