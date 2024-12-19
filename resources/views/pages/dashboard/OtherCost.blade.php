@extends('layout.sidenav-layout')
@section('content')
    @include('components.other-cost.other-costs-list')
    @include('components.other-cost.other-cost-create')
    @include('components.other-cost.other-cost-update')
    @include('components.other-cost.other-cost-delete')
@endsection
