<!-- Description -->
<p>View all Contract End Dates running out. More options will be added, for now this only displays verbalCED, meters to come soon.</p>

<!-- Prospect Type -->
<div class="form-group">
    <label class="control-label" for="agent">Prospect Type</label>
    @php
        $prospect_types = array(
            'all'=>'All',
            '1'=>'Prospect 1s',
            '2'=>'Prospect 2s',
            '3'=>'Clients'
            );
    @endphp
    {{Form::select('prospect_type', $prospect_types, '', ['class'=>'form-control'])}}
</div>

<!-- Agent -->
<div class="form-group">
    <label class="control-label" for="agent">Agent Filter</label>
    @php
        $prospects = array();
        $prospects['all'] = 'All';
        foreach (\App\Models\User::all() as $user){
            $prospects[$user->id] = $user->first_name.' '.$user->second_name;
        }

    @endphp
    {{Form::select('agent', $prospects, '', ['class'=>'form-control'])}}
</div>

<!-- Time Scale -->
<p>Leave below fields to get all ceds</p>

<div class="form-group col-sm-6">
    <label class="control-label" for="from">From</label>
    {{Form::input('date', 'from', '', ['class'=>'form-control'])}}
</div>

<div class="form-group col-sm-6">
    <label class="control-label" for="to">To</label>
    {{Form::input('date', 'to', '', ['class'=>'form-control'])}}
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
