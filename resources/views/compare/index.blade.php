@extends('layouts.app')

@section('title', $config['header']['title'])

@section('content')
<section class="page-header text-white py-4">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">AI 导航</a></li>
                        <li class="breadcrumb-item active text-white">Coding Plan</li>
                    </ol>
                </nav>
                <h1 class="h3 mb-1 fw-bold">{{ $config['header']['title'] }}</h1>
                <p class="mb-0 opacity-75 small">{{ $config['header']['subtitle'] }}</p>
            </div>
            <div class="text-md-end">
                <span class="badge bg-white text-primary">{{ $config['header']['updateDate'] }}</span>
                <p class="mb-0 mt-2 small opacity-75">{{ $config['header']['models'] }}</p>
            </div>
        </div>
    </div>
</section>

<div class="container-xl pb-5 pt-4">
    <div class="alert alert-warning border-0 shadow-sm mb-4" role="alert">
        {{ $config['notice']['text'] }}
    </div>

    <div id="compare-app"
         data-plans='@json($plans)'
         data-vendors='@json($vendors)'
         data-models='@json($models)'
         data-config='@json($config)'>

        @include('compare.partials.filters')
        @include('compare.partials.plan-table')
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/compare.js') }}"></script>
@endpush
