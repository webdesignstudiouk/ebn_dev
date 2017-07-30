@foreach($prospects as $prospect)
    <tr>
        <td>
            {{$prospect->id}}
            @role('admin')
            <input type="checkbox" name="prospectToMove[]" value="{{ $prospect->id }}" style="float:right;"/>
            @endrole
        </td>
        <td>{{$prospect->user->first_name}} {{$prospect->user->second_name}}</td>
        <td>{{$prospect->company}}</td>
        <td>{{$prospect->email}}</td>
        <td><a href="http://webdesignstudiouk.com/hosting/ebn_dev/admin/prospects/{{$prospect->id}}/edit">View Account</a></td>
    </tr>
@endforeach