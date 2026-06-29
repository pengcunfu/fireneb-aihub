document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('compare-app');
    if (!root) return;

    const plans = JSON.parse(root.dataset.plans);
    const vendors = JSON.parse(root.dataset.vendors);
    const models = JSON.parse(root.dataset.models);
    const config = JSON.parse(root.dataset.config);

    const state = {
        selectedVendors: new Set(),
        selectedModels: new Set(),
        priceFilters: {
            firstMonth: { min: 0, max: 0, applied: false, rangeMax: 0 },
            monthly: { min: 0, max: 0, applied: false, rangeMax: 0 },
            quarterly: { min: 0, max: 0, applied: false, rangeMax: 0 },
            yearly: { min: 0, max: 0, applied: false, rangeMax: 0 },
        },
        sort: { column: null, direction: null },
    };

    const priceKeys = {
        firstMonth: 'firstMonthPrice',
        monthly: 'monthlyPrice',
        quarterly: 'quarterlyPrice',
        yearly: 'yearlyPrice',
    };

    function formatPrice(price) {
        return Number.isInteger(price) ? price.toString() : Number(price).toFixed(2);
    }

    function formatNumber(num) {
        return typeof num === 'number' ? num.toLocaleString() : num;
    }

    function initPriceRanges() {
        ['firstMonth', 'monthly', 'quarterly', 'yearly'].forEach((type) => {
            const key = priceKeys[type];
            const maxVal = Math.ceil(Math.max(...plans.map((p) => p[key])));
            state.priceFilters[type].max = maxVal;
            state.priceFilters[type].rangeMax = maxVal;

            const minInput = document.querySelector(`.price-min[data-type="${type}"]`);
            const maxInput = document.querySelector(`.price-max[data-type="${type}"]`);
            if (minInput && maxInput) {
                minInput.max = maxVal;
                maxInput.max = maxVal;
                maxInput.value = maxVal;
                document.querySelector(`.price-max-val[data-type="${type}"]`).textContent = maxVal;
            }
        });
    }

    function buildCheckboxes(containerId, items, type) {
        const container = document.getElementById(containerId);
        container.innerHTML = items.map((item) => `
            <div class="form-check">
                <input class="form-check-input filter-check" type="checkbox" value="${item}" id="${type}-${item}" data-filter="${type}">
                <label class="form-check-label" for="${type}-${item}">${item}</label>
            </div>
        `).join('');

        container.querySelectorAll('.filter-check').forEach((input) => {
            input.addEventListener('change', () => {
                const set = type === 'vendor' ? state.selectedVendors : state.selectedModels;
                if (input.checked) set.add(input.value);
                else set.delete(input.value);
                updateFilterBadges();
                render();
            });
        });
    }

    function getFilteredPlans() {
        let result = [...plans];

        if (state.selectedVendors.size > 0) {
            result = result.filter((p) => state.selectedVendors.has(p.vendor));
        }

        if (state.selectedModels.size > 0) {
            result = result.filter((p) =>
                [...state.selectedModels].some((m) => p.models.includes(m))
            );
        }

        ['firstMonth', 'monthly', 'quarterly', 'yearly'].forEach((type) => {
            const filter = state.priceFilters[type];
            if (filter.applied) {
                const key = priceKeys[type];
                if (filter.min > 0) {
                    result = result.filter((p) => p[key] >= filter.min);
                }
                if (filter.max < filter.rangeMax) {
                    result = result.filter((p) => p[key] <= filter.max);
                }
            }
        });

        if (state.sort.column) {
            result.sort((a, b) => {
                const aVal = a[state.sort.column];
                const bVal = b[state.sort.column];
                if (typeof aVal === 'number' && typeof bVal === 'number') {
                    return state.sort.direction === 'asc' ? aVal - bVal : bVal - aVal;
                }
                return state.sort.direction === 'asc'
                    ? String(aVal).localeCompare(String(bVal), 'zh-CN')
                    : String(bVal).localeCompare(String(aVal), 'zh-CN');
            });
        }

        return result;
    }

    function updateFilterBadges() {
        const vendorBadge = document.getElementById('vendor-count');
        const modelBadge = document.getElementById('model-count');
        vendorBadge.classList.toggle('d-none', state.selectedVendors.size === 0);
        vendorBadge.textContent = state.selectedVendors.size;
        modelBadge.classList.toggle('d-none', state.selectedModels.size === 0);
        modelBadge.textContent = state.selectedModels.size;

        ['firstMonth', 'monthly', 'quarterly', 'yearly'].forEach((type) => {
            const dot = document.getElementById(`${type}-filter-dot`);
            const filter = state.priceFilters[type];
            const active = filter.applied && (filter.min > 0 || filter.max < filter.rangeMax);
            dot.classList.toggle('d-none', !active);
        });
    }

    function updateStats(count) {
        const stats = config.filters.stats
            .replace('{showing}', `<strong>${count}</strong>`)
            .replace('{total}', `<strong>${plans.length}</strong>`);
        document.getElementById('stats-bar').innerHTML = stats;
    }

    function renderTable(filtered) {
        const tbody = document.getElementById('plans-table-body');
        tbody.innerHTML = filtered.map((plan) => `
            <tr>
                <td class="sticky-col sticky-col-1 fw-semibold">${plan.vendor}</td>
                <td class="sticky-col sticky-col-2 fw-semibold">${plan.plan}</td>
                <td><a href="${plan.action}" target="_blank" class="btn btn-sm action-btn text-white">跳转开通</a></td>
                <td><span class="price-green">¥${formatPrice(plan.firstMonthPrice)}</span><span class="unit">/ 首月</span></td>
                <td><span class="price-primary">¥${formatPrice(plan.monthlyPrice)}</span><span class="unit">/ 月</span></td>
                <td>
                    ¥${formatPrice(plan.quarterlyPrice)}
                    ${plan.monthlyPrice * 3 !== plan.quarterlyPrice ? `<span class="price-original">${formatPrice(plan.monthlyPrice * 3)}</span>` : ''}
                    <span class="unit">/ 季</span>
                </td>
                <td>
                    ¥${formatPrice(plan.yearlyPrice)}
                    ${plan.monthlyPrice * 12 !== plan.yearlyPrice ? `<span class="price-original">${formatPrice(plan.monthlyPrice * 12)}</span>` : ''}
                    <span class="unit">/ 年</span>
                </td>
                <td>${plan.models.map((m) => `<span class="model-tag">${m}</span>`).join('')}</td>
                <td>${formatNumber(plan.hourlyRequests)}<span class="unit">/ 5小时</span></td>
                <td>${formatNumber(plan.monthlyRequests)}<span class="unit">/ 月</span></td>
                <td>${plan.benefits.map((b) => `<span class="benefit-tag">${b}</span>`).join('')}</td>
                <td class="text-muted small">${plan.note || ''}</td>
            </tr>
        `).join('');
    }

    function renderCards(filtered) {
        const container = document.getElementById('plans-cards-body');
        container.innerHTML = filtered.map((plan) => `
            <div class="col-md-6 col-xl-4">
                <div class="card plan-card h-100 border">
                    <div class="card-body d-flex flex-column">
                        <span class="platform-badge badge text-white mb-2 align-self-start">${plan.vendor}</span>
                        <h3 class="h5 fw-bold">${plan.plan}</h3>
                        <div class="bg-light rounded p-3 mb-3">
                            ${plan.firstMonthPrice !== plan.monthlyPrice ? `
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span class="text-muted">首月</span>
                                <span class="price-green fw-semibold">¥${formatPrice(plan.firstMonthPrice)}</span>
                            </div>` : ''}
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span class="text-muted">包月</span>
                                <span class="price-primary fw-semibold">¥${formatPrice(plan.monthlyPrice)}</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span class="text-muted">包季</span>
                                <span>¥${formatPrice(plan.quarterlyPrice)}
                                    ${plan.monthlyPrice * 3 !== plan.quarterlyPrice ? `<span class="price-original">¥${formatPrice(plan.monthlyPrice * 3)}</span>` : ''}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between py-1">
                                <span class="text-muted">包年</span>
                                <span>¥${formatPrice(plan.yearlyPrice)}
                                    ${plan.monthlyPrice * 12 !== plan.yearlyPrice ? `<span class="price-original">¥${formatPrice(plan.monthlyPrice * 12)}</span>` : ''}
                                </span>
                            </div>
                        </div>
                        <div class="small text-muted mb-1">支持模型</div>
                        <div class="mb-3">${plan.models.map((m) => `<span class="model-tag">${m}</span>`).join('')}</div>
                        <div class="row g-2 mb-3">
                            <div class="col-6"><div class="bg-light rounded p-2 text-center"><div class="small text-muted">5小时</div><div class="fw-semibold">${formatNumber(plan.hourlyRequests)}</div></div></div>
                            <div class="col-6"><div class="bg-light rounded p-2 text-center"><div class="small text-muted">每月</div><div class="fw-semibold">${formatNumber(plan.monthlyRequests)}</div></div></div>
                        </div>
                        ${plan.benefits.length ? `<div class="mb-3">${plan.benefits.map((b) => `<span class="benefit-tag">${b}</span>`).join('')}</div>` : ''}
                        ${plan.note ? `<p class="small text-muted flex-grow-1">${plan.note}</p>` : '<div class="flex-grow-1"></div>'}
                        <a href="${plan.action}" target="_blank" class="btn action-btn text-white w-100 mt-2">查看详情</a>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function updateSortHeaders() {
        document.querySelectorAll('.compare-table th.sortable').forEach((th) => {
            th.classList.remove('sort-asc', 'sort-desc');
            if (th.dataset.sort === state.sort.column) {
                th.classList.add(state.sort.direction === 'asc' ? 'sort-asc' : 'sort-desc');
            }
        });
    }

    function render() {
        const filtered = getFilteredPlans();
        renderTable(filtered);
        renderCards(filtered);
        updateStats(filtered.length);
        updateSortHeaders();
    }

    function resetAllFilters() {
        state.selectedVendors.clear();
        state.selectedModels.clear();
        document.querySelectorAll('.filter-check').forEach((input) => { input.checked = false; });

        ['firstMonth', 'monthly', 'quarterly', 'yearly'].forEach((type) => {
            const filter = state.priceFilters[type];
            filter.min = 0;
            filter.max = filter.rangeMax;
            filter.applied = false;
            const minInput = document.querySelector(`.price-min[data-type="${type}"]`);
            const maxInput = document.querySelector(`.price-max[data-type="${type}"]`);
            if (minInput && maxInput) {
                minInput.value = 0;
                maxInput.value = filter.rangeMax;
                document.querySelector(`.price-min-val[data-type="${type}"]`).textContent = 0;
                document.querySelector(`.price-max-val[data-type="${type}"]`).textContent = filter.rangeMax;
            }
        });

        state.sort = { column: null, direction: null };
        updateFilterBadges();
        render();
    }

    buildCheckboxes('vendor-checkboxes', vendors, 'vendor');
    buildCheckboxes('model-checkboxes', models, 'model');
    initPriceRanges();
    render();

    document.querySelectorAll('.price-min').forEach((input) => {
        input.addEventListener('input', () => {
            const type = input.dataset.type;
            state.priceFilters[type].min = Number(input.value);
            document.querySelector(`.price-min-val[data-type="${type}"]`).textContent = input.value;
        });
    });

    document.querySelectorAll('.price-max').forEach((input) => {
        input.addEventListener('input', () => {
            const type = input.dataset.type;
            state.priceFilters[type].max = Number(input.value);
            document.querySelector(`.price-max-val[data-type="${type}"]`).textContent = input.value;
        });
    });

    document.querySelectorAll('[data-apply-price]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.applyPrice;
            state.priceFilters[type].applied = true;
            updateFilterBadges();
            render();
        });
    });

    document.querySelectorAll('[data-reset-price]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.resetPrice;
            const filter = state.priceFilters[type];
            filter.min = 0;
            filter.max = filter.rangeMax;
            filter.applied = false;
            document.querySelector(`.price-min[data-type="${type}"]`).value = 0;
            document.querySelector(`.price-max[data-type="${type}"]`).value = filter.rangeMax;
            document.querySelector(`.price-min-val[data-type="${type}"]`).textContent = 0;
            document.querySelector(`.price-max-val[data-type="${type}"]`).textContent = filter.rangeMax;
            updateFilterBadges();
            render();
        });
    });

    document.querySelectorAll('[data-reset]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.reset;
            const set = type === 'vendor' ? state.selectedVendors : state.selectedModels;
            set.clear();
            document.querySelectorAll(`.filter-check[data-filter="${type}"]`).forEach((input) => {
                input.checked = false;
            });
            updateFilterBadges();
            render();
        });
    });

    document.getElementById('reset-all-filters').addEventListener('click', resetAllFilters);

    document.querySelectorAll('.compare-table th.sortable').forEach((th) => {
        th.addEventListener('click', () => {
            const column = th.dataset.sort;
            if (state.sort.column === column) {
                if (state.sort.direction === 'asc') state.sort.direction = 'desc';
                else if (state.sort.direction === 'desc') state.sort = { column: null, direction: null };
            } else {
                state.sort = { column, direction: 'asc' };
            }
            render();
        });
    });

    document.getElementById('view-table').addEventListener('click', () => {
        document.getElementById('table-view').classList.remove('d-none');
        document.getElementById('cards-view').classList.add('d-none');
        document.getElementById('view-table').classList.replace('btn-outline-primary', 'btn-primary');
        document.getElementById('view-table').classList.add('active');
        document.getElementById('view-cards').classList.replace('btn-primary', 'btn-outline-primary');
        document.getElementById('view-cards').classList.remove('active');
    });

    document.getElementById('view-cards').addEventListener('click', () => {
        document.getElementById('cards-view').classList.remove('d-none');
        document.getElementById('table-view').classList.add('d-none');
        document.getElementById('view-cards').classList.replace('btn-outline-primary', 'btn-primary');
        document.getElementById('view-cards').classList.add('active');
        document.getElementById('view-table').classList.replace('btn-primary', 'btn-outline-primary');
        document.getElementById('view-table').classList.remove('active');
    });
});
