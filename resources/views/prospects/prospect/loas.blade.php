@extends('prospects.prospect')

@section('extra-breadcrumbs')
    <li><a href="{{route('prospect.loas', $prospect->id)}}">LOA's</span></a></li>
@endsection

@section('sub-content')
    @permission('uploads.view')
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            @if(isset($prospect->current_loa) && $prospect->current_loa != null)
                <li class="active"><a href="#currentLoas" role="tab" data-toggle="tab">Current LOA's</a></li>
            @endif
            @if(isset($prospect->archived_loas) && $prospect->archived_loas != null && count($prospect->archived_loas) > 0)
                <li class=""><a href="#archivedLoas" role="tab" data-toggle="tab">Archived LOA's</a></li>
            @endif
            <li class=""><a href="#loaReport" role="tab" data-toggle="tab">LOA Report</a></li>
            <li class=""><a href="#uploadLoa" role="tab" data-toggle="tab">Upload LOA</a></li>
        </ul>
    </nav>

    @permission('uploads.loa.view')
    @if(isset($prospect->current_loa) && $prospect->current_loa != null)
        <div role="tabpanel" class="tab-pane active" id="currentLoas">
            <div class="panel panel-default">
                <div class="row" style="margin-bottom: 15px;padding-bottom: 5px; border-bottom: 2px solid #A6CE39;">
                    <div class="col-sm-9">
                        <div style="padding-top:5px;">
                            {{$prospect->current_loa->file}}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <a href="{{url('storage/app/public/prospects/'.$prospect->id.'/loa/'.basename($prospect->current_loa->file))}}">
                            <i class='fa fa-search btn btn-icon btn-success'></i>
                        </a>
                        <a href="{{url('storage/app/public/prospects/'.$prospect->id.'/loa/'.basename($prospect->current_loa->file))}}" style="color:#8dc63f;" download>
                            <i class='fa fa-download btn btn-icon btn-info'></i>
                        </a>
                    </div>
                </div>
                {{Form::open(array('url' => route('update_loa'), 'method'=>'post'))}}
                {{Form::token()}}
                {{Form::input('hidden', 'id', $prospect->current_loa->id)}}

                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="control-label" for="sent">ID</label>
                            <p>{{$prospect->current_loa->id}}</p>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="sent">Sent</label>
                            @php
                                $sent_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->current_loa->sent)->format('Y-m-d');
                            @endphp
                            {{Form::date('sent', $sent_date, ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="recieved">Recieved</label>
                            @php
                                if(isset($prospect->current_loa->recieved) && $prospect->current_loa->recieved != null){
                                    if(isset($prospect->verbalCED) && $prospect->verbalCED != null){
                                        $verbal_ced = Carbon\Carbon::createFromFormat('d/m/Y', $prospect->verbalCED);
                                    }
                                    $recieved_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->current_loa->recieved);
                                    $recieved_date_format = $recieved_date->format('Y-m-d');
                                }else{
                                    $recieved_date_format = '';
                                }
                                if(isset($recieved_date) && isset($verbal_ced)){
                                    $diff = $recieved_date->diffInMonths($verbal_ced);
                                }
                            @endphp
                            {{Form::date('recieved', $recieved_date_format, ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" for="supplier_confirmed_ced">Supplier Confirmed CED</label>
                            @php
                                if(isset($prospect->current_loa->supplier_confirmed_ced) && $prospect->current_loa->supplier_confirmed_ced != null){
                                    $supplier_confirmed_ced = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->current_loa->supplier_confirmed_ced);
                                    $supplier_confirmed_ced_format = $supplier_confirmed_ced->format('Y-m-d');
                                }else{
                                    $supplier_confirmed_ced_format = '';
                                }
                            @endphp
                            {{Form::date('supplier_confirmed_ced', $supplier_confirmed_ced_format, ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @if(isset($prospect->current_loa->recieved) && $prospect->current_loa->recieved != '')
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" style="width: 100%; text-align: center;">FSO 12m -</label>
                                    @if(isset($diff) && $diff < 12 && $recieved_date < $verbal_ced)
                                        <i class="fas fa-check" style="user-select: auto; text-align: center; color: #8dc63f; display: inline-block; width: 100%; padding-top:8px;"></i>
                                    @else
                                        <i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" style="width: 100%; text-align: center;">FSO 12m +</label>
                                    @if(isset($diff) && $diff > 12 && $recieved_date < $verbal_ced)
                                        <i class="fas fa-check" style="user-select: auto; text-align: center; color: #8dc63f; display: inline-block; width: 100%; padding-top:8px;"></i>
                                    @else
                                        <i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" style="width: 100%; text-align: center;">Please enter a recieved date</label>
                                    <i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group" style=" text-align: center; vertical-align: middle;">
                            <label class="control-label" for="loa_won" style="width: 100%; text-align: center;">Won/Lost</label>
                            {{Form::checkbox('loa_won', '1', $prospect->current_loa->loa_won, ['class'=>'iswitch iswitch-secondary'])}}
                        </div>
                    </div>
                </div>
                {{Form::submit('Update LOA', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
                {{Form::close()}}
            </div>
        </div>
    @endif

    @if(isset($prospect->archived_loas) && $prospect->archived_loas != null && count($prospect->archived_loas) > 0)
        <div role="tabpanel" class="tab-pane" id="archivedLoas">
            @foreach($prospect->archived_loas as $loa)
                <div class="panel panel-default">
                    <div class="row" style="margin-bottom: 15px;padding-bottom: 5px; border-bottom: 2px solid #A6CE39;">
                        <div class="col-sm-9">
                            <div style="padding-top:5px;">
                                {{$loa->file}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('storage/app/public/prospects/'.$prospect->id.'/loa/'.basename($loa->file))}}">
                                <i class='fa fa-search btn btn-icon btn-success'></i>
                            </a>
                            <a href="{{url('storage/app/public/prospects/'.$prospect->id.'/loa/'.basename($loa->file))}}" style="color:#8dc63f;" download>
                                <i class='fa fa-download btn btn-icon btn-info'></i>
                            </a>
                        </div>
                    </div>
                    {{Form::open(array('url' => route('update_loa'), 'method'=>'post'))}}
                    {{Form::token()}}
                    {{Form::input('hidden', 'id', $loa->id)}}
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label class="control-label" for="">ID</label>
                                {{Form::input('text', '', $loa->id, ['class'=>'form-control', 'disabled'=> true])}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="sent">Sent</label>
                                @php
                                    $sent_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loa->sent);
                                @endphp
                                {{Form::date('sent', $sent_date->format('Y-m-d'), ['class'=>'form-control', 'disabled'=>true])}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="recieved">Recieved</label>
                                @php
                                    if(isset($loa->recieved) &&$loa->recieved != null){
                                        if(isset($prospect->verbalCED) && $prospect->verbalCED != null){
                                            $verbal_ced = Carbon\Carbon::createFromFormat('d/m/Y', $prospect->verbalCED);
                                        }
                                        $recieved_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loa->recieved);
                                        $recieved_date_format = $recieved_date->format('Y-m-d');
                                    }else{
                                        $recieved_date_format = '';
                                    }
                                    if(isset($recieved_date) && isset($verbal_ced)){
                                        $diff = $recieved_date->diffInMonths($verbal_ced);
                                    }
                                @endphp
                                {{Form::date('recieved', $recieved_date_format, ['class'=>'form-control', 'disabled'=>true])}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            @if(isset($loa->recieved) && $loa->recieved != '')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" style="width: 100%; text-align: center;">FSO 12m -</label>
                                        @if(isset($diff) && $diff < 12 && $recieved_date < $verbal_ced)
                                            <i class="fas fa-check" style="user-select: auto; text-align: center; color: #8dc63f; display: inline-block; width: 100%; padding-top:8px;"></i>
                                        @else
                                            <i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" style="width: 100%; text-align: center;">FSO 12m +</label>
                                        @if(isset($diff) && $diff > 12 && $recieved_date < $verbal_ced)
                                            <i class="fas fa-check" style="user-select: auto; text-align: center; color: #8dc63f; display: inline-block; width: 100%; padding-top:8px;"></i>
                                        @else
                                            <i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label" style="width: 100%; text-align: center;">Please enter a recieved date</label>
                                        <i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group" style=" text-align: center; vertical-align: middle;">
                                <label class="control-label" for="loa_won" style="width: 100%; text-align: center;">Won/Lost</label>
                                {{Form::checkbox('loa_won', '1', $loa->loa_won, ['class'=>'iswitch iswitch-secondary'])}}
                            </div>
                        </div>
                    </div>
                    {{--{{Form::submit('Update LOA', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}--}}
                    {{Form::close()}}
                </div>
            @endforeach
        </div>
    @endif
    @endpermission



    <div role="tabpanel" class="tab-pane" id="loaReport">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:20px;">
                <h3 class="panel-title">
                    <b>All LOA's</b>
                </h3>
            </div>
            @if($data->count() > 0)
                @include('reports.all_loas.output.table_sa', ['data' => $data, 'admin' => false])
            @else
                <div class="alert alert-warning">No LOA's Found</div>
            @endif
        </div>
    </div>

    <div role="tabpanel" class="tab-pane @if(count($prospect->archived_loas) == 0 && $prospect->current_loa == null) active @endif" id="uploadLoa">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom:20px;">
                <h3 class="panel-title">
                    <b>Upload LOA</b>
                </h3>
            </div>
            <div class="row">
                {{Form::open(array('url' => route('store_loa'), 'method'=>'post', '', 'files' => 'true'))}}
                {{Form::token()}}
                {{Form::input('hidden', 'prospect_id', $prospect->id)}}
                <div class="form-group">
                    <label class="control-label" for="loa">LOA to upload</label>
                    {{Form::file('file', ['class'=>'form-control'])}}
                </div>
                {{Form::submit('Upload LOA', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
    @endpermission
@endsection