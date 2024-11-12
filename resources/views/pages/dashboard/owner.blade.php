@extends('layout.sidenav-layout')
@section('content')
    @include('components.owner.owners-list')
    @include('components.owner.owner-create')
    @include('components.owner.owner-update')
    @include('components.owner.owner-delete')
@endsection
