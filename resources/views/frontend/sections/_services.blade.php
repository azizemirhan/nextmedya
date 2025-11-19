@php
    // Admin panelinden girilen çok dilli ana başlığı alıyoruz.
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Neler Yapıyoruz?');

    // Repeater alanından hizmet kartlarını alıyoruz.
    $services = $content['services'] ?? [];
@endphp

<section id="nx-services-section" class="nx-services-wrapper">
    <div class="container"> {{-- Kapsayıcı div'in stil sınıfını düzenlemedim, ancak 'container' ekledim --}}
        <div class="nx-services-header">
            <h2 class="nx-services-title">{{ $mainTitle }}</h2>
        </div>

        @if (!empty($services))
            <div class="nx-services-grid">
                @foreach($services as $service)
                    @php
                        // Repeater içindeki alanları alıyoruz.
                        $iconClass = $service['icon_class'] ?? 'fas fa-cogs'; // İkon sınıfı (opsiyonel)
                        $imageUrl = isset($service['image']) ? asset($service['image']) : 'https://via.placeholder.com/200x200/cccccc/333333?text=Hizmet';
                        
                        // Translatable alanlar için data_get() kullanıyoruz.
                        $cardTitle = data_get($service, 'card_title.' . app()->getLocale(), 'Hizmet Başlığı');
                        $description = data_get($service, 'description.' . app()->getLocale(), 'Hizmet açıklaması...');
                        $detailLink = $service['detail_link'] ?? '#'; // Link alanı
                    @endphp

                    <div class="nx-service-card">
                        <div class="nx-service-image-wrapper">
                            @if(isset($service['image']))
                                <img src="{{ $imageUrl }}" alt="{{ $cardTitle }}" class="nx-service-image" width="600px" height="300px">
                            @else
                                <div class="nx-service-image-placeholder">
                                    <i class="{{ $iconClass }}" style="font-size: 40px; color: #333;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="nx-service-content">
                            <h3 class="nx-service-card-title">{{ $cardTitle }}</h3>
                            <p class="nx-service-card-description">
                                {{ $description }}
                            </p>
                            <a href="{{ $detailLink }}" class="nx-service-link">
                                Detaylar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align: center; margin-top: 20px;">Henüz bir hizmet kartı eklenmemiş.</p>
        @endif
    </div>
</section>