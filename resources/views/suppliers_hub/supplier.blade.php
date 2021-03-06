@extends('layouts.admin_navigation')

@section('page-title', $supplier->name)
@section('page-description', 'Edit A Supplier')

@section('sidebar')
    <li class="active"><a href="#contactAndGeneral" role="tab" data-toggle="tab">Contact And General</a></li>
    <li class=""><a href="#supplierAndProductInfo" role="tab" data-toggle="tab">Supplier and Product Info</a></li>
    <li class=""><a href="#customerServiceAndBilling" role="tab" data-toggle="tab">Customer Service And Billing</a></li>
    <li class=""><a href="#renewalCycle" role="tab" data-toggle="tab">Renewal Cycle</a></li>
    <li class=""><a href="#creditAndRestrictions" role="tab" data-toggle="tab">Credit And Restrictions</a></li>
    <li class=""><a href="#contracttermsandcommissions" role="tab" data-toggle="tab">Contract Terms And Commissions</a></li>
    <li class=""><a href="#uploads" role="tab" data-toggle="tab">Uploads</a></li>
    <li class="" style="margin-top:20px;"><a href="{{route('suppliers-hub')}}">Back To Suppliers</a></li>
    @role('admin')
    <li class=""><a href="{{route('suppliers-hub.update', $supplier->id)}}">Edit Supplier</a></li>
    @endrole
@endsection

@section('breadcrumbs')
    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li><a href="{{route('suppliers-hub')}}">Suppliers Hub</a></li>
    <li><a href="{{route('suppliers-hub.supplier', $supplier->id)}}">{{$supplier->name}}</a></li>
@endsection

@section('content')
    <div class="panel panel-default">

        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>{{$supplier->name}}</b>
            </h3>
        </div>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="contactAndGeneral">
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
                            <label class="control-label" for="corporate_account_manager_email">Account Manager
                                Email</label>
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


            <div role="tabpanel" class="tab-pane" id="supplierAndProductInfo">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->supplier_and_product_info!!}</p>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="customerServiceAndBilling">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->customer_service_and_billing!!}</p>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="renewalCycle">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->renewal_cycle!!}</p>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="creditAndRestrictions">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{!! $supplier->credit_and_restrictions!!}</p>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="contracttermsandcommissions">
                <table class="table table-striped floatThead-table">
                    <thead>
                        <th>Term</th>
                        <th>1st Payment</th>
                        <th>2nd Payment</th>
                        <th>3rd Payment</th>
                        <th>4th Payment</th>
                        <th>5th Payment</th>
                        <th>6th Payment</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: bold;">12 mths</td>
                            <td>{!! $supplier->cc12_1 !!}</td>
                            <td>{!! $supplier->cc12_2 !!}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">24 mths</td>
                            <td>{!! $supplier->cc24_1 !!}</td>
                            <td>{!! $supplier->cc24_2 !!}</td>
                            <td>{!! $supplier->cc24_3 !!}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">36 mths</td>
                            <td>{!! $supplier->cc36_1 !!}</td>
                            <td>{!! $supplier->cc36_2 !!}</td>
                            <td>{!! $supplier->cc36_3 !!}</td>
                            <td>{!! $supplier->cc36_4 !!}</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">48 mths</td>
                            <td>{!! $supplier->cc48_1 !!}</td>
                            <td>{!! $supplier->cc48_2 !!}</td>
                            <td>{!! $supplier->cc48_3 !!}</td>
                            <td>{!! $supplier->cc48_4 !!}</td>
                            <td>{!! $supplier->cc48_5 !!}</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">60 mths</td>
                            <td>{!! $supplier->cc60_1 !!}</td>
                            <td>{!! $supplier->cc60_2 !!}</td>
                            <td>{!! $supplier->cc60_3 !!}</td>
                            <td>{!! $supplier->cc60_4 !!}</td>
                            <td>{!! $supplier->cc60_5 !!}</td>
                            <td>{!! $supplier->cc60_6 !!}</td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="uploads">
                <div class="row">
                    <table class="table table-striped ahref" >
                        <tbody>

                        @foreach($documents as $file)
                            @if(substr(basename($file), 0, 1 ) != ".")
                                @php
                                    $url = Storage::url('app/public/suppliers/'.$supplier->id.'/'.$file);
                                @endphp
                                <tr>
                                    <td class="col-sm-9"> {{ basename($file) }}</td>
                                    <td>
                                        <a href="{{url('storage/app/public/suppliers/'.$supplier->id.'/'.basename($file))}}">
                                            <i class='fa fa-search btn btn-icon btn-success'></i>
                                        </a>
                                        <a href="{{url('storage/app/public/suppliers/'.$supplier->id.'/'.basename($file))}}" style="color:#8dc63f;" download>
                                            <i class='fa fa-download btn btn-icon btn-info'></i>
                                        </a>
                                        @role('admin')
                                        <a href="{{ route('suppliers-hub.delete_file', $supplier->id) }}" onclick="event.preventDefault(); document.getElementById('delete-documents-file-{{$loop->index}}').submit();" style="color:#8dc63f;">
                                            <i class='fa fa-times btn btn-icon btn-red'></i>
                                        </a>
                                        <form id="delete-documents-file-{{$loop->index}}" action="{{ route('suppliers-hub.delete_file', $supplier->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="supplier_id" value="{{$supplier->id}}"/>
                                            <input type="hidden" name="file_name" value="{{basename($file)}}"/>
                                        </form>
                                        @endrole
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection