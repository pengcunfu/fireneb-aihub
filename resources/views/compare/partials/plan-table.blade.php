<div id="table-view" class="table-wrapper card shadow-sm border-0 mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 compare-table">
            <thead class="table-light">
                <tr>
                    @php $cols = $config['table']['columns']; @endphp
                    <th class="sortable sticky-col sticky-col-1" data-sort="vendor">{{ $cols['vendor'] }}</th>
                    <th class="sticky-col sticky-col-2">{{ $cols['plan'] }}</th>
                    <th>{{ $cols['action'] }}</th>
                    <th class="sortable" data-sort="firstMonthPrice">{{ $cols['firstMonthPrice'] }}</th>
                    <th class="sortable" data-sort="monthlyPrice">{{ $cols['monthlyPrice'] }}</th>
                    <th class="sortable" data-sort="quarterlyPrice">{{ $cols['quarterlyPrice'] }}</th>
                    <th class="sortable" data-sort="yearlyPrice">{{ $cols['yearlyPrice'] }}</th>
                    <th>{{ $cols['models'] }}</th>
                    <th class="sortable" data-sort="hourlyRequests">{{ $cols['hourlyRequests'] }}</th>
                    <th class="sortable" data-sort="monthlyRequests">{{ $cols['monthlyRequests'] }}</th>
                    <th>{{ $cols['benefits'] }}</th>
                    <th>{{ $cols['note'] }}</th>
                </tr>
            </thead>
            <tbody id="plans-table-body"></tbody>
        </table>
    </div>
</div>

<div id="cards-view" class="d-none">
    <div class="row g-3" id="plans-cards-body"></div>
</div>
