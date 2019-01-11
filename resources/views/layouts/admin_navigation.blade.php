@include('layouts/includes.header')
@include('layouts/includes.sidebar')

<div class='row'>
    <div class='col-sm-12'>
        <ol class="breadcrumb" style="background:#fff; border-bottom:2px solid #A6CE39;">
            @yield("breadcrumbs")
        </ol>
    </div>
    @if(isset($is_report) && $is_report)
        <div class='col-sm-12'>
            @yield("content")
        </div>
    @else
        <div class='col-sm-3'>
            <ul class="nav nav-tabs" role="tablist" id="tab-sidebar">
                @yield("sidebar")
            </ul>
        </div>
        <div class='col-sm-9'>
            @yield("content")
        </div>
    @endif
</div>

@include('layouts/includes.footer')
