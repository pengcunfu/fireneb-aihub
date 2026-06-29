@php
    $site = config('aihub.site');
    $navItems = config('aihub.nav');
@endphp
<nav class="navbar navbar-expand-lg navbar-dark site-navbar sticky-top shadow-sm">
    <div class="container-xl">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="brand-icon">✦</span>
            {{ $site['name'] }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                @foreach ($navItems as $item)
                    <li class="nav-item">
                        @if ($item['active'] && $item['route'])
                            <a class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}"
                               href="{{ route($item['route']) }}">
                                {{ $item['label'] }}
                            </a>
                        @else
                            <span class="nav-link disabled d-flex align-items-center gap-2">
                                {{ $item['label'] }}
                                @if (!empty($item['badge']))
                                    <span class="badge coming-soon-badge">{{ $item['badge'] }}</span>
                                @endif
                            </span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
