@extends('prospects.prospect')

@section('extra-breadcrumbs')
    <li><a href="{{route('prospects.edit', $prospect->id)}}">{{ $prospect->typeTitle() }} Details</span></a></li>
@endsection

@section('sub-content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>Prospect Details</b>
            </h3>
        </div>
        {{Form::open(array('url' => route('prospects.update', $prospect->id), 'method'=>'post'))}}
        {{Form::token()}}
        <div class="row">
            <div class="col-sm-12">
                <input class="form-control" name="_method" type="hidden" value="PUT">
                {{Form::input('hidden', 'id', $prospect->id)}}
                <div class="form-group">
                    <label class="control-label" for="id_title">ID</label>
                    {{Form::input('text', '', $prospect->id, ['class'=>'form-control', 'disabled'=>true])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="user_id">Agent</label>
                    {{Form::input('text', 'user_id', $prospect->user->first_name.' '.$prospect->user->second_name, ['class'=>'form-control', 'disabled'=>true])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="type_id">Prosect Type</label>
                    {{Form::input('text', 'type_id', $prospect->prospectType->title." - ".$prospect->prospectType->description, ['class'=>'form-control', 'disabled'=>true])}}
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="campaign_id">Campaign Week Number</label>
                        @php
                            $options = [];

                            foreach($sources->toArray() as $source){
                                $options['s-'. $source['id']] = $source['title'];
                                $options['t-'. $source['id']] = "----------------------";
                                $sourcesCampaigns = \App\Models\ProspectsSourcesCampaigns::where('source_id', $source['id'])->get();
                                foreach($sourcesCampaigns as $campaign){
                                    $options[$campaign['id']] = $campaign['week_number'].' - '.$campaign['type'];
                                }
                                $options['d-'. $source['id']] ="";
                            }
                        @endphp
                        {{Form::select('campaign_id', $options, $prospect->campaign_id, ['class'=>'form-control'])}}
                    </div>
                    <center>
                        <b><a href="http://ebn.app/admin/options/source-codes" style="color:#A6CE39;">Create a source
                                code.</a></b>
                    </center>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="lead_type">Lead Type</label>
                        @php
                            $lead_types = array(
                               '1'=> 'lead',
                               '2'=> 'clicker',
                               '3'=> 'openers'
                                );
                        @endphp
                        {{Form::select('lead_type', $lead_types, $prospect->type_id, ['class'=>'form-control'])}}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="lead_source">Lead Source</label>
                        @php
                            $lead_source = array(
                                '',
                                'Outbound Calls',
                                'E-Marketing',
                                'Advertising',
                                'Internet Search',
                                'Referral',
                                'Original'
                                );
                        @endphp
                        {{Form::select('lead_source', $lead_source, $prospect->lead_source, ['class'=>'form-control'])}}
                    </div>
                </div>
                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Options</b>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::checkbox('subscribed', '1', $prospect->subscribed, ['class'=>'iswitch iswitch-secondary'])}}
                            <label class="control-label" for="subscribed">Subscribed</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::checkbox('mug_sent', '1', $prospect->mug_sent, ['class'=>'iswitch iswitch-secondary'])}}
                            <label class="control-label" for="mug_sent">Mug sent</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Company Details</b>
                </div>
                <div class="form-group">
                    <label class="control-label required" for="company">Company</label>
                    {{Form::input('text', 'company', $prospect->company, ['class'=>'form-control', 'required'=>'required'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                    {{Form::input('email', 'email', $prospect->email, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="phonenumber">Phone Number</label>
                    {{Form::input('text', 'phonenumber', $prospect->phonenumber, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="url">Website Address (URL)</label>
                    {{Form::input('text', 'url', $prospect->url, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="tradingStyle">Trading Style</label>
                    {{Form::input('text', 'tradingStyle', $prospect->tradingStyle, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="regNumber">Company Registration Number</label>
                    {{Form::input('text', 'regNumber', $prospect->regNumber, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="regNumber">Registered Charity Number</label>
                    {{Form::input('text', 'regCharityNumber', $prospect->regCharityNumber, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="businessType">SIC Description</label>
                    {{Form::input('text', 'businessType', $prospect->businessType, ['class'=>'form-control'])}}
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Registered Address</b>
                </div>
                <div class="form-group">
                    <label class="control-label" for="street_1">Street 1</label>
                    {{Form::input('text', 'street_1', $prospect->street_1, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="street_2">Street 2</label>
                    {{Form::input('text', 'street_2', $prospect->street_2, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="town">Town</label>
                    {{Form::input('text', 'town', $prospect->town, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="city">City</label>
                    {{Form::input('text', 'city', $prospect->city, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="county">County</label>
                    {{Form::input('text', 'county', $prospect->county, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="postcode">Postcode</label>
                    {{Form::input('text', 'postcode', $prospect->postcode, ['class'=>'form-control'])}}
                </div>
            </div>

            <!-- LOA -->
            <div class="col-sm-12">
                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>LOA</b>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="loa_sent">Sent</label>
                            {{Form::input('text', 'loa_sent', $prospect->loa_sent, ['class'=>'form-control', 'id'=>'loaSent'])}}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{Form::checkbox('loa_recieved', '1', $prospect->loa_recieved, ['class'=>''])}}
                            <label class="control-label" for="loa_recieved">Received</label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {{Form::checkbox('loa_business_won', '1', $prospect->loa_business_won, ['class'=>''])}}
                            <label class="control-label" for="loa_business_won">Business Won</label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {{Form::checkbox('loa_business_lost', '1', $prospect->loa_business_lost, ['class'=>''])}}
                            <label class="control-label" for="loa_business_lost">Business Lost</label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            {{Form::checkbox('loa_pending', '1', $prospect->loa_pending, ['class'=>''])}}
                            <label class="control-label" for="loa_pending">Pending</label>
                        </div>
                    </div>
                </div>
            </div>
            {{Form::input('submit', 'Update Prospect', null, ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
        </div>
    </div>
    {{Form::close()}}
    </div>
@endsection
