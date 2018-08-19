@extends('layouts.report')

@section('page-title', 'Generated Report')
@section('page-description', 'Table Format.')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>
                    @if($type == 'mug_sent')
                        Mugs Sent
                    @else
                        Brochure's Sent
                    @endif
                </b>
            </h3>
        </div>
        @php
            $table = new App\Classes\Table('', 'table table-striped floatThead-table');
            $table->addRow();
            $table->addCell('ID', '', 'header');
            $table->addCell('Agent', '', 'header');
            $table->addCell('Company', '', 'header');
            $table->addCell('Email', '', 'header');
            $table->addCell('Options', '', 'header');

            foreach($data as $d) {
                $table->addRow();
                $table->addCell($d->id);
                $table->addCell($d->user->first_name.' '.$d->user->second_name);
                $table->addCell($d->company);
                $table->addCell($d->email);
                $table->addCell("<a href='".route('prospects.edit', $d->id)."'>View Account</a>");
            }

           echo $table->display();
        @endphp
    </div>
@endsection