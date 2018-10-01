@extends('prospects.prospect')

@section('extra-breadcrumbs')
    <li><a href="{{route('prospect.loa_report', $prospect->id)}}">LOA Report</a></li>
@endsection

@section('sub-content')
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            @if(isset($prospect->current_loa) && $prospect->current_loa != null)
                <li class="active"><a href="#currentLoas" role="tab" data-toggle="tab">Current Loa's</a></li>
            @endif
            <li class=""><a href="#archivedLoas" role="tab" data-toggle="tab">Archived Loa's</a></li>
            <li class=""><a href="#archivedLoas" role="tab" data-toggle="tab">LOA Report</a></li>
            <li class=""><a href="#uploadLoa" role="tab" data-toggle="tab">Upload Loa</a></li>
        </ul>
    </nav>

@endsection
