document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('nav-links-grid');
    const empty = document.getElementById('nav-empty');
    const stats = document.getElementById('nav-stats');
    const searchInput = document.getElementById('nav-search');

    if (!grid) return;

    const links = JSON.parse(grid.dataset.links || '[]');
    let activeCategory = 'all';
    let activeRegion = 'all';
    let searchQuery = '';

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function filterLinks() {
        return links.filter((link) => {
            if (activeCategory !== 'all' && link.categoryId !== Number(activeCategory)) {
                return false;
            }
            if (activeRegion === 'domestic' && !link.isDomestic) return false;
            if (activeRegion === 'overseas' && link.isDomestic) return false;
            if (searchQuery) {
                const haystack = [
                    link.name,
                    link.description,
                    link.categoryName,
                    ...(link.tags || []),
                ].join(' ').toLowerCase();
                if (!haystack.includes(searchQuery)) return false;
            }
            return true;
        });
    }

    function renderCard(link) {
        const tags = (link.tags || [])
            .map((tag) => `<span class="badge nav-tag">${escapeHtml(tag)}</span>`)
            .join('');

        return `
            <div class="col-md-6 col-xl-4 nav-link-item" data-category="${link.categoryId}">
                <a href="${escapeHtml(link.url)}" target="_blank" rel="noopener" class="text-decoration-none">
                    <div class="card nav-card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-start justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="nav-card-icon">${escapeHtml(link.categoryIcon)}</span>
                                    <span class="small text-muted">${escapeHtml(link.categoryName)}</span>
                                </div>
                                ${link.isDomestic ? '<span class="badge text-bg-success-subtle text-success-emphasis border">国内</span>' : ''}
                            </div>
                            <h3 class="h6 fw-bold text-dark mb-2">${escapeHtml(link.name)}</h3>
                            <p class="small text-muted flex-grow-1 line-clamp-2 mb-3">${escapeHtml(link.description || '')}</p>
                            <div class="d-flex flex-wrap gap-1 mb-2">${tags}</div>
                            <span class="small text-primary mt-auto">访问官网 →</span>
                        </div>
                    </div>
                </a>
            </div>
        `;
    }

    function render() {
        const filtered = filterLinks();
        grid.innerHTML = filtered.map(renderCard).join('');
        empty.classList.toggle('d-none', filtered.length > 0);
        stats.textContent = `显示 ${filtered.length} / ${links.length} 个工具`;
    }

    document.querySelectorAll('.category-pill').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.category-pill').forEach((b) => {
                b.classList.remove('active', 'btn-primary');
                b.classList.add('btn-outline-secondary');
            });
            btn.classList.add('active', 'btn-primary');
            btn.classList.remove('btn-outline-secondary');
            activeCategory = btn.dataset.category;
            render();
        });
    });

    document.querySelectorAll('.region-pill').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.region-pill').forEach((b) => b.classList.remove('active'));
            btn.classList.add('active');
            activeRegion = btn.dataset.region;
            render();
        });
    });

    searchInput?.addEventListener('input', (e) => {
        searchQuery = e.target.value.trim().toLowerCase();
        render();
    });

    render();
});
