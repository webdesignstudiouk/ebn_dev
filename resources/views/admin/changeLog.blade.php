@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-description', 'Dashboard')

@section('content')

    @role('admin')
    <div class="alert alert-info" style="background-color: #d9d9d9; border: none; color: #333;">
        New data import page on admin area has been created, <a style="color: #8dc63f"
                                                                href="{{route('process-prospects')}}">View Here.</a>
        {{--<hr style="border-top-color: #8dc63f">--}}
    </div>

    <div class="row">
        <h3 class="text-gray col-sm-12">Requested Deletes</h3>
        <div class="col-sm-3">
            @php
                $request_deletes_count = \App\Models\Prospects::where('request_delete', 1)->count();
                $request_deletes = \App\Models\Prospects::where('request_delete', 1)->get();
            @endphp
            <div class="xe-widget xe-counter-block">
                <div class="xe-lower">
                    <div class="xe-label">
                        <h2>{{$request_deletes_count}}</h2> <span>Requested Deletes</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:20px;">
                    <h3 class="panel-title">
                        Requested Deletes
                    </h3>
                </div>
                <form method="post" action="{{ route('prospects.deleteProspects') }}">
                    {{ csrf_field() }}
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID / Delete</th>
                            <th>User Requested Delete</th>
                            <th>Company</th>
                            </th>
                            <th>View Account</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($request_deletes as $prospect)
                            <tr>
                                <td>
                                    <span class="badge badge-warning">{{$prospect->typeTitle()}}</span> {{$prospect->id}}
                                    <input type="checkbox" name="prospectToDelete[]" value="{{ $prospect->id }}"
                                           style="float:right;"/>
                                </td>
                                <td style="border-left:1px solid #eee;">{{$prospect->user->first_name}} {{$prospect->user->second_name}}</td>
                                <td style="border-left:1px solid #eee;">{{$prospect->company}}</td>
                                <td style="border-left:1px solid #eee;"><a
                                            href="{{url('admin/prospects/'.$prospect->id.'/edit')}}">View Account</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><h5><strong>Reason</strong></h5>{{$prospect->deleted_reason}}</td>
                                <td><h5><strong>Custom Message</strong></h5> {{$prospect->deleted_reason_2}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><input type="submit" class="btn btn-info" style="width:100%;" name="send_back"
                                       value="Send Back To Agent"/></td>
                            <td><input type="submit" class="btn btn-danger" style="width:100%;" name="delete"
                                       value="Confirm Deletion"/></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    @endrole

    <div class="clearfix">
        @role('admin')
        {{--<h3 class="text-gray col-sm-12">Change log</h3>--}}
        {{--<div class="col-sm-4">--}}
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading" style="margin-bottom:20px;">--}}
        {{--<h3 class="panel-title">Change Log</h3>--}}
        {{--</div>--}}
        {{--<p>Everytime a change is added to the server, there will be an update here. Please check this to view the progress of the site.</p>--}}
        {{--<pre class="pre-line" style="white-space:normal; height:400px; overflow-y: scroll;">--}}
        {{--@foreach($commits as $commit)--}}
        {{--<b>{{ trim(\Carbon\Carbon::createFromFormat(DateTime::ISO8601, $commit['commit']['author']['date'])-> format('d/m/Y h:m')) }} </b>--}}
        {{--<br/>--}}
        {{--{{ $commit['commit']['message'] }}<br/><br/>--}}
        {{--@endforeach--}}
        {{--</pre>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<div class="col-sm-4">--}}
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading" style="margin-bottom:20px;">--}}
        {{--<h3 class="panel-title">Issues</h3>--}}
        {{--</div>--}}
        {{--<p>All issues are now stored on github (third party website), you can track bugs per release using this--}}
        {{--software.</p>--}}
        {{--<table class="table table-striped" style="height:400px; overflow-y: scroll;">--}}
        {{--<tbody>--}}
        {{--@foreach($issues as $issue)--}}
        {{--<tr>--}}
        {{--<td>--}}
        {{--<b>{{ trim(\Carbon\Carbon::createFromFormat(DateTime::ISO8601, $issue['created_at'])-> format('d/m/Y h:m')) }}</b><br/>--}}
        {{--{{ $issue['body'] }}--}}
        {{--</td>--}}
        {{--<td><a href="{{ $issue['html_url'] }}" target="_blank" style="float:right;"><i--}}
        {{--class="fa fa-search btn btn-icon btn-success"></i></a></td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
        {{--</table>--}}
        {{--</div>--}}
        {{--<a href="https://github.com/webdesignstudiouk/ebn_dev/issues/new" target="_blank" class="btn btn-warning"--}}
        {{--style="width:100%;">Create Bug</a>--}}
        {{--<a href="https://github.com/webdesignstudiouk/ebn_dev/issues?utf8=%E2%9C%93&q=is%3Aissue%20is%3Aclosed"--}}
        {{--target="_blank" class="btn btn-info" style="width:100%; margin-left:0px;">View Closed Bugs</a>--}}
        {{--</div>--}}

        {{--<div class="col-sm-4">--}}
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading" style="margin-bottom:20px;">--}}
        {{--<h3 class="panel-title">New Features</h3>--}}
        {{--</div>--}}
        {{--<p>You can now add new features that you want to the site using the link below, all new features can be--}}
        {{--tracked.</p>--}}
        {{--<table class="table table-striped" style="min-height:200px; overflow-y: scroll;">--}}
        {{--<tbody>--}}
        {{--@foreach($cards as $card)--}}
        {{--<tr>--}}
        {{--<td>--}}
        {{--<b>{{ trim(\Carbon\Carbon::createFromFormat(DateTime::ISO8601, $card['created_at'])-> format('d/m/Y h:m')) }}</b><br/>--}}
        {{--{{ $card['note'] }}--}}
        {{--</td>--}}
        {{--<td><a href="https://github.com/webdesignstudiouk/ebn_dev/projects/1" target="_blank"--}}
        {{--style="float:right;"><i class="fa fa-search btn btn-icon btn-success"></i></a></td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
        {{--</table>--}}
        {{--</div>--}}
        {{--<a href="https://github.com/webdesignstudiouk/ebn_dev/projects/1" target="_blank" class="btn btn-success"--}}
        {{--style="width:100%;">Create New Feature</a>--}}
        {{--</div>--}}

        @else

            <div class="row" style="clear: both;">
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="margin-bottom:20px;">
                            <h3 class="panel-title">Account Details</h3>
                        </div>
                        <p>Any technical issues or bugs please email <a href="mailto:admin@webdesignstudiouk.com">admin@webdesignstudiouk.com</a>
                        </p>
                        <table class="table table-striped" style="height:400px; overflow-y: scroll;">
                            <tbody>
                            <tr>
                                <td><b>ID</b></td>
                                <td>{{Auth::user()->id}}</td>
                            </tr>
                            <tr>
                                <td><b>Group ID</b></td>
                                <td>{{Auth::user()->group_id}}</td>
                            </tr>
                            <tr>
                                <td><b>Group Name</b></td>
                                <td>{{Auth::user()->group->name}}</td>
                            </tr>
                            <tr>
                                <td><b>First Name</b></td>
                                <td>{{Auth::user()->first_name}}</td>
                            </tr>
                            <tr>
                                <td><b>Last Name</b></td>
                                <td>{{Auth::user()->second_name}}</td>
                            </tr>
                            <tr>
                                <td><b>Email</b></td>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @endrole

            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="margin-bottom:20px;">
                            <h3 class="panel-title">LOA Report - Prospect 1's</h3>
                        </div>
                        @php
                        $prospect_loa_recieved = App\Models\Prospects::where('type_id', 1)->where('user_id', Auth::user()->id)->where('loa_recieved', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#loaRecieved">
                                    <strong class="num">{{count($prospect_loa_recieved)}}</strong> <span>LOA Recieved</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="loaRecieved">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_loa_recieved as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $prospect_business_won = App\Models\Prospects::where('type_id', 1)->where('user_id', Auth::user()->id)->where('loa_business_won', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#businessWon">
                                    <strong class="num">{{count($prospect_business_won)}}</strong> <span>Business Won</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="businessWon">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_business_won as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $prospect_business_lost = App\Models\Prospects::where('type_id', 1)->where('user_id', Auth::user()->id)->where('loa_business_lost', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#businessLost">
                                    <strong class="num">{{count($prospect_business_lost)}}</strong> <span>Business Lost</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="businessLost">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_business_lost as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $prospect_pending = App\Models\Prospects::where('type_id', 1)->where('user_id', Auth::user()->id)->where('loa_pending', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#loaPending">
                                    <strong class="num">{{count($prospect_pending)}}</strong> <span>LOA Pending</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="loaPending">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_pending as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="margin-bottom:20px;">
                            <h3 class="panel-title">LOA Report - Prospect 2's</h3>
                        </div>
                        @php
                            $prospect_loa_recieved = App\Models\Prospects::where('type_id', 2)->where('user_id', Auth::user()->id)->where('loa_recieved', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#loaRecieved_2">
                                    <strong class="num">{{count($prospect_loa_recieved)}}</strong> <span>LOA Recieved</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="loaRecieved_2">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_loa_recieved as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $prospect_business_won = App\Models\Prospects::where('type_id', 2)->where('user_id', Auth::user()->id)->where('loa_business_won', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#businessWon_2">
                                    <strong class="num">{{count($prospect_business_won)}}</strong> <span>Business Won</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="businessWon_2">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_business_won as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $prospect_business_lost = App\Models\Prospects::where('type_id', 2)->where('user_id', Auth::user()->id)->where('loa_business_lost', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#businessLost_2">
                                    <strong class="num">{{count($prospect_business_lost)}}</strong> <span>Business Lost</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="businessLost_2">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_business_lost as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $prospect_pending = App\Models\Prospects::where('type_id', 2)->where('user_id', Auth::user()->id)->where('loa_pending', 1)->get();
                        @endphp
                        <div class="xe-widget xe-counter">
                            <div class="xe-label">
                                <a role="button" data-toggle="collapse" href="#loaPending_2">
                                    <strong class="num">{{count($prospect_pending)}}</strong> <span>LOA Pending</span>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="loaPending_2">
                            <table class="table table-striped floatThead-table">
                                <tbody>
                                @foreach($prospect_pending as $prospect)
                                    <tr>
                                        <td>{{$prospect->company}}</td>
                                        <td><a href="{{route('prospects.edit', $prospect->id)}}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
    </div>

@endsection