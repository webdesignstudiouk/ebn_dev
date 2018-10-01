<!-- Description -->
<p></p>

<div class="form-group">
    <label class="control-label" for="lead_type">Agent Filter</label>
    @php
        $prospects = array();
        $prospects['all'] = 'All';
        foreach (\App\Models\User::all() as $user){
            $prospects[$user->id] = $user->first_name.' '.$user->second_name;
        }

    @endphp
    {{Form::select('agent', $prospects, '', ['class'=>'form-control'])}}
</div>

<div class="form-group">
    <label class="control-label" for="lead_type">Type Filter</label>
    @php
        $types = array(
            'brochure_sent'=>'Brochures Sent',
            'brochure_request'=>'Brochures Requested',
            'mug_sent'=>'Mug Sent',
            );
    @endphp
    {{Form::select('type', $types, '', ['class'=>'form-control'])}}
</div>

<div class='form-group'>
    <label class='control-label' for='view'>View Report As</label>
    @php
        $views = array(
            'table'=>'Table'
        );
    @endphp
    {{Form::select('view', $views, '', ['class'=>'form-control'])}}
</div>

