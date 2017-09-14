<!-- Description -->
<p></p>

<!-- Time Scale -->
<div class="form-group">
    <label class="control-label" for="lead_type">Prospects</label>
    @php
        $prospect_types = array(
            '1'=>'Prospect 1s',
            '2'=>'Prospect 2s',
            '3'=>'Clients',
            'all'=>'All'
            );
    @endphp
    {{Form::select('prospect_type', $prospect_types, '', ['class'=>'form-control'])}}

    <div class='form-group'>
        <label class='control-label' for='view'>View Report As</label>
        @php
        $views = array(
        'table'=>'Table',
        'pdf'=>'PDF',
        'csv'=>'CSV'
        );
        @endphp
        {{Form::select('view', $views, '', ['class'=>'form-control'])}}
    </div>

</div>
