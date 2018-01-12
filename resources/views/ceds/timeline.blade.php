@extends('ceds.timeline-admin')

@section('page-title', 'Contract End Dates | '.Auth::user()->first_name)
@section('page-description', 'List Of all ceds.')

@section('extra-breadcrumbs')
    <li><a href="">{{$prospect_type->title}}</a></li>
@endsection

@section('content')
        <div class="col-sm-6">
            <p style="margin-left: 65px;">This is the old CED's which show prospects/clients that will be running out in this month!</p>
            <ul class='cbp_tmtimeline'>
        @php
            $distinctCED = $prospectModal->select(DB::raw("DISTINCT DATE_FORMAT(STR_TO_DATE( verbalCED ,'%d/%m/%Y'),'%m-%Y') as date, MONTH(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) as month, YEAR(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) as year"))
                                         ->where('verbalCED', '!=', '')
                                         ->where('user_id', '=', Auth::user()->id)
                                         ->where('type_id', ($prospect_type->id == '' || is_null($prospect_type) || $prospect_type->id > 3 ? 1 : $prospect_type->id))
                                         ->orderBy('year', 'ASC')
                                         ->pluck('date');
        @endphp
        @foreach($distinctCED as $c1)
            @php
                $collapseId = str_replace('-', '', stripslashes($c1));
                $prospects = $prospectModal->whereRAW("MONTH(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) = ".Carbon\Carbon::createFromFormat('d-m-Y', '01-'.$c1)->format('m'))
                                       ->whereRAW("YEAR(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) = ".Carbon\Carbon::createFromFormat('d-m-Y', '01-'.$c1)->format('Y'))
                                       ->where('type_id', ($prospect_type->id == '' || is_null($prospect_type) || $prospect_type->id > 3 ? 1 : $prospect_type->id))
                                       ->where('user_id', '=', Auth::user()->id)
                                       ->orderBy('verbalCED', 'ASC')
                                       ->get();

                $count = $prospects->count();
                $current_dd = Carbon\Carbon::createFromFormat('d-m-Y', '01-'.$c1);
            @endphp
            <li>
                <div class='cbp_tmicon timeline-bg-danger'>
                    <a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}'
                       aria-expanded='false' aria-controls='{{$collapseId}}' style="color:#fff;">
                        {{$count}}
                    </a>
                </div>
                <a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}'
                   aria-expanded='false' aria-controls='{{$collapseId}}'>
                    <div class='cbp_time'>{{$current_dd->format('m/Y')}} -
                        <small style='font-size:12px;'>CEDs: {{$current_dd->diffForHumans()}}</small>
                        {!! (date('Y') == $current_dd->format('Y') && date('m') == $current_dd->format('m') ? "<span style='font-size:12px; float:right;' class='badge badge-success'>current month</span>" : '')!!}
                    </div>
                </a>
                <div class='collapse' id='{{$collapseId}}'>
                    @foreach($prospects as $c2)

                        <div class='cbp_tmlabel' style='padding:0px!important; color:#000!important'>
                            <div class='xe-widget xe-weather' style='background:#fff!important;'>
                                <div class='xe-current-day'>
                                    <div class='xe-now'>
                                        <div class='xe-temperature' style='color:#000!important;'>
                                            <h3>{{$c2->company}}</h3>
                                            <p>Verbal CED: {{$c2->verbalCED}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class='xe-weekdays' style='background:#459ec4!important;'>
                                    <ul class='list-unstyled'>
                                        <li>
                                            <div class='xe-weekday-forecast'>
                                                <div class='xe-day' style='cursor:pointer;'>
                                                    <a href="{{route('prospects.edit', $c2->id)}}"
                                                       style='color:#fff;'>View Prospect</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='xe-weekday-forecast'>
                                                <div class='xe-day' style='cursor:pointer;'>
                                                    <a href="{{route('prospect.sites', $c2->id)}}"
                                                       style='color:#fff;'>View Sites</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='xe-weekday-forecast'>
                                                <div class='xe-day' style='cursor:pointer;'>

                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </li>
                @endforeach
            </ul>
        </div>
    <div class="col-sm-6">
        <p style="margin-left: 65px;">This is the old CED's which show prospects/clients that will be running out in 1 years time!</p>
        <ul class='cbp_tmtimeline'>
        @php
            $distinctCED = $prospectModal->select(DB::raw("DISTINCT DATE_FORMAT(STR_TO_DATE( verbalCED ,'%d/%m/%Y'),'%m-%Y') as date, MONTH(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) as month, YEAR(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) as year"))
                                         ->where('verbalCED', '!=', '')
                                         ->where('user_id', '=', Auth::user()->id)
                                         ->where('type_id', ($prospect_type->id == '' || is_null($prospect_type) || $prospect_type->id > 3 ? 1 : $prospect_type->id))
                                         ->orderBy('year', 'ASC')
                                         ->pluck('date');
        @endphp
        @foreach($distinctCED as $c1)
            @php
                $collapseId = str_replace('-', '', stripslashes($c1)).'02';
                $prospects = $prospectModal->whereRAW("MONTH(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) = ".Carbon\Carbon::createFromFormat('d-m-Y', '01-'.$c1)->format('m'))
                                       ->whereRAW("YEAR(STR_TO_DATE( verbalCED ,'%d/%m/%Y')) = ".Carbon\Carbon::createFromFormat('d-m-Y', '01-'.$c1)->format('Y'))
                                       ->where('type_id', ($prospect_type->id == '' || is_null($prospect_type) || $prospect_type->id > 3 ? 1 : $prospect_type->id))
                                       ->where('user_id', '=', Auth::user()->id)
                                       ->orderBy('verbalCED', 'ASC')
                                       ->get();

                $count = $prospects->count();
                $current_dd = Carbon\Carbon::createFromFormat('d-m-Y', '01-'.$c1)->subYear();
                if($current_dd < Carbon\Carbon::now()){
                    continue;
                }
                $new_dd = $current_dd;
            @endphp
            <li>
                <div class='cbp_tmicon timeline-bg-warning'>
                    <a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}'
                       aria-expanded='false' aria-controls='{{$collapseId}}' style="color:#fff;">
                        {{$count}}
                    </a>
                </div>
                <a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}'
                   aria-expanded='false' aria-controls='{{$collapseId}}'>
                    <div class='cbp_time'>{{$current_dd->format('m/Y')}} -
                        <small style='font-size:12px;'>CEDs: {{$new_dd->addYear()->diffForHumans()}}</small>
                        {!! (date('Y') == $current_dd->format('Y') && date('m') == $current_dd->format('m') ? "<span style='font-size:12px; float:right;' class='badge badge-success'>current month</span>" : '')!!}
                    </div>
                </a>
                <div class='collapse' id='{{$collapseId}}'>
                    @foreach($prospects as $c2)

                        <div class='cbp_tmlabel' style='padding:0px!important; color:#000!important'>
                            <div class='xe-widget xe-weather' style='background:#fff!important;'>
                                <div class='xe-current-day'>
                                    <div class='xe-now'>
                                        <div class='xe-temperature' style='color:#000!important;'>
                                            <h3>{{$c2->company}}</h3>
                                            <p>Verbal CED: {{$c2->verbalCED}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class='xe-weekdays' style='background:#459ec4!important;'>
                                    <ul class='list-unstyled'>
                                        <li>
                                            <div class='xe-weekday-forecast'>
                                                <div class='xe-day' style='cursor:pointer;'>
                                                    <a href="{{route('prospects.edit', $c2->id)}}"
                                                       style='color:#fff;'>View Prospect</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='xe-weekday-forecast'>
                                                <div class='xe-day' style='cursor:pointer;'>
                                                    <a href="{{route('prospect.sites', $c2->id)}}"
                                                       style='color:#fff;'>View Sites</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='xe-weekday-forecast'>
                                                <div class='xe-day' style='cursor:pointer;'>

                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </li>
        @endforeach
    </ul>
    </div>
            @if(count($distinctCED) == 0)
                <div class="alert alert-warning">
                    No Results found
                </div>
            @endif
@endsection
