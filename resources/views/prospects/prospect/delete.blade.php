@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.delete', $prospect->id)}}">Delete</span></a></li>
@endsection

@section('sub-content')
<div class="panel panel-default">
    <div class="panel-heading" style="margin-bottom:20px;">
        <h3 class="panel-title">
            <b>Delete Prospect</b>
        </h3>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{Form::open(array('url' => route('prospect.delete', $prospect->id), 'method'=>'post'))}}
            {{Form::token()}}
            {{Form::input('hidden', '_method', 'DELETE')}}
            {{Form::input('hidden', 'id', $prospect->id)}}
            <div class="form-group">
                <label class="control-label" for="deleted_reason">Choose an option from the drop down list below</label>
                {{Form::select('deleted_reason', array(
                    '' => '- Please Choose An Option -',
                    'Business Closing' => 'Business Closing',
                    'Business Being Sold' => 'Business Being Sold',
                    'Dont Take Calls From Brokers' => 'Dont Take Calls From Brokers',
                    'Dead Line' => 'Dead Line',
                    'Dealt With Abroad At Head Office' => 'Dealt With Abroad At Head Office',
                    'Does Himself' => 'Does Himself',
                    'Duplicate Prospect' => 'Duplicate Prospect',
                    'Incorrect Contact Info' => 'Incorrect Contact Info',
                    'Multi Contact Fail' => 'Multi Contact Fail',
                    'No Interest' => 'No Interest',
                    'Other' => 'Other',
                    'Uses Other Broker' => 'Uses Other Broker',
                    'TPS' => 'TPS',
                    'Wrong Number' => 'Wrong Number'
                    ), '', ['class'=>'form-control'])}}
            </div>

            <div class="form-group js-delete-reason" style="display:none;">
                <label class="control-label" for="deleted_reason_2">Deleted Reason</label>
                {{Form::textarea('deleted_reason_2', '', ['class'=>'form-control'])}}
            </div>

            {{Form::submit('Delete Prospect', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
        </div>
    </div>
@endsection
