<div class="panel panel-default" style="background-color: #f4f4f4;">
    <div class="panel-heading" style="margin-bottom:20px;">
        <h3 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_create_site" aria-expanded="false">
                Create Site
            </a>
        </h3>
    </div>

    <div id="collapse_create_site" class="panel-collapse collapse">
        {{Form::open(array('url' => route('sites.store', $prospect->id), 'method'=>'post'))}}
            {{Form::input('hidden', 'prospect_id', $prospect->id)}}
            <div class="form-group">
                <label for="name" class="control-label">Site Name</label>
                {{Form::input('text', 'name', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="street_1" class="control-label">Street 1</label>
                {{Form::input('text', 'street_1', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="street_2" class="control-label">Street 2</label>
                {{Form::input('text', 'street_2', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="street_3" class="control-label">Street 3</label>
                {{Form::input('text', 'street_3', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="Town" class="control-label">Street 4</label>
                {{Form::input('text', 'street_4', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="City" class="control-label">Town</label>
                {{Form::input('text', 'town', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="City" class="control-label">City</label>
                {{Form::input('text', 'city', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="county" class="control-label">County</label>
                {{Form::input('text', 'county', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="post_code" class="control-label">Post Code</label>
                {{Form::input('text', 'post_code', '', ['class'=>'form-control'])}}
            </div>
            {{Form::input('submit', '', 'Create Site', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
        {{Form::close()}}
    </div>
</div>
