@php
    $content = $content ?? [];
    $references = $content['references'] ?? [];
    $categories = $content['categories'] ?? [];
@endphp

<style>
    /* Scoped Styles for References Section */
    #section-{{ $section->id }} {
        --primary-color: #3b82f6;
        --primary-dark: #0e1327;
        --primary-navy: #1a1f3f;
        --primary-blue: #1e40af;
        --primary-royal: #2563eb;
        --primary-sky: #3b82f6;
        
        /* Light theme additions */
        --bg-primary: #f8fafc;
        --bg-secondary: #ffffff;
        --bg-gradient-1: #eff6ff;
        --bg-gradient-2: #f0f9ff;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border-light: rgba(59, 130, 246, 0.1);
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.8);
        --shadow-soft: 0 4px 24px -4px rgba(59, 130, 246, 0.12);
        --shadow-medium: 0 8px 32px -8px rgba(59, 130, 246, 0.18);
        --shadow-large: 0 20px 60px -15px rgba(59, 130, 246, 0.25);
    }

    #section-{{ $section->id }} .container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
        z-index: 1;
    }

    /* Background Pattern - scoped to section */
    .references-section-wrapper {
        position: relative;
        padding: 80px 0;
        background: 
            radial-gradient(ellipse 80% 50% at 50% -20%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
            radial-gradient(ellipse 60% 40% at 100% 0%, rgba(30, 64, 175, 0.06) 0%, transparent 40%),
            radial-gradient(ellipse 50% 30% at 0% 100%, rgba(37, 99, 235, 0.05) 0%, transparent 40%),
            linear-gradient(180deg, var(--bg-gradient-1) 0%, var(--bg-primary) 30%, var(--bg-gradient-2) 70%, var(--bg-primary) 100%);
    }

    /* Floating Orbs */
    .floating-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.4;
        animation: float 20s ease-in-out infinite;
        pointer-events: none;
    }

    .orb-1 { width: 400px; height: 400px; background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(37, 99, 235, 0.1)); top: 10%; right: -10%; }
    .orb-2 { width: 300px; height: 300px; background: linear-gradient(135deg, rgba(30, 64, 175, 0.12), rgba(59, 130, 246, 0.08)); bottom: 20%; left: -5%; animation-delay: -7s; }
    .orb-3 { width: 200px; height: 200px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(59, 130, 246, 0.15)); top: 50%; right: 20%; animation-delay: -14s; }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -30px) scale(1.05); }
        50% { transform: translate(-10px, 20px) scale(0.95); }
        75% { transform: translate(30px, 10px) scale(1.02); }
    }

    /* Hero Section */
    .hero-section { text-align: center; margin-bottom: 80px; position: relative; }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 8px; padding: 10px 24px;
        background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border);
        border-radius: 100px; font-size: 14px; font-weight: 600; color: var(--primary-royal);
        margin-bottom: 32px; box-shadow: var(--shadow-soft);
    }
    .hero-badge::before { content: ''; width: 8px; height: 8px; background: var(--primary-sky); border-radius: 50%; animation: pulse 2s ease-in-out infinite; }
    
    .hero-title {
        font-family: 'Syne', sans-serif; font-size: clamp(48px, 8vw, 80px); font-weight: 800; line-height: 1.1; margin-bottom: 24px;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-blue) 50%, var(--primary-sky) 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .hero-subtitle { font-size: 18px; color: var(--text-secondary); max-width: 600px; margin: 0 auto 48px; }

    /* Stats Bar */
    .stats-bar { display: flex; justify-content: center; gap: 60px; margin-top: 48px; }
    .stat-item { text-align: center; }
    .stat-number { font-family: 'Syne', sans-serif; font-size: 36px; font-weight: 800; color: var(--primary-royal); line-height: 1; }
    .stat-label { font-size: 13px; color: var(--text-muted); margin-top: 8px; text-transform: uppercase; letter-spacing: 1px; }

    /* Main Content Layout */
    .main-content { display: grid; grid-template-columns: 280px 1fr; gap: 48px; align-items: start; }
    
    /* Sidebar */
    .sidebar { position: sticky; top: 40px; }
    .sidebar-card { background: var(--glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 24px; padding: 8px; box-shadow: var(--shadow-medium); }
    .sidebar-title { font-family: 'Syne', sans-serif; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--text-muted); padding: 20px 20px 16px; }
    .category-list { list-style: none; }
    .category-btn {
        width: 100%; display: flex; align-items: center; gap: 14px; padding: 16px 20px;
        background: transparent; border: none; border-radius: 16px;
        font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; font-weight: 500;
        color: var(--text-secondary); cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left;
    }
    .category-btn:hover { background: rgba(59, 130, 246, 0.06); color: var(--primary-royal); }
    .category-btn.active { background: linear-gradient(135deg, var(--primary-royal), var(--primary-sky)); color: white; box-shadow: 0 8px 24px -8px rgba(37, 99, 235, 0.4); }
    .category-btn.active .category-icon { background: rgba(255, 255, 255, 0.2); color: white; }
    .category-icon { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: rgba(59, 130, 246, 0.08); border-radius: 12px; color: var(--primary-sky); transition: all 0.3s ease; }
    .category-icon svg { width: 20px; height: 20px; }
    
    .category-count { margin-left: auto; font-size: 12px; font-weight: 600; padding: 4px 10px; background: rgba(59, 130, 246, 0.08); border-radius: 20px; color: var(--primary-royal); transition: all 0.3s ease; }
    .category-btn.active .category-count { background: rgba(255, 255, 255, 0.2); color: white; }

    /* References Grid */
    .references-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 32px; }

    /* Reference Card */
    .reference-card {
        background: var(--bg-secondary); border-radius: 28px; overflow: hidden;
        box-shadow: var(--shadow-soft); transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-light); position: relative;
    }
    .reference-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-large); }
    
    .card-image-wrapper { position: relative; padding: 24px 24px 0; }
    .card-image { position: relative; border-radius: 20px; overflow: hidden; background: linear-gradient(135deg, var(--bg-gradient-1), var(--bg-gradient-2)); aspect-ratio: 16/10; }
    .card-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
    .reference-card:hover .card-image img { transform: scale(1.05); }
    
    .card-overlay {
        position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(14, 19, 39, 0.9) 100%);
        opacity: 0; transition: opacity 0.4s ease; display: flex; align-items: flex-end; justify-content: center; padding: 24px;
    }
    .reference-card:hover .card-overlay { opacity: 1; }
    
    .overlay-buttons { display: flex; gap: 12px; transform: translateY(20px); transition: transform 0.4s ease; }
    .reference-card:hover .overlay-buttons { transform: translateY(0); }
    
    .overlay-btn {
        display: flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 12px;
        font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; cursor: pointer;
    }
    .btn-primary { background: white; color: var(--primary-dark); }
    .btn-primary:hover { background: var(--primary-sky); color: white; }
    .btn-secondary { background: rgba(255, 255, 255, 0.15); color: white; backdrop-filter: blur(10px); }
    .btn-secondary:hover { background: rgba(255, 255, 255, 0.25); }

    .card-content { padding: 28px; }
    .card-header { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 20px; }
    .company-logo {
        width: 56px; height: 56px; border-radius: 16px; background: var(--glass-bg);
        border: 1px solid var(--border-light); display: flex; align-items: center; justify-content: center;
        padding: 10px; flex-shrink: 0; box-shadow: var(--shadow-soft);
    }
    .company-logo img { width: 100%; height: 100%; object-fit: contain; }
    .company-logo svg { width: 28px; height: 28px; }
    
    .card-info { flex: 1; min-width: 0; }
    .company-name { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px; line-height: 1.3; }
    .card-category {
        display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(37, 99, 235, 0.12));
        border-radius: 100px; font-size: 12px; font-weight: 600; color: var(--primary-royal);
    }
    .card-description { font-size: 14px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 20px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

    .card-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 20px; border-top: 1px solid var(--border-light); }
    .card-tags { display: flex; gap: 8px; flex-wrap: wrap; }
    .tag { padding: 6px 12px; background: var(--bg-gradient-1); border-radius: 8px; font-size: 12px; color: var(--text-muted); font-weight: 500; }
    
    .card-rating { display: flex; align-items: center; gap: 8px; }
    .rating-btn {
        display: flex; align-items: center; gap: 4px; padding: 8px 12px;
        background: transparent; border: 1px solid var(--border-light); border-radius: 10px;
        font-size: 13px; font-weight: 600; color: var(--text-muted); cursor: pointer; transition: all 0.3s ease;
    }
    .rating-btn:hover, .rating-btn.liked { border-color: var(--primary-sky); background: rgba(59, 130, 246, 0.1); color: var(--primary-royal); }

    /* Featured Card Styling */
    .reference-card.featured { grid-column: span 2; display: grid; grid-template-columns: 1.2fr 1fr; }
    .reference-card.featured .card-image-wrapper { padding: 24px; height: 100%; }
    .reference-card.featured .card-image { height: 100%; aspect-ratio: unset; }
    .reference-card.featured .card-content { display: flex; flex-direction: column; justify-content: center; padding: 40px; }
    .featured-badge {
        display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px;
        background: linear-gradient(135deg, var(--primary-royal), var(--primary-sky));
        border-radius: 100px; font-size: 11px; font-weight: 700; color: white;
        text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; width: fit-content;
    }

    /* Load More */
    .load-more-wrapper { display: flex; justify-content: center; margin-top: 60px; width: 100%; grid-column: 1 / -1; }
    .load-more-btn {
        display: inline-flex; align-items: center; gap: 12px; padding: 18px 40px;
        background: var(--bg-secondary); border: 2px solid var(--border-light); border-radius: 16px;
        font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; font-weight: 600;
        color: var(--text-primary); cursor: pointer; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--shadow-soft);
    }
    .load-more-btn:hover {
        background: linear-gradient(135deg, var(--primary-royal), var(--primary-sky)); border-color: transparent;
        color: white; box-shadow: 0 12px 32px -8px rgba(37, 99, 235, 0.4); transform: translateY(-2px);
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .reference-card.featured { grid-column: span 1; display: block; }
        .reference-card.featured .card-image-wrapper { padding: 24px 24px 0; }
        .reference-card.featured .card-content { padding: 28px; }
    }
    @media (max-width: 1024px) {
        .main-content { grid-template-columns: 1fr; }
        .sidebar { position: static; margin-bottom: 30px; }
        .sidebar-card { display: flex; flex-wrap: wrap; gap: 8px; padding: 16px; }
        .sidebar-title { width: 100%; padding: 0 0 12px; }
        .category-list { display: flex; flex-wrap: wrap; gap: 8px; width: 100%; }
        .category-btn { padding: 12px 16px; width: auto; }
        .category-count { margin-left: 8px; }
    }
    @media (max-width: 768px) {
        #section-{{ $section->id }} .container { padding: 0 20px; }
        .stats-bar { gap: 32px; flex-wrap: wrap; }
        .references-grid { grid-template-columns: 1fr; gap: 24px; }
        .card-footer { flex-direction: column; gap: 16px; align-items: flex-start; }
    }
