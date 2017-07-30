@extends('prospects.prospect.site')

@section('extra-breadcrumbs')
<li><a href="{{route('prospects.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Site Details</span></a></li>
@endsection

@section('sub-content')
    @include('sites.update')
@endsection
