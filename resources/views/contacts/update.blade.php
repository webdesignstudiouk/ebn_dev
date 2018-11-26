<div class="panel panel-default">
    <div class="panel-heading" style="margin-bottom:20px;">
        <h3 class="panel-title">Update Contact</h3>
    </div>

    {{Form::open(array('url' => route('contacts.update', array($prospect->id, $contact->id)), 'method'=>'post'))}}
        {{Form::input('hidden', '_method', 'put')}}
        {{Form::input('hidden', 'id', $contact->id)}}
        <div class="form-group">
            <label for="type_id" class="control-label">Contact Type</label>
            {{Form::select('type_id', array_pluck(\App\Models\ContactsTypes::all(), 'title', 'id'), $contact->type_id, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="title" class="control-label">Title</label>
            {{Form::select('title', array('Mr'=>'Mr', 'Mrs'=>'Mrs','Miss'=>'Miss','Ms'=>'Ms'), $contact->title, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="job_title" class="control-label">Job Title</label>
            {{Form::input('text', 'job_title', $contact->job_title, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="first_name" class="control-label">First Name</label>
            {{Form::input('text', 'first_name', $contact->first_name, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="second_name" class="control-label">Surname</label>
            {{Form::input('text', 'second_name', $contact->second_name, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            {{Form::input('email', 'email', $contact->email, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="phonenumber" class="control-label">Direct Dial</label>
            {{Form::input('text', 'phonenumber', $contact->phonenumber, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <label for="mobile_number" class="control-label">Mobile Number</label>
            {{Form::input('text', 'mobile_number', $contact->mobile_number, ['class'=>'form-control'])}}
        </div>

        {{Form::input('submit', '', 'Update Contact', ['class'=>'btn btn-success', 'style'=>'width:100%'])}}
    {{Form::close()}}
</div>