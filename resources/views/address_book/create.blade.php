@extends('address_book.address_book')

@section('sub-content')
{{Form::open([route('addressBook.store'), 'method'=>'post'])}}
{{Form::token()}}

<div class="form-group">
    <label for="type_id" class="control-label">Contact Type</label>
    {{Form::select('type_id', \App\Models\ContactsTypes::pluck('title', 'id')->toArray(), null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    <label for="title" class="control-label">Title</label>
    {{Form::select('title', array('Mr' => 'Mr', 'Mrs' => 'Mrs', 'Miss' => 'Miss', 'Ms' => 'Ms'), null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    <label for="job_title" class="control-label">Job Title</label>
    {{Form::input('text', 'job_title', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    <label for="first_name" class="control-label">First Name</label>
    {{Form::input('text', 'first_name', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    <label for="second_name" class="control-label">Second Name</label>
    {{Form::input('text', 'second_name', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    <label for="email" class="control-label">Email</label>
    {{Form::input('email', 'email', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    <label for="phonenumber" class="control-label">Phone Number</label>
    {{Form::input('text', 'phonenumber', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    <label for="mobile_number" class="control-label">Mobile Number</label>
    {{Form::input('text', 'mobile_number', null, ['class'=>'form-control'])}}
</div>


{{Form::input('submit', 'submit', 'Add To Address Book', ['class'=>'btn btn-success'])}}

{{Form::close()}}
@endsection