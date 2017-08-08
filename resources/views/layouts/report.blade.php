@include('layouts/includes.header')
@include('layouts/includes.sidebar')

<div class='row'>
    <div class='col-sm-12'>

        @yield("content")

    </div>
</div>

@include('layouts/includes.footer')
