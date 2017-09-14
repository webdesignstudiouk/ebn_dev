<!-- Description -->
<p>View all Contract End Dates running out. More options will be added, for now this only displays verbalCED, meters to come soon.</p>

<!-- Time Scale -->
<div class="form-group">
    <label class="control-label" for="lead_type">Time Scale</label>
    @php
        $times = array(
            'week'=>'This Week',
            'month'=>'This Month',
            'year'=>'This Year',
            'all'=>'All'
            );
    @endphp
    {{Form::select('time', $times, '', ['class'=>'form-control'])}}

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
</div>
