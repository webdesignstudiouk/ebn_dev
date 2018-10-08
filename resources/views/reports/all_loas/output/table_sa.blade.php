@php
    $counts = array(
        'sent_date' => 0,
        'pending' => 0,
        'recieved' => 0,
        'active' => 0,
        'fso_minus' => 0,
        'fso_plus' => 0,
        'loa_won' => 0,
        'loa_lost' => 0,
        'loa_open' => 0,
    );
    $loa_data = array();
    $tick_icon = '<i class="fas fa-check" style="user-select: auto; text-align: center; color: #8dc63f; display: inline-block; width: 100%; padding-top:8px;"></i>';
    $cross_icon = '<i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>';


    foreach($data as $d) {
        $loa = array();

        $loa['prospect_m'] = $d->prospect_r;

        // Prospect info
        $loa['prospect_id'] = $d->prospect_r->id;
        $loa['prospect_name'] = $d->prospect_r->company;
        $loa['agents_name'] = $d->prospect_r->user->first_name.' '.$d->prospect_r->user->second_name;


        // Sent Date
        if(isset($d->not_from_loas)){
            $sent_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $d->loa_sent_date)->format('d/m/Y');
            $loa['sent_date'] = $sent_date;
            $loa['not_from_loas'] = $sent_date;
            $counts['sent_date']++;
        }else{
            $sent_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $d->sent)->format('d/m/Y');
            if($d->supplier_confirmed_ced != '' && $d->supplier_confirmed_ced != null){
            $sup_diff = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $d->supplier_confirmed_ced)->diffInMonths(\Carbon\Carbon::now());
            }
            $loa['sent_date'] = $sent_date;
            $counts['sent_date']++;
        }


        if(isset($sup_diff) && $sup_diff <= 12 && !$d->supplier_confirmed_ced == ''){
            $loa['fso_minus'] = true;
            $counts['fso_minus']++;
        }else{
            $loa['fso_minus'] = false;
        }

        if(isset($sup_diff) && $sup_diff > 12 && !$d->supplier_confirmed_ced != ''){
            $loa['fso_plus'] = true;
            $counts['fso_plus']++;
        }else{
            $loa['fso_plus'] = false;
        }

        // Recieved Date
         if(isset($d->recieved) && $d->recieved != null){
            if(isset($d->prospect_r->verbalCED) && $d->prospect_r->verbalCED != null){
                $verbal_ced = Carbon\Carbon::createFromFormat('d/m/Y', $d->prospect_r->verbalCED);
            }
            $recieved_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $d->recieved);
            $loa['recieved'] = $recieved_date->format('d/m/Y');
        }else{
            $loa['recieved'] = '-';
        }
        if($d->recieved == ''){
             $loa['pending'] = true;
             $counts['pending']++;
        }else{
            $loa['pending'] = false;
            $counts['recieved']++;
        }
        if(isset($recieved_date) && isset($verbal_ced)){
            $diff = $recieved_date->diffInMonths($verbal_ced);
        }

        // Active
        if($d->active == '1'){
             $loa['active'] = true;
             $counts['active']++;
        }else{
            $loa['active'] = false;
        }

        // Won Lost
       if($d->loa_won == 'won'){
             $loa['loa_won'] = '<span style="color:#8dc63f">Won</span>';
             $counts['loa_won']++;
        }elseif($d->loa_won == 'lost'){
            $loa['loa_won'] = '<span style="color:#cc3f44">Lost</span>';
            $counts['loa_lost']++;
        }else{
            $loa['loa_won'] = '<span style="color:#40bbea">Open</span>';
            $counts['loa_open']++;
        }

        // Options
        $options = '<a href="'.route('prospects.edit', $d->prospect_r->id).'">View Prospect</a>';

        $loa_data[] = $loa;
    }

    // Percentage
    $percentages = array();
    foreach($counts as $key => $count){
        $percentage = ($data->count() > 0 ? ($count / $data->count()) * 100 : 0 );
        $percentages[$key]['percentage'] = number_format($percentage, '1');
        $percentages[$key]['fp'] =  '
        <br/><span style="font-size:24px; text-align:center;">'. $percentages[$key]['percentage'].'%</span>
        <br/><span class="badge badge-info" style="font-size:14px; text-align:center;">'. $count.' / '.$data->count().'</span>
        ';

        $class= ($key == 'loa_won') ? 'success' : (($key == 'loa_open') ? 'info' : 'danger');
        $percentages[$key]['fp_'] =  '
        <span style="font-size:18px; text-align:center; display:inline-block;">'.ucwords(str_replace('loa_', '', $key)).' <span class="badge badge-'.$class.'" style="font-size:14px; text-align:center; display:inline-block; margin-bottom:5px;">'. $percentages[$key]['percentage'].'%</span></span><br/>
        ';
    }
@endphp

<table class="table table-striped floatThead">
    <thead>
    <tr>
        @if($admin)
            <th>Prospect ID</th>
            <th>Prospect Name</th>
            <th>Agent</th>
        @endif
        <th>Sent {!!$percentages['sent_date']['fp']!!}</th>
        <th>Pending {!!$percentages['pending']['fp']!!}</th>
        <th>Recieved {!!$percentages['recieved']['fp']!!}</th>
        <th>Active {!!$percentages['active']['fp']!!}</th>
        <th>FSO 12m - {!!$percentages['fso_minus']['fp']!!}</th>
        <th>FSO 12m + {!!$percentages['fso_plus']['fp']!!}</th>
        <th>{!!$percentages['loa_won']['fp_']!!} {!!$percentages['loa_open']['fp_']!!} {!!$percentages['loa_lost']['fp_']!!}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($loa_data as $ld)
        <tr>
            @if($admin)
                <td>{{$ld['prospect_id']}}</td>
                <td>{{ $ld['prospect_name']}} {!! (isset($ld['not_from_loas']) ? '<span style="float:right;" class="badge badge-info">From Prospect Info</span>' : '') !!}</td>
                <td>{{$ld['agents_name']}}</td>
            @endif
            <td>{{$ld['sent_date']}}</td>
            <td>{!! $ld['pending'] ? $tick_icon : $cross_icon !!}</td>
            <td>{{$ld['recieved']}}</td>
            <td>{!! $ld['active'] ? $tick_icon : $cross_icon !!}</td>
            <td>{!! $ld['fso_minus'] && (!isset($ld['not_from_loas'] ||  $ld['suppl']) ? $tick_icon : $cross_icon !!}</td>
            <td>{!! $ld['fso_plus'] && !isset($ld['not_from_loas']) ? $tick_icon : $cross_icon !!}</td>
            <td>{!! $ld['loa_won']!!}</td>
        </tr>
    @endforeach
    </tbody>
</table>