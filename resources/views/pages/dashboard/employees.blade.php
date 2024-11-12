@extends('layout.sidenav-layout')
@section('content')
    @include('components.employee.employees-list')
    @include('components.employee.employee-create')
    @include('components.employee.employee-update')
    @include('components.employee.employee-delete')
@endsection
