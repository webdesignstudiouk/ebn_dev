@extends('prospects.prospect')

@section('extra-breadcrumbs')
    <li><a href="{{route('prospects.edit', $prospect->id)}}">{{ $prospect->typeTitle() }} Details</a></li>
@endsection

@section('sub-content')
    <div class="panel panel-default">
        {{Form::open(array('url' => route('prospects.update', $prospect->id), 'method'=>'post'))}}
        {{Form::token()}}
        <div class="row">
            <div class="col-sm-12">
                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <a class="collapsed" role="button" data-toggle="collapse" href="#prospect_origins" aria-expanded="false">
                        @if($prospect->prospectType->title == 'Clients')
                            <b>Client Origins</b>
                        @else
                            <b>Prospect Origins</b>
                        @endif
                    </a>
                </div>
                <div id='prospect_origins' class="panel-collapse collapse">
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
                        <label class="control-label" for="type_id">Type</label>
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
                </div>
                <div class="clearfix"></div>
                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Options</b>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            @if($prospect->subscribed == 1)
                                {{Form::checkbox('subscribed', '1', $prospect->subscribed, ['class'=>'iswitch iswitch-secondary','disabled'=>true])}}
                                <label class="control-label" for="subscribed">Subscribed</label>
                                @isset($prospect->subscribed_date)
                                    <p>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->subscribed_date)->format('d/m/Y')  }}</p>
                                @endif
                            @else
                                {{Form::checkbox('subscribed', '1', $prospect->subscribed, ['class'=>'iswitch iswitch-secondary'])}}
                                <label class="control-label" for="subscribed">Subscribed</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            @if($prospect->brochure_request == 1)
                                {{Form::checkbox('brochure_request', '1', $prospect->brochure_request, ['class'=>'iswitch iswitch-secondary','disabled'=>true])}}
                                <label class="control-label" for="brochure_request">Brochure Request</label>
                                @isset($prospect->brochure_request_date)
                                    <p>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->brochure_request_date)->format('d/m/Y')  }}</p>
                                @endif
                            @else
                                {{Form::checkbox('brochure_request', '1', $prospect->brochure_request, ['class'=>'iswitch iswitch-secondary'])}}
                                <label class="control-label" for="brochure_request">Brochure Request</label>
                            @endif
                        </div>
                        <div class="form-group">
                            @if($prospect->brochure_sent == 1)
                                {{Form::checkbox('brochure_sent', '1', $prospect->brochure_sent, ['class'=>'iswitch iswitch-secondary','disabled'=>true])}}
                                <label class="control-label" for="subscribed">Brochure Sent</label>
                                @isset($prospect->brochure_sent_date)
                                    <p>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->brochure_sent_date)->format('d/m/Y')  }}</p>
                                @endif
                            @else
                                {{Form::checkbox('brochure_sent', '1', $prospect->brochure_sent, ['class'=>'iswitch iswitch-secondary'])}}
                                <label class="control-label" for="subscribed">Brochure Sent</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            @if($prospect->mug_sent == 1)
                                {{Form::checkbox('mug_sent', '1', $prospect->mug_sent, ['class'=>'iswitch iswitch-secondary','disabled'=>true])}}
                                <label class="control-label" for="mug_sent">Mug sent</label>
                                @isset($prospect->mug_sent_date)
                                    <p>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->mug_sent_date)->format('d/m/Y')  }}</p>
                                @endif
                            @else
                                {{Form::checkbox('mug_sent', '1', $prospect->mug_sent, ['class'=>'iswitch iswitch-secondary'])}}
                                <label class="control-label" for="mug_sent">Mug sent</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            @if($prospect->tps == 1)
                                {{Form::checkbox('tps', '1', $prospect->tps, ['class'=>'iswitch iswitch-secondary','disabled'=>true])}}
                                <label class="control-label" for="tps">TPS</label>
                                @isset($prospect->tps_date)
                                    <p>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->tps_date)->format('d/m/Y')  }}</p>
                                @endif
                            @else
                                {{Form::checkbox('tps', '1', $prospect->tps, ['class'=>'iswitch iswitch-secondary'])}}
                                <label class="control-label" for="tps">TPS</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;padding: 0;margin: 0;background: none;font-size: 17px;padding-bottom:10px;margin-bottom:10px;border-bottom: 2px solid #d3e6a0; text-align:center;">
                    <b>Company Details</b>
                </div>
                <div class="row">
                    <div class="xe-widget xe-counter" style="margin-bottom:10px;border-bottom: 2px solid #d3e6a0;">
                        @if(isset($prospect->favourite_contact) && isset($prospect->favourite_contact->id))
                            <div class="xe-icon"><i class="fa fa-user"></i></div>
                            <p style="color: #000!important; padding:10px; line-height: 20px; font-size:14px;">
                                <b style="text-decoration: underline">Primary Contact</b><br/>
                                <b>Name:</b> <span
                                        style="width: 70%; text-align:left; float: right;">{{$prospect->favourite_contact->title}} {{$prospect->favourite_contact->first_name}} {{$prospect->favourite_contact->second_name}}</span><br/>
                                <b>Job Title: </b><span style="width: 70%; text-align:left; float: right;">{{$prospect->favourite_contact->job_title}}</span><br/>
                                <b>Email: </b><span style="width: 70%; text-align:left; float: right;">{{$prospect->favourite_contact->email}}</span><br/>
                                <b>Phone: </b><span style="width: 70%; text-align:left; float: right;">{{$prospect->favourite_contact->phonenumber}}</span><br/>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label required" for="company">Company</label>
                    {{Form::input('text', 'company', $prospect->company, ['class'=>'form-control', 'required'=>'required'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="phonenumber">Company Telephone Number</label>
                    {{Form::input('text', 'phonenumber', $prospect->phonenumber, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">Company Email</label>
                    {{Form::input('email', 'email', $prospect->email, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="url">Company Web Address</label>
                    {{Form::input('text', 'url', $prospect->url, ['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="tradingStyle">Trading Style</label>
                    @php
                        $trading_styles = array(
                           ''=> '',
                           'Sole Trader'=> 'Sole Trader',
                           'Partnership'=> 'Partnership',
                           'Limited'=> 'Limited',
                           'Charity'=> 'Charity',
                           'LLP'=> 'LLP',
                           'PLC'=> 'PLC',
                           'fake'=> 'Fake',
                            );
                    @endphp
                    {{Form::select('tradingStyle', $trading_styles, $prospect->tradingStyle, ['class'=>'form-control'])}}
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
                    <label class="control-label" for="street_3">Street 3</label>
                    {{Form::input('text', 'street_3', $prospect->street_3, ['class'=>'form-control'])}}
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

            {{Form::input('submit', 'submit', 'Update Changes', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
        </div>
    </div>
    {{Form::close()}}
    </div>
@endsection
