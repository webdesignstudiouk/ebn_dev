@php
    $table = new App\Classes\Table('', 'table table-striped floatThead-table');
    $table->addRow();
    $table->addCell('ID', '', 'header');
    $table->addCell('Company', '', 'header');
    $table->addCell('Verbal CED', '', 'header');

    foreach($data as $d) {
        $table->addRow();
        $table->addCell($d->id);
        $table->addCell($d->company);

        $verbalCED = \Carbon\Carbon::createFromFormat('d/m/Y', $d->verbalCED);
        if($verbalCED->diffInDays(\Carbon\Carbon::now()) >= 7){
           $color = 'danger';
        }elseif($verbalCED->diffInDays(\Carbon\Carbon::now()) >= 30){
            $color = 'warning';
        }else{
            $color = 'success';
        }

        $table->addCell($d->verbalCED);
    }

   echo $table->display();
@endphp