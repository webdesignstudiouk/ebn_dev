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

@endsection