@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.contacts', $prospect->id)}}">Contacts</span></a></li>
@endsection

@section('sub-content')
    @permission('contacts.view')
        @include('prospects.prospect.view_sections.contacts')
        @permission('contacts.create')
            @include('contacts.create')
        @endpermission
    @else
        {{render_permission_error()}}
    @endpermission
@endsection
