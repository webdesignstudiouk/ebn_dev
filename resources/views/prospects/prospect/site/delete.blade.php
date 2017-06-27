@extends('prospects.prospect.site')

@section('extra-breadcrumbs')
<li><a href="{{route('site.delete', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Delete Site</span></a></li>
@endsection

@section('sub-content')
{!! form($deleteSiteForm)!!}
@endsection
