@php
    $table = new App\Classes\Table('', 'table table-striped floatThead-table');
    $table->addRow();
    $table->addCell('ID', '', 'header');
    $table->addCell('Company', '', 'header');
    $table->addCell('LOA Recieved', '', 'header');
    $table->addCell('Business Won', '', 'header');
    $table->addCell('Business Lost', '', 'header');
    $table->addCell('LOA Pending', '', 'header');
    $table->addCell('Options', '', 'header');

    foreach($data as $d) {
        $table->addRow();
        $table->addCell($d->id);
        $table->addCell($d->company);
        $table->addCell($d->loa_recieved);
        $table->addCell($d->loa_business_won);
        $table->addCell($d->loa_business_lost);
        $table->addCell($d->loa_pending);
        $table->addCell("<a href='".route('prospects.edit', $d->id)."'>View Account</a>");
    }

   echo $table->display();
@endphp