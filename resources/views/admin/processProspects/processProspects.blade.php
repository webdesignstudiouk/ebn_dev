@extends('admin.system')

@section('page-title', "Process Prospects")
@section('page-description', 'Process prospects into the database.')

@section('extra-breadcrumbs')
    <li><a href="{{route('process-prospects')}}">Process Prospects</a></li>
@endsection

@section('sub-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Format of import csv sheet</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-warning">
                Please be careful with importing data and making sure the "company" column has the correct heading as
                this is the column that is checked to see
                if it is already existin in the database.
            </div>
            <p>To import the data you must remove columns that dont fit the criteria below
                and rename corresponding columns to the values below.</p>
            <ul>
                <li>company</li>
                <li>phonenumber</li>
                <li>business_type</li>
                <li>url</li>
                <li>email</li>
                <li>street_1</li>
                <li>street_2</li>
                <li>town</li>
                <li>city</li>
                <li>postcode</li>

                <li>title</li>
                <li>first_name</li>
                <li>job_title</li>
                <li>second_name</li>
                <li>mobile_number</li>
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Process Prospects</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('process-prospects.process')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Prospects File</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="prospects" name="prospects">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Campaign</label>
                    <div class="col-sm-10">
                        @php
                            $sources = \App\Models\ProspectsSources::all();
                        @endphp
                        <select class="form-control" name="campaign_id" id="campaign_id">
                            <option value="0">-Select Your Campaign-</option>
                            @php
                                foreach($sources->toArray() as $source){
                                     echo "<option value='s-".$source['id']."'>".$source['title']."</option>";
                                     echo "<option value='t-".$source['id']."'>----------------------</option>";
                                    $sourcesCampaigns = \App\Models\ProspectsSourcesCampaigns::where('source_id', $source['id'])->get();
                                    foreach($sourcesCampaigns as $campaign){
                                        echo "<option value='".$campaign['id']."'>".$campaign['week_number']." - ".$campaign['type']."</option>";
                                    }
                                    $options['d-'. $source['id']] ="";
                                }
                            @endphp
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="type" id="type">
                            <option value="0">-Select The Prospects Type-</option>
                            <option value="3">Opener</option>
                            <option value="2">Clickers</option>
                            <option value="1">Lead</option>
                            <option value="0">Other</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-success" type="submit" style="width:100%;">Process Prospects</button>
            </form>
        </div>
    </div>

@endsection