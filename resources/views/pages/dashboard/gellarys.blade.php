@extends('layout.sidenav-layout')
@section('content')
    @include('components.gellary.gellarys-list')
    @include('components.gellary.gellary-create')
    @include('components.gellary.gellary-update')
    @include('components.gellary.gellary-delete')
@endsection
