@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-description', 'Dashboard')

@section('content')
    <div class="col-md-6">
        <pre class="pre-line" style="white-space:normal;">
        @foreach($commits as $commit)
                <b>{{ trim(\Carbon\Carbon::createFromFormat(DateTime::ISO8601, $commit['commit']['author']['date'])-> format('d/m/Y h:m')) }} </b>
                <br/>
                {{ $commit['commit']['message'] }}<br/>
            @endforeach
        </pre>
    </div>
@endsection
