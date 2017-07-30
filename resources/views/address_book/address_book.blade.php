@extends('layouts.admin')

@section('page-title', 'Address Book')
@section('page-description', 'Address Book')

@section('content')
    <section id="addressBook">
    <div class="row">
        <div class="col-md-12">

            <ul class="nav nav-tabs">
                <li class="@php echo ($type == 2 ? "active" : ""); @endphp">
                    <a href="{{route('addressBook', '2')}}">Suppliers</a>
                </li>
                <li class="@php echo ($type == 1 ? "active" : ""); @endphp">
                    <a href="{{route('addressBook', '1')}}">Prospects, Prospect 2's, Clients</a>
                </li>
                <li>
                    <a href="{{route('addressBook.create')}}">Create</a>
                </li>
            </ul>

            <div class="tab-content">
                @yield('sub-content')
            </div>
        </div>
    </div>
    </section>
@endsection