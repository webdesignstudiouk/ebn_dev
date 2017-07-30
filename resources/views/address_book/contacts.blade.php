@extends('address_book.address_book')

@section('sub-content')
<table class="table table-hover members-table middle-align">
    <thead>
    <tr>
        <th>ID</th>
        <th>Company</th>
        <th>Name</th>
        <th>E-Mail</th>
        <th>Phone Number</th>
        <th>Settings<br/>
            <span style="font-weight:100;">If Assigned To Prospect/Client <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i></span><br/>
            <span style="font-weight:100;">Delete Contact | Instant <i class="fa fa-circle" style="color:#cc3f44; float:right;"></i></span>
        </th>
    </tr>
    </thead>
    <tbody>
    @php $contacts = $contacts->whereNull('deleted_at')->where('type_id', $type)->paginate(100); @endphp
    @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->id }}</td>
            <td>
                @if(isset($contact->prospect->company))
                    {{ $contact->prospect->company }}
                @endif
            </td>
            <td class="user-name">
                <a class="name" href="#">{{ $contact->first_name }} {{ $contact->second_name }}</a>
            </td>
            <td class="hidden-xs hidden-sm"><span class="email">{{ $contact->email }}</span></td>
            <td class="user-id">{{ $contact->phonenumber }}2</td>
            <td class="action-links">
                @if($contact->prospect_id != null)
                    <a href="{{route('prospects.edit', $contact->prospect_id)}}">
                        <i class="fa fa-search btn btn-icon btn-success"></i>
                    </a>
                @endif
                <a href="{{route('addressBook.delete', $contact->id)}}">
                    <i class="fa fa-times btn btn-icon btn-danger"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<center>{{ $contacts->links() }}</center>

@endsection