@extends('prospects.prospect')

@section('extra-breadcrumbs')
    <li><a href="{{route('prospect.loas', $prospect->id)}}">Contract End Date - All meter's</a></li>
@endsection

@section('sub-content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">All Meters</h3>
            {{--<div class="panel-options">--}}
            {{--<a class="btn btn-sm btn-success" style="color: #fff;" href="{{route('site.export_sitelist', array($prospect->id))}}">--}}
            {{--Export--}}
            {{--</a>--}}
            {{--</div>--}}
        </div>

        <table class="table table-striped ahref">
            <thead>
            <tr>
                <th>Site Name</th>
                <th>Meter No</th>
                <th>Supply Type</th>
                <th>Signed Accepted Date</th>
                <th>Start Date</th>
                <th>Termination Date</th>
                <th>Contract End Date</th>
                <th>View</th>
            </tr>
            </thead>
            <tbody>
            @foreach($prospect->sites as $s)
                @foreach($s->electricMeters as $e)
                    <tr>
                        <td>{{$s->name}}</td>
                        <td>{{$e->mpan_1}} {{$e->mpan_2}} {{$e->mpan_3}} {{$e->mpan_4}} <br/> {{$e->mpan_5}} {{$e->mpan_6}} {{$e->mpan_7}}</td>
                        <td>Electric</td>
                        <td>-</td>
                        <td>{{ ($e->start_date != '' ? Carbon\Carbon::parse($e->start_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->terminationDate != '' ? Carbon\Carbon::parse($e->terminationDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($e->contractEndDate != '' ? Carbon\Carbon::parse($e->contractEndDate)->format('d/m/Y') : '' ) }}</td>
                        <td>
                            <a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$s->id.'/electricMeters/'.$e->id.'/edit')}}">View Account</a>
                        </td>
                    </tr>
                @endforeach
                @foreach($s->gasMeters as $g)
                    <tr>
                        <td>{{$s->name}}</td>
                        <td>{{$g->mprn}}</td>
                        <td>Gas</td>
                        <td>-</td>
                        <td>{{ ($g->start_date != '' ? Carbon\Carbon::parse($e->start_date)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->terminationDate != '' ? Carbon\Carbon::parse($e->terminationDate)->format('d/m/Y') : '' ) }}</td>
                        <td>{{ ($g->contractEndDate != '' ? Carbon\Carbon::parse($e->contractEndDate)->format('d/m/Y') : '' ) }}</td>
                        <td>
                            <a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$s->id.'/gasMeters/'.$g->id.'/edit')}}">View Account</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection