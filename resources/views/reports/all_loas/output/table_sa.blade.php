@php
    $counts = array(
        'sent_date' => 0,
        'pending' => 0,
        'recieved' => 0,
        'active' => 0,
        'fso_minus' => 0,
        'fso_plus' => 0,
        'loa_won' => 0,
    );
    $loa_data = array();
    $tick_icon = '<i class="fas fa-check" style="user-select: auto; text-align: center; color: #8dc63f; display: inline-block; width: 100%; padding-top:8px;"></i>';
    $cross_icon = '<i class="fas fa-times" style="user-select: auto; text-align: center; color: #cc3f44; display: inline-block; width: 100%; padding-top:8px;"></i>';


    foreach($data as $d) {
        $loa = array();

        // Prospect info
        $loa['prospect_id'] = $d->prospect_r->id;
        $loa['prospect_name'] = $d->prospect_r->company;
        $loa['agents_name'] = $d->prospect_r->user->first_name.' '.$d->prospect_r->user->second_name;


        // Sent Date
        $sent_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $d->sent)->format('d/m/Y');
        if($d->supplier_confirmed_ced != '' && $d->supplier_confirmed_ced != null){
        $sup_diff = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $d->supplier_confirmed_ced)->diffInMonths(\Carbon\Carbon::now());
        }
        $loa['sent_date'] = $sent_date;
        $counts['sent_date']++;


        if(isset($sup_diff) && $sup_diff <= 12){
            $loa['fso_minus'] = true;
            $counts['fso_minus']++;
        }else{
            $loa['fso_minus'] = false;
        }

        if(isset($sup_diff) && $sup_diff > 12){
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
        if($d->loa_won == '1'){
             $loa['loa_won'] = true;
             $counts['loa_won']++;
        }else{
            $loa['loa_won'] = false;
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
    }

    // Render table
    $table = new App\Classes\Table('', 'table table-striped floatThead-table');
    $table->addRow();
    if($admin){
        $table->addCell('Prospect ID', '', 'header');
        $table->addCell('Prospect Name', '', 'header');
        $table->addCell('Agent', '', 'header');
    }
    $table->addCell('Sent', '', 'header');
    $table->addCell('Pending '.$percentages['pending']['fp'], '', 'header');
    $table->addCell('Recieved '.$percentages['recieved']['fp'], '', 'header');
    $table->addCell('Active '.$percentages['active']['fp'], '', 'header');
    $table->addCell('FSO 12m - '.$percentages['fso_minus']['fp'], '', 'header');
    $table->addCell('FSO 12m + '.$percentages['fso_plus']['fp'], '', 'header');
    $table->addCell('Won / Lost '.$percentages['loa_won']['fp'], '', 'header');

    foreach($loa_data as $ld) {
        $table->addRow();
        if($admin){
            $table->addCell($ld['prospect_id']);
            $table->addCell($ld['prospect_name']);
            $table->addCell($ld['agents_name']);
        }
        $table->addCell($ld['sent_date']);
        $table->addCell(($ld['pending'] ? $tick_icon : $cross_icon));
        $table->addCell($ld['recieved']);
        $table->addCell(($ld['active'] ? $tick_icon : $cross_icon));
        $table->addCell(($ld['fso_minus'] ? $tick_icon : $cross_icon));
        $table->addCell(($ld['fso_plus'] ? $tick_icon : $cross_icon));
        $table->addCell(($ld['loa_won'] ? $tick_icon : $cross_icon));
    }

   echo $table->display();
@endphp