@extends('layouts.report')

@section('page-title', 'Generated Report')
@section('page-description', 'Table Format.')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>{{$title}}</b> <span class="badge badge-info">{{$report_beginDate->format('d/m/Y')}} - {{$report_endDate->format('d/m/Y')}}</span>
            </h3>
        </div>
       @php
            $table = new App\Classes\Table('', 'table table-striped floatThead-table');
            $table->addRow();
            $table->addCell('ID', '', 'header');
            $table->addCell('Company', '', 'header');
            $table->addCell('Verbal CED', '', 'header');
            $table->addCell('Options', '', 'header');

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

                if($verbalCED->isPast()){
                    $table->addCell($d->verbalCED);
                }elseif($verbalCED->isToday()){
                    $table->addCell($d->verbalCED.'<span style="margin-left:15px;" class="badge badge-'.$color.'">'.$verbalCED->diffInDays(\Carbon\Carbon::now()).' Until End Date</span>');
                }else{
                    $table->addCell($d->verbalCED.'<span style="margin-left:15px;" class="badge badge-'.$color.'">'.$verbalCED->diffInDays(\Carbon\Carbon::now()).' Until End Date</span>');
                }

                $table->addCell("<a href='".route('prospects.edit', $d->id)."'>View Account</a>");

            }

           echo $table->display();
       @endphp
    </div>
@endsection