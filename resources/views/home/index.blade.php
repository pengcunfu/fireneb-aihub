@extends('layouts.app')

@section('title', 'AI 导航')
@section('meta_description', $site['description'])

@section('content')
<section class="hero-section text-white py-5">
    <div class="container-xl">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7">
                <span class="badge hero-badge mb-3">AI 工具导航</span>
                <h1 class="display-6 fw-bold mb-3">{{ $site['name'] }} · 发现优质 AI</h1>
                <p class="lead opacity-90 mb-4">{{ $site['tagline'] }}</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#nav-tools" class="btn btn-light btn-sm px-3">浏览工具</a>
                    <a href="{{ route('compare.index') }}" class="btn btn-outline-light btn-sm px-3">Coding Plan 对比 →</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-stats card border-0 shadow">
                    <div class="card-body p-4">
                        <div class="row text-center g-3">
                            <div class="col-4">
                                <div class="hero-stat-value">{{ $links->count() }}</div>
                                <div class="hero-stat-label">收录工具</div>
                            </div>
                            <div class="col-4">
                                <div class="hero-stat-value">{{ $categories->count() }}</div>
                                <div class="hero-stat-label">分类</div>
                            </div>
                            <div class="col-4">
                                <div class="hero-stat-value">{{ $featured->count() }}</div>
                                <div class="hero-stat-label">精选推荐</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-xl py-4" id="nav-tools">
    @if ($featured->isNotEmpty())
    <section class="mb-5">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="h5 fw-bold mb-0">⭐ 精选推荐</h2>
        </div>
        <div class="row g-3">
            @foreach ($featured as $link)
            <div class="col-md-6 col-lg-3">
                <a href="{{ $link->url }}" target="_blank" rel="noopener" class="text-decoration-none">
                    <div class="card nav-card featured-card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-2">
                                <span class="nav-card-icon">{{ $link->category->icon }}</span>
                                @if ($link->is_domestic)
                                    <span class="badge text-bg-success-subtle text-success-emphasis border">国内</span>
                                @endif
                            </div>
                            <h3 class="h6 fw-bold text-dark mb-1">{{ $link->name }}</h3>
                            <p class="small text-muted mb-2 line-clamp-2">{{ $link->description }}</p>
                            <span class="small text-primary">{{ $link->category->name }} →</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <section>
        <div class="nav-toolbar card border-0 shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">🔍</span>
                            <input type="search" id="nav-search" class="form-control border-start-0"
                                   placeholder="搜索工具名称、描述或标签...">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="d-flex flex-wrap gap-2" id="category-filters">
                            <button type="button" class="btn btn-sm btn-primary category-pill active" data-category="all">全部</button>
                            @foreach ($categories as $category)
                            <button type="button" class="btn btn-sm btn-outline-secondary category-pill"
                                    data-category="{{ $category->id }}">
                                {{ $category->icon }} {{ $category->name }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">
                    <button type="button" class="btn btn-sm btn-outline-secondary region-pill active" data-region="all">全部地区</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary region-pill" data-region="domestic">国内</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary region-pill" data-region="overseas">海外</button>
                    <span class="ms-auto small text-muted align-self-center" id="nav-stats"></span>
                </div>
            </div>
        </div>

        <div id="nav-links-grid" class="row g-3"
             data-links='@json($links)'></div>

        <div id="nav-empty" class="text-center py-5 d-none">
            <div class="display-6 mb-2">🔍</div>
            <p class="text-muted mb-0">没有找到匹配的工具，试试其他关键词或分类</p>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/nav.js') }}"></script>
@endpush
