<!-- Description -->
<p></p>

<div class="form-group">
    <label class="control-label" for="lead_type">Filter</label>
    @php
        $types = array(
            'brochure_sent'=>'Brochures Sent',
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

