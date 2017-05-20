@extends('users.user')

@section('extra-breadcrumbs')
<li><a href="{{route('users.edit', $user->id)}}">User Detail</a></li>
@endsection

@section('sub_content')
  {!! form($updateForm) !!}
@endsection
