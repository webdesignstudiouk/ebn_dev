<div class="panel panel-default" style="background-color: #f4f4f4;">
    <div class="panel-heading" style="margin-bottom:20px;">
        <h3 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_create_contact" aria-expanded="false">
                Create Contact
            </a>
        </h3>
    </div>

    <div id="collapse_create_contact" class="panel-collapse collapse">
        {{Form::open(array('url' => route('contacts.store', $prospect->id), 'method'=>'post'))}}
            {{Form::input('hidden', 'prospect_id', $prospect->id)}}
            <div class="form-group">
                <label for="type_id" class="control-label">Contact Type</label>
                {{Form::select('type_id', array_pluck(\App\Models\ContactsTypes::all(), 'title', 'id'), '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="title" class="control-label">Title</label>
                {{Form::select('title', array('Mr'=>'Mr', 'Mrs'=>'Mrs','Miss'=>'Miss','Ms'=>'Ms'), '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="job_title" class="control-label">Job Title</label>
                {{Form::input('text', 'job_title', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="first_name" class="control-label">First Name</label>
                {{Form::input('text', 'first_name', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="second_name" class="control-label">Second Name</label>
                {{Form::input('text', 'second_name', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                {{Form::input('email', 'email', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="phonenumber" class="control-label">Phone Number</label>
                {{Form::input('text', 'phonenumber', '', ['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                <label for="mobile_number" class="control-label">Mobile Number</label>
                {{Form::input('text', 'mobile_number', '', ['class'=>'form-control'])}}
            </div>

            {{Form::input('submit', '', 'Create Contact', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
        {{Form::close()}}
    </div>
</div>