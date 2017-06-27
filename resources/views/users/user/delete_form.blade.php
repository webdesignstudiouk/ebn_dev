@extends('users.user')

@section('extra-breadcrumbs')
<li><a href="{{route('user.delete', $user->id)}}">Delete User</a></li>
@endsection

@section('sub_content')
  {!! form($deleteForm) !!}
@endsection
