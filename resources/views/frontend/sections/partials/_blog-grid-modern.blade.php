<div class="row nextmedya-blog-grid-modern">
    @foreach($blogPosts as $index => $post)
        @php
            $categoryColor = $post->category->color ?? '#667eea';
            $excerpt = $showExcerpt ? Str::limit(strip_tags($post->excerpt ?? $post->content), $excerptLength) : '';
            $featuredImage = $post->featured_image ?? 'https://via.placeholder.com/800x500';
            $postUrl = route('blog.show', $post->slug);
            $isFeatured = $index === 0; // First post is featured
        @endphp

        <div class="col-lg-{{ $isFeatured ? '12' : '4' }} col-md-{{ $isFeatured ? '12' : '6' }}"
             data-aos="fade-up"
             data-aos-delay="{{ ($index + 1) * 100 }}">

            <article class="nextmedya-blog-card {{ $isFeatured ? 'featured' : '' }} {{ $enableHoverEffects ? 'hover-effect' : '' }}"
                     style="--category-color: {{ $categoryColor }};">

                <!-- Card Image -->
                <div class="nextmedya-card-image">
                    <a href="{{ $postUrl }}">
                        <img src="{{ $featuredImage }}" alt="{{ $post->title }}">
                        <div class="nextmedya-image-overlay"></div>
                    </a>

                    @if($showCategories && $post->category)
                        <div class="nextmedya-card-category">
                            <a href="{{ route('blog.category', $post->category->slug) }}">
                                <i class="{{ $post->category->icon ?? 'fas fa-folder' }}"></i>
                                {{ $post->category->name }}
                            </a>
                        </div>
                    @endif

                    @if($post->is_featured)
                        <div class="nextmedya-featured-badge">
                            <i class="fas fa-star"></i>
                            Öne Çıkan
                        </div>
                    @endif
                </div>

                <!-- Card Content -->
                <div class="nextmedya-card-content">
                    <!-- Meta Info -->
                    <div class="nextmedya-card-meta">
                        @if($showAuthor && $post->author)
                            <div class="nextmedya-meta-author">
                                @if($post->author->avatar)
                                    <img src="{{ $post->author->avatar }}" alt="{{ $post->author->name }}">
                                @else
                                    <div class="nextmedya-author-avatar">
                                        {{ substr($post->author->name, 0, 1) }}
                                    </div>
                                @endif
                                <span>{{ $post->author->name }}</span>
                            </div>
                        @endif

                        <div class="nextmedya-meta-info">
                            <span class="nextmedya-meta-date">
                                <i class="far fa-calendar"></i>
                                {{ $post->published_at->format('d M Y') }}
                            </span>

                            @if($showReadingTime)
                                <span class="nextmedya-meta-reading">
                                    <i class="far fa-clock"></i>
                                    {{ $post->reading_time }} dk
                                </span>
                            @endif

                            @if($post->views_count)
                                <span class="nextmedya-meta-views">
                                    <i class="far fa-eye"></i>
                                    {{ $post->views_count }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Title -->
                    <h3 class="nextmedya-card-title">
                        <a href="{{ $postUrl }}">{{ $post->title }}</a>
                    </h3>

                    <!-- Excerpt -->
                    @if($showExcerpt && $excerpt)
                        <p class="nextmedya-card-excerpt">{{ $excerpt }}</p>
                    @endif

                    <!-- Tags -->
                    @if($post->tags->isNotEmpty())
                        <div class="nextmedya-card-tags">
                            @foreach($post->tags->take(3) as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}" class="nextmedya-tag">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <!-- Footer -->
                    <div class="nextmedya-card-footer">
                        <a href="{{ $postUrl }}" class="nextmedya-read-more">
                            <span>Devamını Oku</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>

                        <div class="nextmedya-card-actions">
                            <button class="nextmedya-action-btn nextmedya-like-btn" data-post-id="{{ $post->id }}">
                                <i class="far fa-heart"></i>
                                <span>{{ $post->likes_count ?? 0 }}</span>
                            </button>
                            <button class="nextmedya-action-btn nextmedya-share-btn" data-post-id="{{ $post->id }}">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hover Effects -->
                @if($enableHoverEffects)
                    <div class="nextmedya-card-shine"></div>
                @endif
            </article>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        /* Modern Grid Layout */
        .nextmedya-blog-grid-modern {
            position: relative;
            z-index: 1;
        }

        .nextmedya-blog-card {
            position: relative;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            margin-bottom: 30px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-blog-card.hover-effect:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-blog-card.featured {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.03), rgba(118, 75, 162, 0.03));
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        /* Card Image */
        .nextmedya-card-image {
            position: relative;
            width: 100%;
            padding-top: 60%; /* 5:3 Aspect Ratio */
            overflow: hidden;
            background: #f1f5f9;
        }

        .nextmedya-blog-card.featured .nextmedya-card-image {
            padding-top: 50%; /* Wider aspect ratio for featured */
        }

        .nextmedya-card-image a {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .nextmedya-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nextmedya-blog-card:hover .nextmedya-card-image img {
            transform: scale(1.1);
        }

        .nextmedya-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .nextmedya-blog-card:hover .nextmedya-image-overlay {
            opacity: 1;
        }

        /* Category Badge */
        .nextmedya-card-category {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 2;
        }

        .nextmedya-card-category a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: var(--category-color);
            color: #ffffff;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .nextmedya-card-category a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            color: #ffffff;
        }

        /* Featured Badge */
        .nextmedya-featured-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #ffffff;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(251, 191, 36, 0.4);
            animation: badgePulse 2s ease-in-out infinite;
            z-index: 2;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Card Content */
        .nextmedya-card-content {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .nextmedya-blog-card.featured .nextmedya-card-content {
            padding: 40px;
        }

        /* Meta Info */
        .nextmedya-card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }

        .nextmedya-meta-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nextmedya-meta-author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .nextmedya-author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.125rem;
        }

        .nextmedya-meta-author span {
            font-size: 0.9rem;
            font-weight: 600;
            color: #475569;
        }

        .nextmedya-meta-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .nextmedya-meta-info > span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .nextmedya-meta-info i {
            font-size: 0.9rem;
            color: #cbd5e1;
        }

        /* Title */
        .nextmedya-card-title {
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 16px;
        }

        .nextmedya-blog-card.featured .nextmedya-card-title {
            font-size: 2rem;
        }

        .nextmedya-card-title a {
            color: #1e293b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nextmedya-card-title a:hover {
            color: var(--category-color);
        }

        /* Excerpt */
        .nextmedya-card-excerpt {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .nextmedya-blog-card.featured .nextmedya-card-excerpt {
            font-size: 1.125rem;
        }

        /* Tags */
        .nextmedya-card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .nextmedya-tag {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nextmedya-tag:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* Footer */
        .nextmedya-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 20px;
            border-top: 2px solid #f1f5f9;
        }

        .nextmedya-read-more {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--category-color), rgba(118, 75, 162, 0.9));
            color: #ffffff;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .nextmedya-read-more:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            color: #ffffff;
        }

        .nextmedya-read-more i {
            transition: transform 0.3s ease;
        }

        .nextmedya-read-more:hover i {
            transform: translateX(5px);
        }

        .nextmedya-card-actions {
            display: flex;
            gap: 10px;
        }

        .nextmedya-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nextmedya-action-btn:hover {
            background: #ffffff;
            border-color: var(--category-color);
            color: var(--category-color);
            transform: translateY(-2px);
        }

        .nextmedya-like-btn.liked {
            background: #fef2f2;
            border-color: #ef4444;
            color: #ef4444;
        }

        .nextmedya-like-btn.liked i {
            animation: heartBeat 0.5s ease;
        }

        @keyframes heartBeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.3); }
            50% { transform: scale(1); }
            75% { transform: scale(1.2); }
        }

        /* Hover Effects */
        .nextmedya-card-shine {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                    45deg,
                    transparent 30%,
                    rgba(255, 255, 255, 0.5) 50%,
                    transparent 70%
            );
            transform: rotate(45deg) translate(-100%, -100%);
            transition: transform 0.6s;
            pointer-events: none;
        }

        .nextmedya-blog-card:hover .nextmedya-card-shine {
            transform: rotate(45deg) translate(100%, 100%);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .nextmedya-card-content {
                padding: 25px;
            }

            .nextmedya-card-title {
                font-size: 1.25rem;
            }

            .nextmedya-blog-card.featured .nextmedya-card-title {
                font-size: 1.75rem;
            }

            .nextmedya-card-footer {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .nextmedya-card-actions {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 576px) {
            .nextmedya-meta-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Like button functionality
            const likeBtns = document.querySelectorAll('.nextmedya-like-btn');

            likeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const postId = this.dataset.postId;
                    const icon = this.querySelector('i');
                    const count = this.querySelector('span');

                    this.classList.toggle('liked');

                    if (this.classList.contains('liked')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        count.textContent = parseInt(count.textContent) + 1;
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        count.textContent = parseInt(count.textContent) - 1;
                    }

                    // Send AJAX request to server
                    // fetch('/api/blog/like/' + postId, { method: 'POST' })
                });
            });

            // Share button functionality
            const shareBtns = document.querySelectorAll('.nextmedya-share-btn');

            shareBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const postId = this.dataset.postId;
                    const postUrl = window.location.origin + '/blog/' + postId;

                    if (navigator.share) {
                        navigator.share({
                            title: 'Blog Post',
                            url: postUrl
                        });
                    } else {
                        // Fallback: Copy to clipboard
                        navigator.clipboard.writeText(postUrl);
                        alert('Link kopyalandı!');
                    }
                });
            });
        });
    </script>
@endpush