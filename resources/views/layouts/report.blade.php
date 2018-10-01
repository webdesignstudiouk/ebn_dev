@include('layouts/includes.header')
@include('layouts/includes.sidebar')

<div class='row'>
        <div class="col-sm-3">
            <a href="{{route('reports')}}" class="btn btn-success" style="width:100%;">Back To Reports</a>
            @if(isset($data))
            <div class="xe-widget xe-counter" style="text-align: center;">
                <div class="xe-label">
                    <strong class="num">{{(isset($custom_count) ? $custom_count : $data->count())}}</strong> <span>Total</span>
                </div>
            </div>
            @endif
        </div>
</div>

<div class='row'>
    <div class='col-sm-12'>
        @yield("content")
    </div>
</div>

@include('layouts/includes.footer')
