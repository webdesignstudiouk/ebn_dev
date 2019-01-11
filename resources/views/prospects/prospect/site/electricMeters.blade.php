@extends('prospects.prospect.site')

@section('extra-breadcrumbs')
    <li><a href="{{route('site.electricMeters', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Electric
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
                <h3 class="panel-title">Active Electric Meters</h3>
            </div>
            <table class="table table-striped ahref">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>MPAN</th>
                    <th>Signed/Accepted Date</th>
                    <th>Start Date</th>
                    <th>Termination Date</th>
                    <th>Contract End Date</th>
                    <th>EAC</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($site->electricMeters as $e)
                    <tr>
                        <td>{{$e->id}}</td>
                        <td>{{$e->mpan_1}} {{$e->mpan_2}} {{$e->mpan_3}} {{$e->mpan_4}} {{$e->mpan_5}} {{$e->mpan_6}} {{$e->mpan_7}}</td>
                        <td>{{ ($e->accepted_date != '' ? Carbon\Carbon::parse($e->accepted_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->start_date != '' ? Carbon\Carbon::parse($e->start_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->terminationDate != '' ? Carbon\Carbon::parse($e->terminationDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->contractEndDate != '' ? Carbon\Carbon::parse($e->contractEndDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{$e->eac}}</td>
                        <td>
                            <a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$site->id.'/electricMeters/'.$e->id.'/edit')}}">
                                View Account
                            </a>
                            <br/>
                            <a href="{{route('electricMeters.toggle_status', ['id' => $e->id])}}" style="color:#A6CE39;">
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
                <h3 class="panel-title">Archived Electric Meters</h3>
            </div>
            <table class="table table-striped ahref">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>MPAN</th>
                    <th>Signed/Accepted Date</th>
                    <th>Start Date</th>
                    <th>Termination Date</th>
                    <th>Contract End Date</th>
                    <th>EAC</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($site->archivedElectricMeters as $e)
                    <tr>
                        <td>{{$e->id}}</td>
                        <td>{{$e->mpan_1}} {{$e->mpan_2}} {{$e->mpan_3}} {{$e->mpan_4}} {{$e->mpan_5}} {{$e->mpan_6}} {{$e->mpan_7}}</td>
                        <td>{{ ($e->accepted_date != '' ? Carbon\Carbon::parse($e->accepted_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->start_date != '' ? Carbon\Carbon::parse($e->start_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->terminationDate != '' ? Carbon\Carbon::parse($e->terminationDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->contractEndDate != '' ? Carbon\Carbon::parse($e->contractEndDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{$e->eac}}</td>
                        <td>
                            <a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$site->id.'/electricMeters/'.$e->id.'/edit')}}">
                                View Account
                            </a>
                            <br/>
                            <a href="{{route('electricMeters.toggle_status', ['id' => $e->id])}}" style="color:#A6CE39;">
                                Set Meter To Active
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! form($createElectricMeter)!!}
@endsection
