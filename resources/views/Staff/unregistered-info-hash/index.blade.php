@extends('layout.default')

@section('title')
    <title>
        {{ __('common.user') }} Unregistered Info Hashes - {{ __('staff.staff-dashboard') }} -
        {{ config('other.title') }}
    </title>
@endsection

@section('meta')
    <meta
        name="description"
        content="Unregistered Info Hashes - {{ __('staff.staff-dashboard') }}"
    />
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('staff.dashboard.index') }}" class="breadcrumb__link">
            {{ __('staff.staff-dashboard') }}
        </a>
    </li>
    <li class="breadcrumb--active">Unregistered Info Hashes</li>
@endsection

@section('page', 'page__unregistered-info-hash--index')

@section('main')
    @livewire('unregistered-info-hash-search')
@endsection
