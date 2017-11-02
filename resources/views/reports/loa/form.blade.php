<!-- Description -->
<p>View all Prospects/Clients that have one or more of the options you select. View in table or pdf.</p>

<!-- Type -->
<div class="form-group">
    <label class="control-label" for="type">Prospect Type</label>
    @php
        $types = array(
            'all'=>'All',
            '1'=>'Prospect 1',
            '2'=>'Prospect 2',
            '3'=>'Clients'
            );
    @endphp
    {{Form::select('type', $types, '', ['class'=>'form-control'])}}
</div>
<div class="col-sm-3">
    <div class="form-group">
        {{Form::checkbox('loa_recieved', '1', '', ['class'=>''])}}
        <label class="control-label" for="loa_recieved">LOA Received</label>
    </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        {{Form::checkbox('loa_business_won', '1', '', ['class'=>''])}}
        <label class="control-label" for="loa_business_won">Business Won</label>
    </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        {{Form::checkbox('loa_business_lost', '1', '', ['class'=>''])}}
        <label class="control-label" for="loa_business_lost">Business Lost</label>
    </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        {{Form::checkbox('loa_pending', '1', '', ['class'=>''])}}
        <label class="control-label" for="loa_pending">LOA Pending</label>
    </div>
</div>

<div class='form-group'>
    <label class='control-label' for='view'>View Report As</label>
    @php
        $views = array(
            'table'=>'Table',
            'pdf'=>'PDF'
        );
    @endphp
    {{Form::select('view', $views, '', ['class'=>'form-control'])}}
</div>

