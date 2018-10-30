<!-- Description -->
<p>View all LOA's</p>

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

<div class='form-group'>
    <label class='control-label' for='view'>Won/Open/Lost</label>
    @php
        $types = array(
            'all'=>'All',
            'won'=>'Won',
            'lost'=>'Lost',
            'open'=>'Open',
        );
    @endphp
    {{Form::select('won_filter', $types, '', ['class'=>'form-control'])}}
</div>

<div class='form-group'>
    <label class='control-label' for='view'>View Report As</label>
    @php
        $views = array(
            'table'=>'Table',
            'pdf'=>'PDF',
        );
    @endphp
    {{Form::select('view', $views, '', ['class'=>'form-control'])}}
</div>

