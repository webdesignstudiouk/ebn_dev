@extends('layouts.admin')

@section('page-title', "Create A Supplier")
@section('page-description', 'Create A Supplier')

@section('content')
    @role('admin')
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li class=""><a href="{{route('suppliers-hub')}}">Suppliers</a></li>
            <li class="active"><a href="{{route('suppliers-hub.create')}}">Create New Supplier</a></li>
        </ul>
    </nav>
    @endrole

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>Create A Supplier</b>
            </h3>
        </div>

        {{Form::open(array('url' => route('suppliers-hub.create'), 'method'=>'post'))}}
        {{Form::token()}}

        <div class="row">
            <div class="col-sm-12">

                <div class="form-group">
                    <label class="control-label" for="name">Supplier Name</label>
                    {{Form::input('text', 'name', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="logo_url">Logo URL</label>
                    {{Form::input('text', 'logo_url', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="general_phone">General Phone</label>
                    {{Form::input('text', 'general_phone', '', ['class'=>'form-control'])}}
                </div>

            </div>

            <div class="col-sm-6">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>SME</b>
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_phone">Phone</label>
                    {{Form::input('text', 'sme_phone', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_email_info">Email Info</label>
                    {{Form::input('text', 'sme_email_info', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_email_termination">Email Termination</label>
                    {{Form::input('text', 'sme_email_termination', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_email_termination">Account Manager</label>
                    {{Form::input('text', 'sme_account_manager', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_account_manager_dd">Account Manager DD</label>
                    {{Form::input('text', 'sme_account_manager_dd', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_account_manager_email">Account Manager Email</label>
                    {{Form::input('text', 'sme_account_manager_email', '', ['class'=>'form-control'])}}
                </div>

            </div>
            <div class="col-sm-6">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Corporate</b>
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_phone">Phone</label>
                    {{Form::input('text', 'corporate_phone', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_email_info">Info</label>
                    {{Form::input('text', 'corporate_email_info', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_email_termination">Email Termination</label>
                    {{Form::input('text', 'corporate_email_termination', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_email_termination">Account Manager</label>
                    {{Form::input('text', 'corporate_account_manager', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_account_manager_dd">Account Manager DD</label>
                    {{Form::input('text', 'corporate_account_manager_dd', '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_account_manager_email">Account Manager Email</label>
                    {{Form::input('text', 'corporate_account_manager_email', '', ['class'=>'form-control'])}}
                </div>

            </div>
            <div class="col-sm-12">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Relationship</b>
                </div>

                <div class="form-group">
                    <label class="control-label" for="direct">Direct</label>
                    {{Form::select('direct', array('yes'=>'Yes', 'no'=>'No'), '', ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="aggregator">Aggregator</label>
                    {{Form::select('aggregator', array('yes'=>'Yes', 'no'=>'No'), '', ['class'=>'form-control'])}}
                </div>

            </div>

            {{Form::input('submit', 'submit', 'Create Supplier', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}

        </div>

        {{Form::close()}}
    </div>
@endsection