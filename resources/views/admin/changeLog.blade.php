@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-description', 'Dashboard')

@section('content')

    @role('admin')
    <div class="alert alert-info" style="background-color: #d9d9d9; border: none; color: #333;">
        New data import page on admin area has been created, <a style="color: #8dc63f" href="{{route('process-prospects')}}">View Here.</a>
        {{--<hr style="border-top-color: #8dc63f">--}}
    </div>
    @endrole

    <div class="clearfix">

        @role('admin')
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:20px;">
                    <h3 class="panel-title">Change Log</h3>
                </div>
                <p>Everytime a change is added to the server, there will be an update here. Please check this to view
                    the progress of the site.</p>
                <pre class="pre-line" style="white-space:normal; height:400px; overflow-y: scroll;">
            @foreach($commits as $commit)
                        <b>{{ trim(\Carbon\Carbon::createFromFormat(DateTime::ISO8601, $commit['commit']['author']['date'])-> format('d/m/Y h:m')) }} </b>
                        <br/>
                        {{ $commit['commit']['message'] }}<br/><br/>
                    @endforeach
        </pre>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:20px;">
                    <h3 class="panel-title">Issues</h3>
                </div>
                <p>All issues are now stored on github (third party website), you can track bugs per release using this
                    software.</p>
                <table class="table table-striped" style="height:400px; overflow-y: scroll;">
                    <tbody>
                    @foreach($issues as $issue)
                        <tr>
                            <td>
                                <b>{{ trim(\Carbon\Carbon::createFromFormat(DateTime::ISO8601, $issue['created_at'])-> format('d/m/Y h:m')) }}</b><br/>
                                {{ $issue['body'] }}
                            </td>
                            <td><a href="{{ $issue['html_url'] }}" target="_blank" style="float:right;"><i
                                            class="fa fa-search btn btn-icon btn-success"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="https://github.com/webdesignstudiouk/ebn_dev/issues/new" target="_blank" class="btn btn-warning"
               style="width:100%;">Create Bug</a>
            <a href="https://github.com/webdesignstudiouk/ebn_dev/issues?utf8=%E2%9C%93&q=is%3Aissue%20is%3Aclosed"
               target="_blank" class="btn btn-info" style="width:100%; margin-left:0px;">View Closed Bugs</a>
        </div>

        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="margin-bottom:20px;">
                    <h3 class="panel-title">New Features</h3>
                </div>
                <p>You can now add new features that you want to the site using the link below, all new features can be
                    tracked.</p>
                <table class="table table-striped" style="height:400px; overflow-y: scroll;">
                    <tbody>
                    @foreach($cards as $card)
                        <tr>
                            <td>
                                <b>{{ trim(\Carbon\Carbon::createFromFormat(DateTime::ISO8601, $card['created_at'])-> format('d/m/Y h:m')) }}</b><br/>
                                {{ $card['note'] }}
                            </td>
                            <td><a href="https://github.com/webdesignstudiouk/ebn_dev/projects/1" target="_blank"
                                   style="float:right;"><i class="fa fa-search btn btn-icon btn-success"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="https://github.com/webdesignstudiouk/ebn_dev/projects/1" target="_blank" class="btn btn-success"
               style="width:100%;">Create New Feature</a>
        </div>

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
@endsection