@php
    $table = new App\Classes\Table('', 'table table-striped floatThead-table');
    $table->addRow();
    $table->addCell('ID', '', 'header');
    $table->addCell('Company', '', 'header');
    $table->addCell('Email', '', 'header');

    foreach($data as $d) {
        $table->addRow();
        $table->addCell($d->id);
        $table->addCell($d->company);
        $table->addCell($d->email);
    }

   echo $table->display();
@endphp