@extends('layouts.admin')

@section('page-title', $supplier->name)
@section('page-description', 'Edit A Supplier')

@section('content')
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#contactAndGeneral" role="tab" data-toggle="tab">Contact And General</a></li>
            <li class=""><a href="#supplierAndProductInfo" role="tab" data-toggle="tab">Supplier and Product Info</a></li>
            <li class=""><a href="#customerServiceAndBilling" role="tab" data-toggle="tab">Customer Service And Billing</a></li>
            <li class=""><a href="#renewalCycle" role="tab" data-toggle="tab">Renewal Cycle</a></li>
            <li class=""><a href="#creditAndRestrictions" role="tab" data-toggle="tab">Credit And Restrictions</a></li>
        </ul>
    </nav>

    <div class="tab-content">

        <div role="tabpanel" class="tab-pane active" id="contactAndGeneral">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label class="control-label" for="name">Supplier Name</label>
                            <p>{{$supplier->name}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="logo_url">Logo URL</label>
                            <p>{{$supplier->logo_url}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="general_phone">General Phone</label>
                            <p>{{$supplier->general_phone}}</p>
                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                            <b>SME</b>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sme_phone">Phone</label>
                            <p>{{$supplier->sme_phone}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sme_email_info">Email Info</label>
                            <p>{{$supplier->sme_email_info}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sme_email_termination">Email Termination</label>
                            <p>{{$supplier->sme_email_termination}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sme_email_termination">Account Manager</label>
                            <p>{{$supplier->sme_account_manager}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sme_account_manager_dd">Account Manager DD</label>
                            <p>{{$supplier->sme_account_manager_dd}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sme_account_manager_email">Account Manager Email</label>
                            <p>{{$supplier->sme_account_manager_email}}</p>
                        </div>

                    </div>
                    <div class="col-sm-6">

                        <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                            <b>Corporate</b>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="corporate_phone">Phone</label>
                            <p>{{$supplier->corporate_phone}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="corporate_email_info">Info</label>
                            <p>{{$supplier->corporate_email_info}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="corporate_email_termination">Email Termination</label>
                            <p>{{$supplier->corporate_email_termination}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="corporate_email_termination">Account Manager</label>
                            <p>{{$supplier->corporate_account_manager}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="corporate_account_manager_dd">Account Manager DD</label>
                            <p>{{$supplier->corporate_account_manager_dd}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="corporate_account_manager_email">Account Manager Email</label>
                            <p>{{$supplier->corporate_account_manager_email}}</p>
                        </div>

                    </div>
                    <div class="col-sm-12">

                        <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                            <b>Relationship</b>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="direct">Direct</label>
                            <p>{{$supplier->direct}}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="aggregator">Aggregator</label>
                            <p>{{$supplier->aggregator}}</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div role="tabpanel" class="tab-pane" id="supplierAndProductInfo">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->supplier_and_product_info!!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="customerServiceAndBilling">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->customer_service_and_billing!!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="renewalCycle">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->renewal_cycle!!}</p>
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="creditAndRestrictions">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->credit_and_restrictions!!}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection