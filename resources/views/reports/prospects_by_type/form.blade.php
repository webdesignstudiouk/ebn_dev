<!-- Description -->
<p>View all Contract End Dates running out. More options will be added, for now this only displays verbalCED, meters to come soon.</p>

<!-- Time Scale -->
<div class="form-group">
    <label class="control-label" for="lead_type">Column</label>
    @php
    $rows = new \App\Models\Prospects;
    $rows = $rows->getTableColumns();
    @endphp
    {{Form::select('column', $rows, '', ['class'=>'form-control'])}}

    <div class='form-group'>
        <label class='control-label' for='view'>View Report As</label>
        @php
            $views = array(
                'table'=>'Table'
            );
        @endphp
        {{Form::select('view', $views, '', ['class'=>'form-control'])}}
    </div>
</div>