</style>

<div id="section-{{ $section->id }}" class="references-section-wrapper">
    <!-- Floating Orbs -->
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>

    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            @if(!empty($content['hero_badge']))
                <div class="hero-badge">
                   {{ $content['hero_badge'] }}
                </div>
            @endif
            
            <h1 class="hero-title">{{ $content['main_title'] ?? 'Referanslarımız' }}</h1>
            
            @if(!empty($content['description']))
                <p class="hero-subtitle">
                    {{ $content['description'] }}
                </p>
            @endif
            
            @if(!empty($content['stats']))
                <div class="stats-bar">
                    @foreach($content['stats'] as $stat)
                        <div class="stat-item">
                            <div class="stat-number">{{ $stat['stat_number'] }}</div>
                            <div class="stat-label">{{ $stat['stat_label'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Sidebar / Categories -->
            <aside class="sidebar">
                <div class="sidebar-card">
                    <div class="sidebar-title">Kategoriler</div>
                    <ul class="category-list">
                        <!-- 'All' button defaults -->
                        <li class="category-item">
                            <button class="category-btn active" data-category="all">
                                <span class="category-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                Tüm Projeler
                                <span class="category-count">{{ count($references) }}</span>
                            </button>
                        </li>
                        
                        <!-- Dynamic Categories -->
                        @foreach($categories as $cat)
                            <li class="category-item">
                                <button class="category-btn" data-category="{{ $cat['key'] }}">
                                    @if(!empty($cat['icon']))
                                        <span class="category-icon">
                                            {!! $cat['icon'] !!}
                                        </span>
                                    @endif
                                    {{ $cat['label'] }}
                                    <span class="category-count">{{ $cat['count'] ?? 0 }}</span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- References Grid -->
            <div class="references-grid" id="referencesGrid">
                @foreach($references as $ref)
                    @php
                       $isFeatured = !empty($ref['is_featured']);
                       $cardClass = $isFeatured ? 'reference-card featured' : 'reference-card';
                    @endphp
                    
                    <article class="{{ $cardClass }} fade-in" data-category="{{ $ref['category_key'] ?? 'all' }}">
                        <div class="card-image-wrapper">
                            <div class="card-image">
                                <img src="{{ !empty($ref['main_image']) ? asset($ref['main_image']) : 'https://via.placeholder.com/800x500?text=No+Image' }}" alt="{{ $ref['company_name'] ?? 'Project' }}">
                                <div class="card-overlay">
                                    <div class="overlay-buttons">
                                        <a href="{{ $ref['link_review'] ?? '#' }}" class="overlay-btn btn-primary">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            İncele
                                        </a>
                                        <a href="{{ $ref['link_visit'] ?? '#' }}" class="overlay-btn btn-secondary">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                                <polyline points="15 3 21 3 21 9"></polyline>
                                                <line x1="10" y1="14" x2="21" y2="3"></line>
                                            </svg>
                                            Ziyaret Et
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            @if($isFeatured)
                                <div class="featured-badge">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                    Öne Çıkan Proje
                                </div>
                            @endif
                            
                            <div class="card-header">
                                <div class="company-logo">
                                    @if(!empty($ref['logo']))
                                        <img src="{{ asset($ref['logo']) }}" alt="Logo">
                                    @elseif(!empty($ref['logo_svg']))
                                         {!! $ref['logo_svg'] !!}
                                    @else
                                        <!-- Fallback Logo Icon -->
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="#3b82f6"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                                    @endif
                                </div>
                                <div class="card-info">
                                    <h3 class="company-name">{{ $ref['company_name'] ?? 'Proje İsmi' }}</h3>
                                    <span class="card-category">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg>
                                        {{ $ref['category_label'] ?? 'Kategori' }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="card-description">
                                {{ $ref['description'] ?? '' }}
                            </p>
                            
                            <div class="card-footer">
                                <div class="card-tags">
                                    @if(!empty($ref['tags']))
                                        @foreach(explode(',', $ref['tags']) as $tag)
                                            <span class="tag">{{ trim($tag) }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="card-rating">
                                    <button class="rating-btn {{ !empty($ref['likes']) ? 'liked' : '' }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                                        </svg>
                                        {{ $ref['likes'] ?? 0 }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Load More -->
            @if(!empty($content['load_more_text']))
                <div class="load-more-wrapper">
                    <button class="load-more-btn">
                        {{ $content['load_more_text'] }}
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <polyline points="19 12 12 19 5 12"></polyline>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sectionId = "section-{{ $section->id }}";
        const container = document.getElementById(sectionId);
        if(!container) return;

        const filterBtns = container.querySelectorAll('.category-btn');
        const cards = container.querySelectorAll('.reference-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Active class toggle
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-category');

                cards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (filterValue === 'all' || cardCategory === filterValue) {
                        card.style.display = 'grid'; // Grid item as default
                        // Re-apply style for featured if needed via CSS, here just show
                        if(card.classList.contains('featured') && window.innerWidth > 1200) {
                             // CSS handles grid-column span by class
                        }
                        
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        card.style.display = 'none';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                    }
                });
            });
        });
    });
</script>
