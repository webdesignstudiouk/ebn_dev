@extends('prospects.prospect.site')

@section('extra-breadcrumbs')
    <li><a href="{{route('site.gasMeters', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Gas
            Meters</span></a></li>
@endsection

@section('sub-content')
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#activeMeters" role="tab" data-toggle="tab">Active Meter</a></li>
            <li><a href="#archivedMeters" role="tab" data-toggle="tab">Archived Meter</a></li>
        </ul>
    </nav>

    <div role="tabpanel" class="tab-pane active" id="activeMeters">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:20px;">
                <h3 class="panel-title">Active Gas Meters</h3>
            </div>
            <table class="table table-striped ahref">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>MPRN</th>
                    <th>Signed/Accepted Date</th>
                    <th>Start Date</th>
                    <th>Termination Date</th>
                    <th>Contract End Date</th>
                    <th>EAC</th>
                    <th>View Account</th>
                </tr>
                </thead>
                <tbody>
                @foreach($site->gasMeters as $g)
                    <tr>
                        <td>{{$g->id}}</td>
                        <td>{{$g->mprn}}</td>
                        <td>{{ ($g->accepted_date != '' ? Carbon\Carbon::parse($g->accepted_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->start_date != '' ? Carbon\Carbon::parse($g->start_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->terminationDate != '' ? Carbon\Carbon::parse($g->terminationDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->contractEndDate != '' ? Carbon\Carbon::parse($g->contractEndDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{$g->eac}}</td>
                        <td>
                            <a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$site->id.'/gasMeters/'.$g->id.'/edit')}}">
                                View Account
                            </a>
                            <br/>
                            <a href="{{route('gasMeters.toggle_status', ['id' => $g->id])}}" style="color:#A6CE39;">
                                Archive Meter
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="archivedMeters">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:20px;">
                <h3 class="panel-title">Archived Gas Meters</h3>
            </div>
            <table class="table table-striped ahref">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>MPRN</th>
                    <th>Signed/Accepted Date</th>
                    <th>Start Date</th>
                    <th>Termination Date</th>
                    <th>Contract End Date</th>
                    <th>EAC</th>
                    <th>View Account</th>
                </tr>
                </thead>
                <tbody>
                @foreach($site->archivedGasMeters as $g)
                    <tr>
                        <td>{{$g->id}}</td>
                        <td>{{$g->mprn}}</td>
                        <td>{{ ($g->accepted_date != '' ? Carbon\Carbon::parse($g->accepted_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->start_date != '' ? Carbon\Carbon::parse($g->start_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->terminationDate != '' ? Carbon\Carbon::parse($g->terminationDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->contractEndDate != '' ? Carbon\Carbon::parse($g->contractEndDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{$g->eac}}</td>
                        <td>
                            <a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$site->id.'/gasMeters/'.$g->id.'/edit')}}">
                                View Account
                            </a>
                            <br/>
                            <a href="{{route('gasMeters.toggle_status', ['id' => $g->id])}}" style="color:#A6CE39;">
                                Set Meter To Active
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! form($createGasMeter)!!}
@endsection
