@extends('layouts.report')

@section('page-title', 'Generated Report')
@section('page-description', 'Table Format.')


    @php
    if($type == 'mug_sent'){
        $title = 'Mug Sent';
    }elseif($type == 'brochure_sent'){
        $title = 'Brochure Sent';
    }elseif($type == 'brochure_request'){
        $title = 'Brochure Requested';
    }
    @endphp
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>{{$title}}</b>
            </h3>
        </div>
        @php
            $table = new App\Classes\Table('', 'table table-striped floatThead-table');
            $table->addRow();
            $table->addCell('ID', '', 'header');
            $table->addCell('Agent', '', 'header');
            $table->addCell($title.' Date', '', 'header');
            $table->addCell('Company', '', 'header');
            $table->addCell('Email', '', 'header');
            $table->addCell('Options', '', 'header');

            $date_field = $type.'_date';

            foreach($data as $d) {
                $table->addRow();
                $table->addCell($d->id);
                $table->addCell($d->user->first_name.' '.$d->user->second_name);
                $table->addCell( (isset($d->$date_field) && $d->$date_field != '' ? Carbon\Carbon::parse($d->$date_field)->format('d/m/Y') : '<span class="badge badge-warning">No Date Logged</a>' ) );
                $table->addCell($d->company);
                $table->addCell($d->email);
                $table->addCell("<a href='".route('prospects.edit', $d->id)."'>View Account</a>");
            }

           echo $table->display();
        @endphp
    </div>
@endsection