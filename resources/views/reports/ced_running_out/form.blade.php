<!-- Description -->
<p>View all Contract End Dates running out.</p>

<!-- Time Scale -->
<div class="form-group">
    <label class="control-label" for="lead_type">Time Scale</label>
    @php
        $times = array(
            'week'=>'This Week',
            'month'=>'This Month',
            'year'=>'This Year'
            );
    @endphp
    {{Form::select('time', $times, '', ['class'=>'form-control'])}}
</div>
