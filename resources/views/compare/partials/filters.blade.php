<div class="filter-bar d-flex flex-wrap align-items-center gap-2 mb-4">
    <div class="dropdown filter-dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            {{ $config['filters']['vendor'] }}
            <span class="badge bg-primary ms-1 d-none" id="vendor-count"></span>
        </button>
        <div class="dropdown-menu p-3 shadow" style="min-width: 220px;">
            <div id="vendor-checkboxes" class="d-flex flex-column gap-2 mb-3"></div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary flex-fill" data-reset="vendor">{{ $config['filters']['reset'] }}</button>
                <button type="button" class="btn btn-sm btn-primary flex-fill" data-bs-toggle="dropdown">{{ $config['priceFilter']['apply'] }}</button>
            </div>
        </div>
    </div>

    @foreach(['firstMonth' => 'firstMonthPrice', 'monthly' => 'monthlyPrice', 'quarterly' => 'quarterlyPrice', 'yearly' => 'yearlyPrice'] as $type => $labelKey)
    <div class="dropdown filter-dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            {{ $config['filters'][$labelKey] }}
            <span class="badge bg-primary ms-1 d-none" id="{{ $type }}-filter-dot">●</span>
        </button>
        <div class="dropdown-menu p-3 shadow" style="min-width: 260px;">
            <div class="small text-muted mb-2">{{ $config['priceFilter']['title'] }}</div>
            <div class="mb-2">
                <label class="form-label small mb-1">最低</label>
                <input type="range" class="form-range price-min" data-type="{{ $type }}" min="0" max="1000" value="0">
                <div class="text-center small"><span class="price-min-val" data-type="{{ $type }}">0</span> 元</div>
            </div>
            <div class="mb-3">
                <label class="form-label small mb-1">最高</label>
                <input type="range" class="form-range price-max" data-type="{{ $type }}" min="0" max="1000" value="1000">
                <div class="text-center small"><span class="price-max-val" data-type="{{ $type }}">1000</span> 元</div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary flex-fill" data-reset-price="{{ $type }}">{{ $config['priceFilter']['reset'] }}</button>
                <button type="button" class="btn btn-sm btn-primary flex-fill" data-apply-price="{{ $type }}">{{ $config['priceFilter']['apply'] }}</button>
            </div>
        </div>
    </div>
    @endforeach

    <div class="dropdown filter-dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            {{ $config['filters']['model'] }}
            <span class="badge bg-primary ms-1 d-none" id="model-count"></span>
        </button>
        <div class="dropdown-menu p-3 shadow" style="min-width: 260px; max-height: 320px; overflow-y: auto;">
            <div id="model-checkboxes" class="d-flex flex-column gap-2 mb-3"></div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary flex-fill" data-reset="model">{{ $config['filters']['reset'] }}</button>
                <button type="button" class="btn btn-sm btn-primary flex-fill" data-bs-toggle="dropdown">{{ $config['priceFilter']['apply'] }}</button>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-outline-secondary" id="reset-all-filters">{{ $config['filters']['reset'] }}</button>

    <div class="ms-md-auto text-muted small" id="stats-bar"></div>
</div>

<div class="d-flex justify-content-end mb-3">
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-primary active" id="view-table" data-view="table">表格视图</button>
        <button type="button" class="btn btn-outline-primary" id="view-cards" data-view="cards">卡片视图</button>
    </div>
</div>
