@extends('layout.sidenav-layout')
@section('content')
    @include('components.agent.agents-list')
    @include('components.agent.agent-create')
    @include('components.agent.agent-update')
    @include('components.agent.agent-delete')
@endsection
