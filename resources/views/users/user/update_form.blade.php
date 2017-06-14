@extends('users.user')

@section('extra-breadcrumbs')
<li><a href="{{route('users.edit', $user->id)}}">User Detail</a></li>
@endsection

@section('sub_content')
    <div class="alert alert-info fade in alert-dismissable" style="margin-top:18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        Please only put something in the password field if you want to change this users password. Otherwise leave blank.
    </div>
  {!! form($updateForm) !!}
@endsection
