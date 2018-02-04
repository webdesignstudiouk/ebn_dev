<div class="panel panel-default">
    <div class="panel-heading" style="margin-bottom:20px;">
        <h3 class="panel-title">Contacts</h3>
    </div>

    <table class="table table-striped ahref">
        <thead>
        <tr>
            <th>ID</th>
            <th>Favourite<br/>
                <span style="font-weight:100;">
						Current Favourite <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
					</span><br/>
                <span style="font-weight:100;">
						Make Favourite <i class="fa fa-circle" style="color:#ffba00; float:right;"></i>
                </span>
            </th>
            <th>Job Title</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Numbers<br/>
                <span style="font-weight:100;">
						Phone Number <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
					</span><br/>
                <span style="font-weight:100;">
						Mobile Number <i class="fa fa-circle" style="color:#ffba00; float:right;"></i>
                </span>
            </th>
            <th>View Account</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prospect->contacts as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>
                    @if($c->favourite != null)
                        <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
                    @else
                        <a class="btn btn-warning btn-xs" style="float:right;" href="{{route('contact.favourite', ['prospect_id'=>$prospect->id, 'contact_id'=>$c->id])}}">Make Favourite</a>
                    @endif
                </td>
                <td>{{$c->job_title}}</td>
                <td>{{$c->title}} {{$c->first_name}} {{$c->second_name}}</td>
                <td>{{$c->email}}</td>
                <td>
                    @if($c->phonenumber != '')
                        {{$c->phonenumber}} <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i><br/>
                    @endif
                    @if($c->mobile_number != '')
                        {{$c->mobile_number}} <i class="fa fa-circle" style="color:#ffba00; float:right;"></i>
                    @endif
                </td>
                <td><a href="{{route('contacts.edit', ['prospect_id'=>$prospect->id, 'contact_id'=>$c->id])}}">View Account</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
