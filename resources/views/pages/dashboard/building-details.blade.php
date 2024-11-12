@extends('layout.sidenav-layout')
@section('content')
    @include('components.building-detail.building-details-list')
    @include('components.building-detail.building-detail-create')
    @include('components.building-detail.building-detail-update')
    @include('components.building-detail.building-detail-delete')
@endsection
