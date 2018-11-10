@extends('ceds.timeline-admin')

@section('page-title', $title)
@section('page-description', 'List Of all ceds.')

@section('extra-breadcrumbs')

@endsection
@section('content')
    <div class="row">
        <div class="col-sm-3">
            <div class="xe-widget xe-counter" style="text-align: center;">
                <div class="xe-label">
                    <strong class="num">{{count($data)}}</strong>
                    <span>Totla Verbal CED's</span>
                </div>
            </div>
        </div>
        @foreach($counts['traffic_lights'] as $count_key => $count)
            <div class="col-sm-3">
                <div class="xe-widget xe-counter" style="text-align: center; border-bottom: 2px solid {{($count_key == 'danger' ? '#cc3f44' : ($count_key == 'warning' ? '#ffba00' : '#a6ce39'))}};">
                    <div class="xe-label">
                        <strong class="num">{{count($counts['traffic_lights'][$count_key]['prospects'])}}</strong>
                        <span>{{$counts['traffic_lights'][$count_key]['description']}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="panel panel-default">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Agent</th>
                    <th>Verbal CED</th>
                    <th></th>
                    <th></th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $d)
                    <tr>
                        <td>{{$d['id']}}</td>
                        <td>{{$d['company']}}</td>
                        <td>{{$d['agent']}}</td>
                        <td>{{$d['verbal_ced']}}</td>
                        @if($d['verbal_ced_is_past'])
                            <td></td>
                        @else
                            <td><span class="badge">{{ $d['verbal_ced_diff_in_days'] }} Until End Date</span></td>
                        @endif
                        <td><span class="badge badge-{{$d['verbal_ced_traffic_light']}}">o</span></td>
                        <td><a href='{{route('prospects.edit', $d['id'])}}'>View Account</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
