<div class="panel panel-default">
    <div class="panel-heading" style="margin-bottom:20px;">
        <h3 class="panel-title">
            <b>Update Site</b>
        </h3>
    </div>

    {{Form::open(array('url' => route('sites.update', array($prospect->id, $site->id)), 'method'=>'post'))}}
        {{Form::input('hidden', '_method', 'PUT')}}
        {{Form::input('hidden', 'id', $site->id)}}

        <div class="form-group">
            <label for="name" class="control-label">Site Name</label>
            {{Form::input('text', 'name', $site->name, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="street_1" class="control-label">Street 1</label>
            {{Form::input('text', 'street_1', $site->street_1, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="street_2" class="control-label">Street 2</label>
            {{Form::input('text', 'street_2', $site->street_2, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="street_3" class="control-label">Street 3</label>
            {{Form::input('text', 'street_3', $site->street_3, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="Town" class="control-label">Street 4</label>
            {{Form::input('text', 'street_4', $site->street_4, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="City" class="control-label">Town</label>
            {{Form::input('text', 'town', $site->town, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="City" class="control-label">City</label>
            {{Form::input('text', 'city', $site->city, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="county" class="control-label">County</label>
            {{Form::input('text', 'county', $site->county, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="post_code" class="control-label">Post Code</label>
            {{Form::input('text', 'post_code', $site->post_code, ['class'=>'form-control'])}}
        </div>
        {{Form::input('submit', '', 'Update Site', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
    {{Form::close()}}
</div>
