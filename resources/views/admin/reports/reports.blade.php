@extends('admin.system')

@section('page-title', 'Reports')
@section('page-description', 'Reports.')

@section('extra-breadcrumbs')
    <li><a href="{{route('reports')}}">Reports</a></li>
@endsection

@section('sub-content')

    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:20px;">
                    <h3 class="panel-title">Reports</h3>
                </div>
                <div class="xe-body" role="tablist">
                    <ul class="list-unstyled">
                        @php
                        $count = 0;
                        @endphp
                    @foreach($reports as $report)
                            <li style="border-bottom: 1px solid #ededed; padding-bottom:5px; padding-bottom:5px;">
                                <a href="#{{$report->name}}" role="tab" data-toggle="tab">{{$report->title}}</a>
                            </li>
                            @php
                                $count++;
                            @endphp
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:20px;">
                    <h3 class="panel-title">Options</h3>
                </div>
                <div class="tab-content">
                    @php
                        $count = 0;
                    @endphp
                    @foreach($reports as $report)
                        <div role="tabpanel" class="tab-pane @if($count == 0) active @endif" id="{{$report->name}}">
                            {{$report->form()}}
                        </div>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
