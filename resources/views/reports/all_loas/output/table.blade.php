@extends((isset($protected) && $protected) ? 'layouts.admin' : 'layouts.report'))

@section('page-title', 'Generated Report')
@section('page-description', 'Table Format.')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                <b>{{$title}}</b> <span class="badge badge-info"></span>
            </h3>
        </div>

         @include('reports.all_loas.output.table_sa', ['data' => $data, 'admin' => true])
    </div>
@endsection