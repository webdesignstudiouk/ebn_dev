@extends('layouts.admin')

@section('page-title', "Edit ".$supplier->name)
@section('page-description', 'Edit A Supplier')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>Update A Supplier</b>
            </h3>
        </div>

        {{Form::open(array('url' => route('suppliers-hub.update', $supplier->id), 'method'=>'post'))}}
        {{Form::hidden('id', $supplier->id)}}
        {{Form::hidden('_method', 'PUT')}}

        <div class="row">
            <div class="col-sm-12">

                <div class="form-group">
                    <label class="control-label" for="name">Supplier Name</label>
                    {{Form::input('text', 'name', $supplier->name, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="logo_url">Logo URL</label>
                    <p>This is the url of the suppliers logo (if you dont have one leave it blank)</p>
                    {{Form::input('text', 'logo_url', $supplier->logo_url, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="general_phone">General Phone</label>
                    {{Form::input('text', 'general_phone', $supplier->general_phone, ['class'=>'form-control'])}}
                </div>

            </div>

            <div class="col-sm-6">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>SME</b>
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_phone">Phone</label>
                    {{Form::input('text', 'sme_phone', $supplier->sme_phone, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_email_info">Email Info</label>
                    {{Form::input('text', 'sme_email_info', $supplier->sme_email_info, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_email_termination">Email Termination</label>
                    {{Form::input('text', 'sme_email_termination', $supplier->sme_email_termination, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_email_termination">Account Manager</label>
                    {{Form::input('text', 'sme_account_manager', $supplier->sme_account_manager, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_account_manager_dd">Account Manager DD</label>
                    {{Form::input('text', 'sme_account_manager_dd', $supplier->sme_account_manager_dd, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="sme_account_manager_email">Account Manager Email</label>
                    {{Form::input('text', 'sme_account_manager_email', $supplier->sme_account_manager_email, ['class'=>'form-control'])}}
                </div>

            </div>
            <div class="col-sm-6">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Corporate</b>
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_phone">Phone</label>
                    {{Form::input('text', 'corporate_phone', $supplier->corporate_phone, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_email_info">Info</label>
                    {{Form::input('text', 'corporate_email_info', $supplier->corporate_email_info, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_email_termination">Email Termination</label>
                    {{Form::input('text', 'corporate_email_termination', $supplier->corporate_email_termination, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_email_termination">Account Manager</label>
                    {{Form::input('text', 'corporate_account_manager', $supplier->corporate_account_manager, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_account_manager_dd">Account Manager DD</label>
                    {{Form::input('text', 'corporate_account_manager_dd', $supplier->corporate_account_manager_dd, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="corporate_account_manager_email">Account Manager Email</label>
                    {{Form::input('text', 'corporate_account_manager_email', $supplier->corporate_account_manager_email, ['class'=>'form-control'])}}
                </div>

            </div>
            <div class="col-sm-12">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Relationship</b>
                </div>

                <div class="form-group">
                    <label class="control-label" for="direct">Direct</label>
                    {{Form::select('direct', array('yes'=>'Yes', 'no'=>'No'), $supplier->direct, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    <label class="control-label" for="aggregator">Aggregator</label>
                    {{Form::select('aggregator', array('yes'=>'Yes', 'no'=>'No'), $supplier->aggregator, ['class'=>'form-control'])}}
                </div>

            </div>

            <div class="col-sm-12">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Supplier and Product Info</b>
                </div>

                <div class="form-group">
                    {{Form::textarea('supplier_and_product_info', $supplier->supplier_and_product_info, ['class'=>'form-control', 'id'=>'supplier_and_product_info'])}}
                </div>

            </div>

            <div class="col-sm-12">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Customer Service and Billing</b>
                </div>

                <div class="form-group">
                    {{Form::textarea('customer_service_and_billing', $supplier->customer_service_and_billing, ['class'=>'form-control', 'id'=>'customer_service_and_billing'])}}
                </div>

            </div>

            <div class="col-sm-12">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Renewal Cycle</b>
                </div>

                <div class="form-group">
                    {{Form::textarea('renewal_cycle', $supplier->renewal_cycle, ['class'=>'form-control', 'id'=>'renewal_cycle'])}}
                </div>

            </div>

            <div class="col-sm-12">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Credit & Restrictions</b>
                </div>

                <div class="form-group">
                    {{Form::textarea('credit_and_restrictions', $supplier->credit_and_restrictions, ['class'=>'form-control', 'id'=>'credit_and_restrictions'])}}
                </div>

            </div>

            <div class="col-sm-12">

                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Contract Terms And Commissions</b>
                </div>

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">12 Month - payment 1</label>
                        {{Form::textarea('cc12_1', $supplier->cc12_1, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">12 Month - payment 2</label>
                        {{Form::textarea('cc12_2', $supplier->cc12_2, ['class'=>'form-control'])}}
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">24 Month - payment 1</label>
                        {{Form::textarea('cc24_1', $supplier->cc24_1, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">24 Month - payment 2</label>
                        {{Form::textarea('cc24_2', $supplier->cc24_2, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">24 Month - payment 3</label>
                        {{Form::textarea('cc24_3', $supplier->cc24_3, ['class'=>'form-control'])}}
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">36 Month - payment 1</label>
                        {{Form::textarea('cc36_1', $supplier->cc36_1, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">36 Month - payment 2</label>
                        {{Form::textarea('cc36_2', $supplier->cc36_2, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">36 Month - payment 3</label>
                        {{Form::textarea('cc36_3', $supplier->cc36_3, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">36 Month - payment 4</label>
                        {{Form::textarea('cc36_4', $supplier->cc36_4, ['class'=>'form-control'])}}
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">48 Month - payment 1</label>
                        {{Form::textarea('cc48_1', $supplier->cc48_1, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">48 Month - payment 2</label>
                        {{Form::textarea('cc48_2', $supplier->cc48_2, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">48 Month - payment 3</label>
                        {{Form::textarea('cc48_3', $supplier->cc48_3, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">48 Month - payment 4</label>
                        {{Form::textarea('cc48_4', $supplier->cc48_4, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">48 Month - payment 5</label>
                        {{Form::textarea('cc48_5', $supplier->cc48_5, ['class'=>'form-control'])}}
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">60 Month - payment 1</label>
                        {{Form::textarea('cc60_1', $supplier->cc60_1, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">60 Month - payment 2</label>
                        {{Form::textarea('cc60_2', $supplier->cc60_2, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">60 Month - payment 3</label>
                        {{Form::textarea('cc60_3', $supplier->cc60_3, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">60 Month - payment 4</label>
                        {{Form::textarea('cc60_4', $supplier->cc60_4, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">60 Month - payment 5</label>
                        {{Form::textarea('cc60_5', $supplier->cc60_5, ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-sm-3">
                        <label class="control-label" for="corporate_account_manager_email">60 Month - payment 6</label>
                        {{Form::textarea('cc60_6', $supplier->cc60_6, ['class'=>'form-control'])}}
                    </div>
                </div>

            </div>

            {{Form::input('submit', 'submit', 'Update Supplier', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}

        </div>

        {{Form::close()}}
    </div>
@endsection