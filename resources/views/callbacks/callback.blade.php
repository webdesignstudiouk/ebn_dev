@if(\App\Models\Prospects::find($c2->prospect_id) != null)
  @if(\App\Models\Prospects::find($c2->prospect_id)->user_id == \Auth::user()->id)
    @if(isset($c2->prospect->company))
      @if($c2->callbackTime == "00:00:00")
        @php
          $backgroundColor = "#ff6264";
        @endphp
      @else
        @php
          $backgroundColor = "#459ec4";
        @endphp
      @endif

      <div class='cbp_tmlabel' style='padding:0px!important; color:#000!important'>
        <div class='xe-widget xe-weather' style='background:#fff!important;'>
          <div class='xe-current-day'>
            <div class='xe-now'>
              <div class='xe-temperature' style='color:#000!important;'>
                <h3>{{$c2->prospect->company}} <small style='color:{{$backgroundColor}};'>{{$c2->callbackTime}}</small></h3>
                <small style='color:#000; text-decoration:underline; margin-right:5px;'>{{$c2->author->first_name}} {{$c2->author->second_name}}</small> : <time> {{$c2->note}}</time>
              </div>
            </div>
          </div>
          <div class='xe-weekdays' style='background:{{$backgroundColor}}!important;'>
            <ul class='list-unstyled'>
            <li>
              <div class='xe-weekday-forecast'>
                <div class='xe-day' style='cursor:pointer;'>
                  <a href='{{url("admin/prospects/".$c2->prospect->id."/edit#callbacks+".$c2->id) }}' style='color:#fff;'>View Callback</a>
                </div>
              </div>
            </li>
            <li>
              <div class='xe-weekday-forecast'>
                <div class='xe-day' style='cursor:pointer;'>
                  <a href='{{url("admin/prospects/".$c2->prospect->id."/edit#callbacks") }}' style='color:#fff;'>Create A New Callback</a>
                </div>
              </div>
            </li>
            <li>
              <div class='xe-weekday-forecast'>
                <div class='xe-day' style='cursor:pointer;'>
                  <a  href="{{url('admin/delete_callback/'.$c2->id)}}" style='color:#fff;'>Mark As Read</a>
                </div>
              </div>
            </li>
            </ul>
          </div>
        </div>
      </div>
    @endif
  @endif
@endif
