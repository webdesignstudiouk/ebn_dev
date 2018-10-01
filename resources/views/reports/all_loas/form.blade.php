<!-- Description -->
<p>View all LOA's</p>

<div class='form-group'>
    <label class='control-label' for='view'>View Report As</label>
    @php
        $views = array(
            'table'=>'Table',
        );
    @endphp
    {{Form::select('view', $views, '', ['class'=>'form-control'])}}
</div>

