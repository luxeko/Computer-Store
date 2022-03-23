@extends('admin.layout.layout')

@section('title')
    <title>Dashboard</title>
@endsection

@section('name_page')
    <h3 class="">Dashboard</h3>
@endsection

@section('content')
   @yield('dashboard')
@endsection