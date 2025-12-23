<?php

return [

    'hero-banner-digital' => [
        'name' => 'Hero Banner - Dijital Ajans',
        'view' => 'frontend.sections._herobanner',
        'data_handler' => null,
        'fields' => [
            // Badge
            [
                'name' => 'badge_icon',
                'label' => 'Badge İkon (Font Awesome)',
                'type' => 'text',
                'default' => 'fas fa-trophy'
            ],
            [
                'name' => 'badge_text',
                'label' => 'Badge Yazısı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Türkiye\'nin #1 Dijital Ajansı'
            ],

            // Ana Başlık
            [
                'name' => 'main_title_part1',
                'label' => 'Ana Başlık (İlk Satır)',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Dijitalleşmeye'
            ],
            [
                'name' => 'main_title_part2',
                'label' => 'Ana Başlık (Vurgulu Satır)',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Hazır Mısınız?'
            ],

            // Açıklama
            [
                'name' => 'description',
                'label' => 'Açıklama Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Türkiye\'nin en iyi müşteri hizmetlerine sahip ödüllü dijital ajans. 36.000\'den fazla işletme bizimle büyüyor!'
            ],

            // İstatistikler
            [
                'name' => 'stats',
                'label' => 'İstatistikler',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'stat_number',
                        'label' => 'İstatistik Sayısı',
                        'type' => 'text',
                        'default' => '36.000+'
                    ],
                    [
                        'name' => 'stat_label',
                        'label' => 'İstatistik Etiketi',
                        'type' => 'text',
                        'translatable' => true,
                        'default' => 'Mutlu Müşteri'
                    ]
                ]
            ],

            // Butonlar
            [
                'name' => 'button1_text',
                'label' => 'Birinci Buton Yazısı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Hemen Başlayın'
            ],
            [
                'name' => 'button1_icon',
                'label' => 'Birinci Buton İkon',
                'type' => 'text',
                'default' => 'fas fa-rocket'
            ],
            [
                'name' => 'button1_link',
                'label' => 'Birinci Buton Linki',
                'type' => 'text',
                'default' => '#'
            ],
            [
                'name' => 'button2_text',
                'label' => 'İkinci Buton Yazısı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Sizi Arayalım'
            ],
            [
                'name' => 'button2_icon',
                'label' => 'İkinci Buton İkon',
                'type' => 'text',
                'default' => 'fas fa-comments'
            ],
            [
                'name' => 'button2_link',
                'label' => 'İkinci Buton Linki',
                'type' => 'text',
                'default' => '#contact'
            ],

            // Güven Badge'leri
            [
                'name' => 'trust_text',
                'label' => 'Güven Alanı Yazısı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Güvenilir Ortaklarımız:'
            ],
            [
                'name' => 'brand_logos',
                'label' => 'Marka Logoları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'logo_image',
                        'label' => 'Logo Görseli',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'logo_alt',
                        'label' => 'Logo Alt Metni',
                        'type' => 'text',
                        'translatable' => true
                    ]
                ]
            ],

            // Floating Logo Cards (Yüzen Logo Kartları)
            [
                'name' => 'floating_logos',
                'label' => 'Yüzen Logo Kartları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'logo_image',
                        'label' => 'Logo Görseli',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'logo_alt',
                        'label' => 'Logo Alt Metni',
                        'type' => 'text',
                        'translatable' => true,
                        'default' => 'Partner Logo'
                    ],
                    [
                        'name' => 'logo_position',
                        'label' => 'Logo Pozisyonu',
                        'type' => 'select',
                        'options' => [
                            'logo-pos-1' => 'Sol Üst',
                            'logo-pos-2' => 'Sağ Üst',
                            'logo-pos-3' => 'Sol Alt',
                            'logo-pos-4' => 'Sağ Alt',
                            'logo-pos-5' => 'Sol Orta',
                            'logo-pos-6' => 'Sağ Orta'
                        ],
                        'default' => 'logo-pos-1'
                    ]
                ]
            ],

            // Görsel Ayarları
            [
                'name' => 'show_dashboard_preview',
                'label' => 'Dashboard Önizleme Göster',
                'type' => 'select',
                'options' => [
                    '1' => 'Evet',
                    '0' => 'Hayır'
                ],
                'default' => '1'
            ],
            [
                'name' => 'background_gradient_color1',
                'label' => 'Arka Plan Gradient Renk 1',
                'type' => 'text',
                'default' => '#667eea'
            ],
            [
                'name' => 'background_gradient_color2',
                'label' => 'Arka Plan Gradient Renk 2',
                'type' => 'text',
                'default' => '#764ba2'
            ],
            // hero-banner-digital section'ına eklenecek yeni alanlar:

// Display Type seçimi (Dashboard veya Video)
            [
                'name' => 'display_type',
                'label' => 'Görsel Tipi',
                'type' => 'select',
                'options' => [
                    'dashboard' => 'Dashboard Önizleme',
                    'video' => 'Video'
                ],
                'default' => 'dashboard'
            ],

// Video URL (YouTube/Vimeo)
            [
                'name' => 'hero_video_url',
                'label' => 'Video URL (YouTube/Vimeo)',
                'type' => 'text',
                'default' => '',
                'help' => 'YouTube veya Vimeo video linki. Örnek: https://www.youtube.com/watch?v=VIDEO_ID'
            ],

// Video File Upload
            [
                'name' => 'hero_video_file',
                'label' => 'Video Dosyası (Yerli)',
                'type' => 'file',
                'help' => 'MP4 formatında video yükleyebilirsiniz. Max: 50MB önerilir.'
            ],

// Video Autoplay
            [
                'name' => 'video_autoplay',
                'label' => 'Otomatik Oynat',
                'type' => 'select',
                'options' => [
                    '1' => 'Evet',
                    '0' => 'Hayır'
                ],
                'default' => '1'
            ],

// Video Muted
            [
                'name' => 'video_muted',
                'label' => 'Sessiz Başlat',
                'type' => 'select',
                'options' => [
                    '1' => 'Evet',
                    '0' => 'Hayır'
                ],
                'default' => '1',
                'help' => 'Otomatik oynatma için sessiz başlatma önerilir'
            ],

// Video Loop
            [
                'name' => 'video_loop',
                'label' => 'Döngü (Loop)',
                'type' => 'select',
                'options' => [
                    '1' => 'Evet',
                    '0' => 'Hayır'
                ],
                'default' => '1'
            ],

// Video Controls
            [
                'name' => 'video_controls',
                'label' => 'Video Kontrolleri Göster',
                'type' => 'select',
                'options' => [
                    '1' => 'Evet',
                    '0' => 'Hayır'
                ],
                'default' => '0',
                'help' => 'Sadece yerli video dosyaları için geçerlidir'
            ],

        ],
    ],
    'our-references' => [
        'name' => 'Marka Referansları (Logo Kaydırıcı)',
        'view' => 'frontend.sections._references', // Yeni oluşturduğumuz Blade dosyasının yolu
        'data_handler' => null, // Dinamik koleksiyon çekilmeyeceği için null
        'fields' => [
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Referanslarımız'
            ],
            [
                'name' => 'subtitle',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Markaların tercihi olmaktan gurur duyuyoruz.'
            ],
            [
                'name' => 'references',
                'label' => 'Referans Logoları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'logo_image',
                        'label' => 'Logo Görseli',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'alt_text',
                        'label' => 'Logo Alt Metni',
                        'type' => 'text',
                        'translatable' => true, // Çok dilli alt metin desteği
                        'default' => 'Marka Logosu'
                    ],
                ]
            ],
        ],
    ],
    'our-services' => [
        'name' => 'Hizmetlerimiz (Grid)',
        'view' => 'frontend.sections._services', // Yeni oluşturduğumuz Blade dosyasının yolu
        'data_handler' => null, // Dinamik koleksiyon çekilmeyeceği için null
        'fields' => [
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Neler Yapıyoruz?'
            ],
            [
                'name' => 'services',
                'label' => 'Hizmet Kartları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'card_title',
                        'label' => 'Kart Başlığı',
                        'type' => 'text',
                        'translatable' => true,
                        'default' => 'Hizmet Başlığı'
                    ],
                    [
                        'name' => 'description',
                        'label' => 'Kısa Açıklama',
                        'type' => 'text',
                        'translatable' => true,
                        'default' => 'Bu hizmetin kısa bir açıklaması.'
                    ],
                    [
                        'name' => 'image',
                        'label' => 'Hizmet Görseli (Opsiyonel)',
                        'type' => 'file',
                        'hint' => 'Eğer görsel eklerseniz, ikon yerine görsel gösterilir.'
                    ],
                    [
                        'name' => 'icon_class',
                        'label' => 'İkon Sınıfı (Görsel Yoksa)',
                        'type' => 'text',
                        'default' => 'fas fa-cogs',
                        'hint' => 'Font Awesome gibi bir ikon kütüphanesinden sınıf adı. Örn: fas fa-rocket'
                    ],
                    [
                        'name' => 'detail_link',
                        'label' => 'Detay Linki',
                        'type' => 'text',
                        'default' => '#'
                    ],
                ]
            ],
        ],
    ],
    'pricing-packages-advanced' => [
        'name' => 'Fiyatlandırma Paketleri (Web Sitesi)',
        'view' => 'frontend.sections._pricing-packages',
        'data_handler' => null,
        'fields' => [
            // Promosyon Banner Alanları
            [
                'name' => 'promo_title',
                'label' => 'Promosyon Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Kasım Ayına Özel %40 İndirim Fırsatı!'
            ],
            [
                'name' => 'promo_subtitle',
                'label' => 'Promosyon Alt Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Sınırsız Revizyon Hakkı + Ücretsiz Hosting Hediye!'
            ],
            [
                'name' => 'promo_description',
                'label' => 'Promosyon Açıklaması',
                'type' => 'text',
                'translatable' => true,
                'default' => 'İlk 50 Müşteriye Özel SSL Sertifikası Hediye!'
            ],
            [
                'name' => 'countdown_end_date',
                'label' => 'Geri Sayım Bitiş Tarihi (YYYY-MM-DD HH:MM:SS)',
                'type' => 'text',
                'default' => '2025-11-30 23:59:59'
            ],
            // Kupon Sistemi Ayarları
            [
                'name' => 'coupon_enabled',
                'label' => 'Kupon Sistemi Aktif',
                'type' => 'select',
                'options' => [
                    '1' => 'Evet',
                    '0' => 'Hayır'
                ],
                'default' => '1'
            ],
            [
                'name' => 'coupon_placeholder',
                'label' => 'Kupon Input Placeholder',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Kupon Kodunu Girin'
            ],
            [
                'name' => 'coupon_button_text',
                'label' => 'Kupon Buton Yazısı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Uygula'
            ],
            [
                'name' => 'coupon_codes',
                'label' => 'Kupon Kodları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'coupon_code',
                        'label' => 'Kupon Kodu',
                        'type' => 'text',
                        'default' => 'NEXTMEDYA40'
                    ],
                    [
                        'name' => 'discount_type',
                        'label' => 'İndirim Tipi',
                        'type' => 'select',
                        'options' => [
                            'percent' => 'Yüzde (%)',
                            'fixed' => 'Sabit Tutar (₺)'
                        ],
                        'default' => 'percent'
                    ],
                    [
                        'name' => 'discount_amount',
                        'label' => 'İndirim Miktarı',
                        'type' => 'text',
                        'default' => '40'
                    ],
                    [
                        'name' => 'coupon_name',
                        'label' => 'Kupon Adı/Açıklaması',
                        'type' => 'text',
                        'translatable' => true,
                        'default' => '%40 İndirim Kuponu'
                    ],
                    [
                        'name' => 'is_active',
                        'label' => 'Aktif',
                        'type' => 'checkbox',
                        'default' => '1'
                    ],
                    [
                        'name' => 'usage_limit',
                        'label' => 'Kullanım Limiti (0 = Sınırsız)',
                        'type' => 'text',
                        'default' => '0'
                    ],
                    [
                        'name' => 'valid_until',
                        'label' => 'Geçerlilik Tarihi (YYYY-MM-DD)',
                        'type' => 'text',
                        'default' => '2025-12-31'
                    ],
                    [
                        'name' => 'minimum_amount',
                        'label' => 'Minimum Tutar (0 = Sınır yok)',
                        'type' => 'text',
                        'default' => '0'
                    ]
                ]
            ],

            // Bölüm Başlığı
            [
                'name' => 'section_title',
                'label' => 'Bölüm Ana Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Web Sitesi Paketleri & Paket Fiyatları'
            ],

            // Marka Logoları Alanı
            [
                'name' => 'brands_title',
                'label' => 'Marka Logoları Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Türkiye\'nin En Gelişmiş Web Sitesi Altyapısı'
            ],
            [
                'name' => 'brands',
                'label' => 'Marka Logoları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'logo_image', 'label' => 'Logo Görseli', 'type' => 'file'],
                    ['name' => 'logo_alt', 'label' => 'Logo Alt Metni', 'type' => 'text', 'translatable' => true],
                ]
            ],

            // Paketler (Ana Repeater)
            [
                'name' => 'packages',
                'label' => 'Fiyatlandırma Paketleri',
                'type' => 'repeater',
                'fields' => [
                    // Paket Bilgileri
                    ['name' => 'package_name', 'label' => 'Paket Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'is_featured', 'label' => 'Öne Çıkarılmış Paket', 'type' => 'checkbox', 'default' => false],
                    ['name' => 'featured_badge_text', 'label' => 'Öne Çıkarma Rozet Yazısı', 'type' => 'text', 'translatable' => true, 'default' => 'En Popüler'],
                    ['name' => 'call_button_text', 'label' => 'Buton Yazısı', 'type' => 'text', 'translatable' => true, 'default' => 'Sizi Arayalım'],
                    ['name' => 'whatsapp_number', 'label' => 'WhatsApp Numarası (Örn: 905551234567)', 'type' => 'text', 'default' => '905555555555'],
                    ['name' => 'whatsapp_message', 'label' => 'WhatsApp Mesaj Şablonu (%s = paket adı)', 'type' => 'text', 'translatable' => true, 'default' => 'Merhaba, %s paketi hakkında bilgi almak istiyorum.'],

                    // Fiyat Bilgileri
                    ['name' => 'price_currency', 'label' => 'Para Birimi', 'type' => 'text', 'default' => '₺'],
                    ['name' => 'package_price', 'label' => 'Aylık Fiyat (Sayı)', 'type' => 'text', 'default' => '2.999'],
                    ['name' => 'price_period', 'label' => 'Dönem', 'type' => 'text', 'translatable' => true, 'default' => '/aylık'],
                    ['name' => 'price_old', 'label' => 'Eski Fiyat Metni (Yıllık)', 'type' => 'text', 'translatable' => true, 'default' => '• Yıllık alımlarda 36.000 ₺'],
                    ['name' => 'price_new', 'label' => 'Yeni Fiyat Metni (2 Yıllık)', 'type' => 'text', 'translatable' => true, 'default' => '• 2 yıllık alımlarda 60.000 ₺yerine 40.000 ₺'],
                    ['name' => 'package_extra', 'label' => 'Ekstra Açıklama (Örn: "Advanced pakete ek olarak")', 'type' => 'textarea', 'translatable' => true],

                    // Özellikler (İç İçe Repeater 1) - GÜNCELLENDİ
                    [
                        'name' => 'features',
                        'label' => 'Paket Özellikleri',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'feature_text', 'label' => 'Özellik Metni', 'type' => 'text', 'translatable' => true],
                            ['name' => 'feature_description', 'label' => 'Özellik Açıklaması (Modal\'da gösterilir)', 'type' => 'textarea', 'translatable' => true],
                            ['name' => 'is_new', 'label' => 'Yeni Rozeti Göster', 'type' => 'checkbox'],
                            ['name' => 'is_pro', 'label' => 'PRO Rozeti Göster', 'type' => 'checkbox'],
                        ]
                    ],

                    // Teknoloji Logoları (İç İçe Repeater 2)
                    [
                        'name' => 'tech_title',
                        'label' => 'Teknoloji Başlığı',
                        'type' => 'text',
                        'translatable' => true,
                        'default' => 'Altyapı Teknolojileri'
                    ],
                    [
                        'name' => 'tech_logos',
                        'label' => 'Teknoloji Logoları',
                        'type' => 'repeater',

                        'fields' => [
                            [
                                'name' => 'tech_logo_text', // -> Bu artık dosya yolu/path tutuyor.
                                'label' => 'Teklonoji Görseli',
                                'type' => 'file' // -> Tipi 'file' olduğu için veritabanında path tutulur.
                            ],
                            [
                                'name' => 'tech_alt_text',
                                'label' => 'Teklonoji Alt Metni',
                                'type' => 'text',
                                'translatable' => true,
                            ],
                        ],
                    ],
                ]
            ],
        ],
    ],


    'main-slider' => [
        'name' => 'Ana Sayfa Slider',
        'view' => 'frontend.sections._main-slider',
        'data_handler' => \App\PageBuilder\SlidersListHandler::class,
        'fields' => [
            [
                'name' => 'transition_effect',
                'label' => 'Geçiş Efekti',
                'type' => 'select',
                'options' => [
                    'fade' => 'Fade (Soldurma)',
                    'slide' => 'Slide (Kaydırma)',
                    'zoom' => 'Zoom (Yakınlaştırma)',
                    'flip' => 'Flip (Çevirme)',
                    'cube' => 'Cube (Küp)',
                    'carousel' => 'Carousel (Döner)',
                ],
                'default' => 'fade'
            ],
            [
                'name' => 'autoplay_speed',
                'label' => 'Otomatik Geçiş Hızı (milisaniye)',
                'type' => 'number',
                'default' => '5000'
            ],
            [
                'name' => 'transition_speed',
                'label' => 'Geçiş Animasyon Hızı (milisaniye)',
                'type' => 'number',
                'default' => '1000'
            ],
        ],
    ],
    'about-us-video' => [
        'name' => 'Hakkımızda (Video ve İçerik)',
        'view' => 'frontend.sections._about-us-video',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'main_image',
                'label' => 'Ana Resim',
                'type' => 'file',
            ],
            [
                'name' => 'popup_image',
                'label' => 'Popup Resmi',
                'type' => 'file',
            ],
            [
                'name' => 'video_url',
                'label' => 'Video URL',
                'type' => 'text',
                'default' => 'https://player.vimeo.com/video/78393586',
            ],
            [
                'name' => 'sub_title',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'About Us',
            ],
            [
                'name' => 'title',
                'label' => 'Ana Başlık',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Concerted Efforts To Build Better.',
            ],
            [
                'name' => 'lead_text',
                'label' => 'Giriş Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Dream big with get more inspiring solutions from here.',
            ],
            [
                'name' => 'main_text',
                'label' => 'Ana Paragraf',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
            ],
            [
                'name' => 'signature_image',
                'label' => 'İmza Resmi',
                'type' => 'file',
            ],
        ],
    ],
    'core-features' => [
        'name' => 'Temel Özellikler (Icon Kutuları)', // Bölümün kendisinin adı (bu değişmedi)
        'view' => 'frontend.sections._core-features',
        'data_handler' => null,
        'fields' => [
            [
                'label' => 'Alt Başlık', // Yönetici panelindeki etiket
                'name' => 'sub_title',   // Form input name'i ve veritabanı JSON anahtarı
                'type' => 'text',
                'translatable' => true,
                'default' => 'Core Features',
            ],
            [
                'label' => 'Ana Başlık İkonu',
                'name' => 'title_icon',
                'type' => 'iconpicker',
                'default' => 'fal fa-user-hard-hat',
            ],
            [
                'label' => 'Ana Başlık Metni',
                'name' => 'title_text',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Doom Features',
            ],
            [
                'label' => 'Özellikler', // Repeater alanının etiketi
                'name' => 'features',    // Repeater'ın form input name'i ve veritabanı JSON anahtarı
                'type' => 'repeater',
                'fields' => [ // Repeater içindeki alanlar
                    [
                        'label' => 'İkon', // İç alanın etiketi
                        'name' => 'icon',  // İç alanın name'i
                        'type' => 'iconpicker',
                        'default' => 'icofont-calculations',
                    ],
                    [
                        'label' => 'Başlık',
                        'name' => 'feature_title',
                        'type' => 'text',
                        'translatable' => true,
                    ],
                    [
                        'label' => 'Açıklama',
                        'name' => 'description',
                        'type' => 'textarea',
                        'translatable' => true,
                    ],
                ]
            ]
        ],
    ],
    'service-cards-grid' => [
        'name' => 'Hizmet Kartları Grid (Filtrelenebilir)',
        'view' => 'frontend.sections._service-cards-grid',
        'data_handler' => null, // Handler'ı kaldırıyoruz
        'fields' => [
            [
                'name' => 'sub_title',
                'label' => 'Üst Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Our Services'
            ],
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'What We Offer'
            ],
            [
                'name' => 'show_filters',
                'label' => 'Kategori Filtreleri Göster',
                'type' => 'select',
                'options' => [
                    '0' => 'Hayır',
                    '1' => 'Evet',
                ]
            ],
            [
                'name' => 'service_cards',
                'label' => 'Hizmet Kartları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'service_image',
                        'label' => 'Hizmet Görseli (370x280)',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'service_title',
                        'label' => 'Hizmet Başlığı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'service_summary',
                        'label' => 'Hizmet Özeti',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                    [
                        'name' => 'service_category',
                        'label' => 'Kategori Adı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'service_link',
                        'label' => 'Hizmet Detay Linki',
                        'type' => 'text'
                    ],
                ]
            ],
        ],
    ],
    'why-choose-us' => [
        'name' => 'Neden Bizi Seçmelisiniz',
        'view' => 'frontend.sections._why-choose-us',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'main_image',
                'label' => 'Sol Taraf Görseli',
                'type' => 'file'
            ],
            [
                'name' => 'sub_title',
                'label' => 'Üst Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'why choose us'
            ],
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'We Offer A Great Variety Of Products & Services.'
            ],
            [
                'name' => 'content',
                'label' => 'İçerik Metni',
                'type' => 'textarea',
                'translatable' => true
            ],
            [
                'name' => 'button_text',
                'label' => 'Buton Yazısı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'get a quote'
            ],
            [
                'name' => 'button_url',
                'label' => 'Buton Linki',
                'type' => 'text',
                'default' => '#'
            ],
        ],
    ],
    'testimonials-section' => [
        'name' => 'Müşteri Yorumları Bölümü',
        'view' => 'frontend.sections._testimonials-section',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'sub_title',
                'label' => 'Üst Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Testimonials'
            ],
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Happy Clients Says About Us'
            ],
            [
                'name' => 'lead_text',
                'label' => 'Vurgu Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Make your dream with us'
            ],
            [
                'name' => 'description',
                'label' => 'Açıklama Metni',
                'type' => 'textarea',
                'translatable' => true
            ],
            [
                'name' => 'testimonials',
                'label' => 'Müşteri Yorumları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'rating',
                        'label' => 'Yıldız Sayısı (1-5)',
                        'type' => 'number',
                        'default' => '5'
                    ],
                    [
                        'name' => 'title',
                        'label' => 'Yorum Başlığı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'content',
                        'label' => 'Yorum İçeriği',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                    [
                        'name' => 'author_image',
                        'label' => 'Yazar Fotoğrafı',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'author_name',
                        'label' => 'Yazar Adı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'author_position',
                        'label' => 'Yazar Pozisyonu',
                        'type' => 'text',
                        'translatable' => true
                    ],
                ]
            ],
        ],
    ],
    'engineering-approach' => [
        'name' => 'Mühendislik Yaklaşımımız',
        'view' => 'frontend.sections._engineering-approach',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            [
                'name' => 'steps',
                'label' => 'Süreç Adımları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'step_number', 'label' => 'Adım Numarası', 'type' => 'text'],
                    ['name' => 'step_icon', 'label' => 'İkon (icofont class)', 'type' => 'text'],
                    ['name' => 'step_title', 'label' => 'Adım Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'step_description', 'label' => 'Adım Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'sectors-we-serve' => [
        'name' => 'Sektörel Uzmanlıklarımız',
        'view' => 'frontend.sections._sectors-we-serve',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            [
                'name' => 'sectors',
                'label' => 'Sektörler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'sector_icon', 'label' => 'Sektör İkonu (icofont class)', 'type' => 'text'],
                    ['name' => 'sector_image', 'label' => 'Sektör Görseli', 'type' => 'file'],
                    ['name' => 'sector_name', 'label' => 'Sektör Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'sector_description', 'label' => 'Sektör Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'technology-innovation' => [
        'name' => 'Teknoloji ve İnovasyon',
        'view' => 'frontend.sections._technology-innovation',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_image', 'label' => 'Ana Görsel', 'type' => 'file'],
            [
                'name' => 'technologies',
                'label' => 'Teknolojiler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'tech_icon', 'label' => 'Teknoloji İkonu', 'type' => 'text'],
                    ['name' => 'tech_title', 'label' => 'Teknoloji Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'tech_description', 'label' => 'Teknoloji Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'quality-safety-standards' => [
        'name' => 'Kalite ve Güvenlik Standartları',
        'view' => 'frontend.sections._quality-safety-standards',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            [
                'name' => 'certificates',
                'label' => 'Sertifikalar',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'certificate_logo', 'label' => 'Sertifika Logosu', 'type' => 'file'],
                    ['name' => 'certificate_name', 'label' => 'Sertifika Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'certificate_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
            [
                'name' => 'standards',
                'label' => 'Standartlar',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'standard_icon', 'label' => 'İkon', 'type' => 'text'],
                    ['name' => 'standard_title', 'label' => 'Standart Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'standard_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],

    'sustainability-focus' => [
        'name' => 'Sürdürülebilirlik Odağımız',
        'view' => 'frontend.sections._sustainability-focus',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'main_image', 'label' => 'Ana Görsel', 'type' => 'file'],
            ['name' => 'video_url', 'label' => 'Video URL (YouTube/Vimeo)', 'type' => 'text'],
            [
                'name' => 'sustainability_features',
                'label' => 'Sürdürülebilirlik Özellikleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'feature_icon', 'label' => 'Özellik İkonu', 'type' => 'text'],
                    ['name' => 'feature_title', 'label' => 'Özellik Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'feature_value', 'label' => 'Değer/İstatistik', 'type' => 'text', 'translatable' => true],
                    ['name' => 'feature_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
            [
                'name' => 'green_initiatives',
                'label' => 'Yeşil Girişimler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'initiative_icon', 'label' => 'İkon', 'type' => 'text'],
                    ['name' => 'initiative_title', 'label' => 'Girişim Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'initiative_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'milestones' => [
        'name' => 'Kilometre Taşları',
        'view' => 'frontend.sections._milestones',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'layout_style', 'label' => 'Layout Stili', 'type' => 'select', 'options' => ['vertical' => 'Dikey', 'horizontal' => 'Yatay'], 'default' => 'vertical'],
            [
                'name' => 'milestones',
                'label' => 'Kilometre Taşları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'year', 'label' => 'Yıl', 'type' => 'text'],
                    ['name' => 'milestone_icon', 'label' => 'İkon', 'type' => 'text'],
                    ['name' => 'milestone_image', 'label' => 'Görsel', 'type' => 'file'],
                    ['name' => 'milestone_title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'milestone_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'highlight', 'label' => 'Öne Çıkar', 'type' => 'checkbox'],
                ]
            ],
        ],
    ],
    'vision-mission' => [
        'name' => 'Vizyon ve Misyon',
        'view' => 'frontend.sections._vision-mission',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'background_image', 'label' => 'Arka Plan Görseli', 'type' => 'file'],

            // Vizyon
            ['name' => 'vision_icon', 'label' => 'Vizyon İkonu', 'type' => 'text', 'default' => 'icofont-eye-alt'],
            ['name' => 'vision_title', 'label' => 'Vizyon Başlığı', 'type' => 'text', 'translatable' => true],
            ['name' => 'vision_content', 'label' => 'Vizyon İçeriği', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'vision_image', 'label' => 'Vizyon Görseli', 'type' => 'file'],

            // Misyon
            ['name' => 'mission_icon', 'label' => 'Misyon İkonu', 'type' => 'text', 'default' => 'icofont-flag-alt-1'],
            ['name' => 'mission_title', 'label' => 'Misyon Başlığı', 'type' => 'text', 'translatable' => true],
            ['name' => 'mission_content', 'label' => 'Misyon İçeriği', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'mission_image', 'label' => 'Misyon Görseli', 'type' => 'file'],

            // Değerler
            [
                'name' => 'values',
                'label' => 'Değerlerimiz',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'value_icon', 'label' => 'Değer İkonu', 'type' => 'text'],
                    ['name' => 'value_title', 'label' => 'Değer Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'value_description', 'label' => 'Değer Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],

            // İstatistikler
            [
                'name' => 'statistics',
                'label' => 'İstatistikler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'stat_icon', 'label' => 'İstatistik İkonu', 'type' => 'text'],
                    ['name' => 'stat_number', 'label' => 'Sayı', 'type' => 'text'],
                    ['name' => 'stat_suffix', 'label' => 'Ek (%, +, vb.)', 'type' => 'text'],
                    ['name' => 'stat_title', 'label' => 'İstatistik Başlığı', 'type' => 'text', 'translatable' => true],
                ]
            ],
        ],
    ],

    'contact-info-boxes' => [
        'name' => 'İletişim Bilgi Kutuları',
        'view' => 'frontend.sections._contact-info-boxes',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'info_boxes',
                'label' => 'İletişim Bilgi Kutuları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'icon', 'label' => 'İkon (Font Awesome class)', 'type' => 'text', 'default' => 'fal fa-map-marker-alt'],
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'content', 'label' => 'İçerik', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'link_text', 'label' => 'Link Metni', 'type' => 'text', 'translatable' => true],
                    ['name' => 'link_url', 'label' => 'Link URL', 'type' => 'text'],
                ]
            ],
        ],
    ],
    'contact-form-modern' => [
        'name' => 'Modern İletişim Formu',
        'view' => 'frontend.sections._contact-form-modern',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Get In Touch'],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Contact Form'],
            ['name' => 'form_action', 'label' => 'Form Action URL', 'type' => 'text', 'default' => '#'],
        ],
    ],
    'google-map-section' => [
        'name' => 'Google Harita',
        'view' => 'frontend.sections._google-map-section',
        'data_handler' => null,
        'fields' => [
            ['name' => 'map_location', 'label' => 'Harita Konumu (örn: New York)', 'type' => 'text', 'default' => 'New York'],
            ['name' => 'map_zoom', 'label' => 'Zoom Seviyesi (1-20)', 'type' => 'number', 'default' => '13'],
            ['name' => 'map_height', 'label' => 'Harita Yüksekliği (px)', 'type' => 'number', 'default' => '600'],
            ['name' => 'map_embed_url', 'label' => 'Özel Google Maps Embed URL (opsiyonel)', 'type' => 'textarea'],
        ],
    ],
    'services-mega-list' => [
        'name' => 'Hizmetler Mega Liste (Kartlı)',
        'view' => 'frontend.sections._services-mega-list',
        'data_handler' => null,
        'fields' => [
            ['name' => 'background_color', 'label' => 'Arkaplan Rengi', 'type' => 'select', 'options' => [
                'light' => 'Açık',
                'dark' => 'Koyu',
                'gradient' => 'Gradyan'
            ], 'default' => 'light'],
            [
                'name' => 'service_categories',
                'label' => 'Hizmet Kategorileri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'category_icon', 'label' => 'Kategori İkonu (Font Awesome)', 'type' => 'text', 'default' => 'fas fa-layer-group'],
                    ['name' => 'category_color', 'label' => 'Kategori Rengi (hex)', 'type' => 'text', 'default' => '#2563eb'],
                    ['name' => 'category_title', 'label' => 'Kategori Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'category_description', 'label' => 'Kategori Açıklaması', 'type' => 'text', 'translatable' => true],
                    [
                        'name' => 'services',
                        'label' => 'Hizmetler',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'service_title', 'label' => 'Hizmet Adı', 'type' => 'text', 'translatable' => true],
                            ['name' => 'service_description', 'label' => 'Kısa Açıklama', 'type' => 'textarea', 'translatable' => true],
                            ['name' => 'service_icon', 'label' => 'Hizmet İkonu', 'type' => 'text', 'default' => 'fas fa-check-circle'],
                            ['name' => 'service_link', 'label' => 'Detay Linki', 'type' => 'text'],
                            ['name' => 'service_image', 'label' => 'Hizmet Görseli (opsiyonel)', 'type' => 'file'],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'projects-gallery' => [
        'name' => 'Projeler Galerisi',
        'view' => 'frontend.sections._projects-gallery',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'sub_title',
                'label' => 'Üst Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Projelerimiz'
            ],
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Başarıyla Tamamlanan Projeler'
            ],
            [
                'name' => 'description',
                'label' => 'Açıklama Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Farklı sektörlerden firmalarla gerçekleştirdiğimiz projeler'
            ],
            [
                'name' => 'layout_style',
                'label' => 'Görünüm Stili',
                'type' => 'select',
                'options' => [
                    'grid' => 'Grid (Karo)',
                    'masonry' => 'Masonry (Düzensiz)',
                ],
                'default' => 'grid'
            ],
            [
                'name' => 'projects',
                'label' => 'Projeler',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'company_name',
                        'label' => 'Firma İsmi',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'project_category',
                        'label' => 'Proje Kategorisi',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'project_date',
                        'label' => 'Proje Tarihi',
                        'type' => 'text',
                        'default' => '2025'
                    ],
                    [
                        'name' => 'project_location',
                        'label' => 'Proje Lokasyonu',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'project_summary',
                        'label' => 'Proje Özeti',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                    [
                        'name' => 'main_image',
                        'label' => 'Ana Görsel (Kapak)',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'gallery_image_1',
                        'label' => 'Galeri Görseli 1',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'gallery_image_2',
                        'label' => 'Galeri Görseli 2',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'gallery_image_3',
                        'label' => 'Galeri Görseli 3',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'gallery_image_4',
                        'label' => 'Galeri Görseli 4',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'project_link',
                        'label' => 'Proje Detay Linki',
                        'type' => 'text'
                    ],
                ]
            ],
        ],
    ],
    // SON
    'latest-blog-posts' => [
        'name' => 'Son Blog Yazıları',
        'view' => 'frontend.sections._latest-blog-posts',
        'data_handler' => 'App\PageBuilder\LatestPostsHandler',
        'fields' => [
            // Temel Ayarlar
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Son Yazılar'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Blog'],

            // Görünüm Ayarları
            ['name' => 'posts_count', 'label' => 'Gösterilecek Yazı Sayısı', 'type' => 'number', 'default' => '6'],
            ['name' => 'show_author', 'label' => 'Yazar Göster', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'show_date', 'label' => 'Tarih Göster', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'show_excerpt', 'label' => 'Özet Göster', 'type' => 'checkbox', 'default' => '1'],

            // Kategori Filtresi
            ['name' => 'filter_by_category', 'label' => 'Kategoriye Göre Filtrele', 'type' => 'select', 'options' => [
                'all' => 'Tüm Kategoriler',
                'specific' => 'Belirli Kategoriler',
            ], 'default' => 'all'],
            ['name' => 'selected_categories', 'label' => 'Seçili Kategoriler (ID, virgülle ayır)', 'type' => 'text', 'hint' => 'Örn: 1,3,5'],
        ],
    ],

    'card-grid' => [
        'name' => 'Kart Grid Bölümü',
        'view' => 'frontend.sections._card-grid',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'section_title',
                'label' => 'Bölüm Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Hizmetlerimiz'
            ],
            [
                'name' => 'section_subtitle',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Kaliteli ve Profesyonel Çözümler'
            ],
            [
                'name' => 'cards',
                'label' => 'Kartlar',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'icon',
                        'label' => 'İkon (Font Awesome class)',
                        'type' => 'text',
                        'default' => 'fas fa-star'
                    ],
                    [
                        'name' => 'title',
                        'label' => 'Kart Başlığı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'description',
                        'label' => 'Kart Açıklaması',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                ]
            ],
        ],
    ],

    // ==================== 2. ACCORDION FAQ SECTION ====================
    'accordion-faq' => [
        'name' => 'Akordeon SSS Bölümü',
        'view' => 'frontend.sections._accordion-faq',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'section_title',
                'label' => 'Bölüm Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Sıkça Sorulan Sorular'
            ],
            [
                'name' => 'section_subtitle',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Merak Ettikleriniz'
            ],
            [
                'name' => 'description',
                'label' => 'Açıklama',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Sizin için hazırladığımız sık sorulan soruları burada bulabilirsiniz.'
            ],
            [
                'name' => 'cta_text',
                'label' => 'Buton Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Bize Ulaşın'
            ],
            [
                'name' => 'cta_link',
                'label' => 'Buton Linki',
                'type' => 'text',
                'default' => '#contact'
            ],
            [
                'name' => 'accordion_items',
                'label' => 'Sorular',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'question',
                        'label' => 'Soru',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'answer',
                        'label' => 'Cevap',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                ]
            ],
        ],
    ],

    // ==================== 3. TEXT BOX IMAGE SECTION ====================
    'text-box-image' => [
        'name' => 'Metin + Görsel Bölümü',
        'view' => 'frontend.sections._text-box-image',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'section_title',
                'label' => 'Bölüm Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Hakkımızda'
            ],
            [
                'name' => 'section_subtitle',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Biz Kimiz'
            ],
            [
                'name' => 'main_content',
                'label' => 'Ana İçerik',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Sektörde uzun yıllara dayanan tecrübemizle, müşterilerimize en kaliteli hizmeti sunmak için çalışıyoruz.'
            ],
            [
                'name' => 'image',
                'label' => 'Görsel',
                'type' => 'file'
            ],
            [
                'name' => 'image_position',
                'label' => 'Görsel Pozisyonu',
                'type' => 'select',
                'options' => [
                    'right' => 'Sağda',
                    'left' => 'Solda'
                ],
                'default' => 'right'
            ],
            [
                'name' => 'features',
                'label' => 'Özellikler',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'icon',
                        'label' => 'İkon',
                        'type' => 'text',
                        'default' => 'fas fa-check-circle'
                    ],
                    [
                        'name' => 'text',
                        'label' => 'Özellik Metni',
                        'type' => 'text',
                        'translatable' => true
                    ],
                ]
            ],
            [
                'name' => 'stats',
                'label' => 'İstatistikler',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'number',
                        'label' => 'Sayı',
                        'type' => 'text'
                    ],
                    [
                        'name' => 'label',
                        'label' => 'Etiket',
                        'type' => 'text',
                        'translatable' => true
                    ],
                ]
            ],
            [
                'name' => 'button_text',
                'label' => 'Buton Metni',
                'type' => 'text',
                'translatable' => true
            ],
            [
                'name' => 'button_link',
                'label' => 'Buton Linki',
                'type' => 'text'
            ],
            [
                'name' => 'badge_text',
                'label' => 'Badge Metni (Görsel üzerindeki)',
                'type' => 'text',
                'translatable' => true
            ],
        ],
    ],

    // ==================== 4. STATISTICS COUNTER SECTION ====================
    'statistics-counter' => [
        'name' => 'İstatistik Sayaç Bölümü',
        'view' => 'frontend.sections._statistics-counter',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'section_title',
                'label' => 'Bölüm Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Rakamlarla Biz'
            ],
            [
                'name' => 'section_subtitle',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Başarı Hikayemiz'
            ],
            [
                'name' => 'background_style',
                'label' => 'Arkaplan Stili',
                'type' => 'select',
                'options' => [
                    'gradient' => 'Gradyan (Mavi)',
                    'dark' => 'Koyu',
                    'light' => 'Açık (Beyaz)'
                ],
                'default' => 'gradient'
            ],
            [
                'name' => 'counters',
                'label' => 'Sayaçlar',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'icon',
                        'label' => 'İkon',
                        'type' => 'text',
                        'default' => 'fas fa-star'
                    ],
                    [
                        'name' => 'number',
                        'label' => 'Sayı',
                        'type' => 'text'
                    ],
                    [
                        'name' => 'suffix',
                        'label' => 'Ek (+, %, vb.)',
                        'type' => 'text'
                    ],
                    [
                        'name' => 'label',
                        'label' => 'Etiket',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'color',
                        'label' => 'Renk',
                        'type' => 'select',
                        'options' => [
                            'blue' => 'Mavi',
                            'green' => 'Yeşil',
                            'yellow' => 'Sarı',
                            'red' => 'Kırmızı'
                        ],
                        'default' => 'blue'
                    ],
                ]
            ],
        ],
    ],

    // ==================== 5. TEAM TESTIMONIAL CAROUSEL ====================
    'team-testimonial-carousel' => [
        'name' => 'Ekip/Referans Carousel Bölümü',
        'view' => 'frontend.sections._team-testimonial-carousel',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'section_title',
                'label' => 'Bölüm Başlığı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Ekibimiz'
            ],
            [
                'name' => 'section_subtitle',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Uzman Kadromuz'
            ],
            [
                'name' => 'section_type',
                'label' => 'Bölüm Tipi',
                'type' => 'select',
                'options' => [
                    'team' => 'Ekip Üyeleri',
                    'testimonial' => 'Müşteri Yorumları'
                ],
                'default' => 'team'
            ],
            [
                'name' => 'items',
                'label' => 'Öğeler',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => 'Görsel',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'name',
                        'label' => 'İsim',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'position',
                        'label' => 'Pozisyon/Ünvan',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'bio',
                        'label' => 'Kısa Bio (Ekip için)',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'testimonial',
                        'label' => 'Yorum Metni (Testimonial için)',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                    [
                        'name' => 'rating',
                        'label' => 'Yıldız (1-5, Testimonial için)',
                        'type' => 'number',
                        'default' => '5'
                    ],
                    [
                        'name' => 'social',
                        'label' => 'Sosyal Medya Linkleri (JSON)',
                        'type' => 'textarea',
                        'help' => 'Örnek: {"linkedin":"#","twitter":"#","email":"user@example.com"}'
                    ],
                ]
            ],
        ],
    ],

    // ==================== 6. CTA BANNER SECTION ====================
    'cta-banner' => [
        'name' => 'CTA Banner Bölümü',
        'view' => 'frontend.sections._cta-banner',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'section_title',
                'label' => 'Ana Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Projenizi Hayata Geçirelim'
            ],
            [
                'name' => 'section_subtitle',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Bugün Bizimle İletişime Geçin'
            ],
            [
                'name' => 'description',
                'label' => 'Açıklama',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Profesyonel ekibimiz, projenizi en iyi şekilde tamamlamak için hazır.'
            ],
            [
                'name' => 'background_style',
                'label' => 'Arkaplan Stili',
                'type' => 'select',
                'options' => [
                    'gradient' => 'Gradyan',
                    'image' => 'Görsel',
                    'particles' => 'Parçacıklar (Animasyonlu)'
                ],
                'default' => 'gradient'
            ],
            [
                'name' => 'background_image',
                'label' => 'Arkaplan Görseli (image stili için)',
                'type' => 'file'
            ],
            [
                'name' => 'primary_button_text',
                'label' => 'Ana Buton Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Hemen Başlayın'
            ],
            [
                'name' => 'primary_button_link',
                'label' => 'Ana Buton Linki',
                'type' => 'text',
                'default' => '#contact'
            ],
            [
                'name' => 'primary_button_icon',
                'label' => 'Ana Buton İkonu',
                'type' => 'text',
                'default' => 'fas fa-arrow-right'
            ],
            [
                'name' => 'secondary_button_text',
                'label' => 'İkinci Buton Metni',
                'type' => 'text',
                'translatable' => true
            ],
            [
                'name' => 'secondary_button_link',
                'label' => 'İkinci Buton Linki',
                'type' => 'text'
            ],
            [
                'name' => 'secondary_button_icon',
                'label' => 'İkinci Buton İkonu',
                'type' => 'text',
                'default' => 'fas fa-phone'
            ],
            [
                'name' => 'features',
                'label' => 'Özellikler (Listesi)',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'icon',
                        'label' => 'İkon',
                        'type' => 'text',
                        'default' => 'fas fa-check'
                    ],
                    [
                        'name' => 'text',
                        'label' => 'Özellik Metni',
                        'type' => 'text',
                        'translatable' => true
                    ],
                ]
            ],
            [
                'name' => 'contact_info',
                'label' => 'İletişim Bilgisi (Alt kısımda)',
                'type' => 'text',
                'translatable' => true
            ],
        ],
    ],
    'google-partnership' => [
        'name' => 'Google Partnership Bölümü',
        'view' => 'frontend.sections._google-partnership',
        'data_handler' => null,
        'fields' => [
            // ==================== GENEL BİLGİLER ====================
            [
                'name' => 'section_title',
                'label' => 'Bölüm Başlığı (Google kelimesinden sonraki kısım)',
                'type' => 'text',
                'translatable' => true,
                'default' => 'ile Güçlü İş Ortaklığı',
                'help' => 'Örnek: "ile Güçlü İş Ortaklığı" şeklinde görünecek'
            ],
            [
                'name' => 'section_subtitle',
                'label' => 'Badge Yazısı (Üst kısımdaki yeşil noktalı badge)',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Resmi Google Partner'
            ],
            [
                'name' => 'description',
                'label' => 'Açıklama Metni',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Google\'ın resmi iş ortağı olarak, en güncel teknolojileri ve araçları kullanarak işletmenizin dijital başarısını garanti altına alıyoruz.'
            ],

            // ==================== CTA BUTONLARI ====================
            [
                'name' => 'primary_button_text',
                'label' => 'Ana Buton Metni (Mavi Gradyan Buton)',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Partner Avantajlarını Keşfet'
            ],
            [
                'name' => 'primary_button_link',
                'label' => 'Ana Buton Linki',
                'type' => 'text',
                'default' => '#contact'
            ],
            [
                'name' => 'secondary_button_text',
                'label' => 'İkinci Buton Metni (Outline Buton)',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Sertifikalarımız'
            ],
            [
                'name' => 'secondary_button_link',
                'label' => 'İkinci Buton Linki',
                'type' => 'text',
                'default' => '#certificates'
            ],

            // ==================== İSTATİSTİKLER ====================
            [
                'name' => 'stats',
                'label' => 'İstatistikler (Sol tarafta 2x2 grid)',
                'type' => 'repeater',
                'help' => 'En fazla 4 istatistik kartı eklemeniz önerilir',
                'fields' => [
                    [
                        'name' => 'number',
                        'label' => 'Sayı (Sadece rakam)',
                        'type' => 'text',
                        'default' => '500',
                        'help' => 'Örnek: 500, 98, 5, 24'
                    ],
                    [
                        'name' => 'suffix',
                        'label' => 'Ek (Sayıdan sonra gelecek)',
                        'type' => 'text',
                        'default' => '+',
                        'help' => 'Örnek: +, %, Yıl, /7'
                    ],
                    [
                        'name' => 'label',
                        'label' => 'Etiket (Alt kısımdaki açıklama)',
                        'type' => 'text',
                        'translatable' => true,
                        'help' => 'Örnek: Başarılı Proje, Müşteri Memnuniyeti'
                    ]
                ],
                'default' => [
                    [
                        'number' => '500',
                        'suffix' => '+',
                        'label' => ['tr' => 'Başarılı Proje', 'en' => 'Successful Projects']
                    ],
                    [
                        'number' => '98',
                        'suffix' => '%',
                        'label' => ['tr' => 'Müşteri Memnuniyeti', 'en' => 'Customer Satisfaction']
                    ],
                    [
                        'number' => '5',
                        'suffix' => ' Yıl',
                        'label' => ['tr' => 'Partner Deneyimi', 'en' => 'Partner Experience']
                    ],
                    [
                        'number' => '24',
                        'suffix' => '/7',
                        'label' => ['tr' => 'Destek Hizmeti', 'en' => 'Support Service']
                    ],
                ]
            ],

            // ==================== SERTİFİKALAR ====================
            [
                'name' => 'certifications',
                'label' => 'Sertifikalar (Sağ tarafta 2x2 grid)',
                'type' => 'repeater',
                'help' => 'En fazla 4 sertifika kartı eklemeniz önerilir',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => 'Sertifika Adı',
                        'type' => 'text',
                        'translatable' => true,
                        'help' => 'Örnek: Google Ads, Analytics, Cloud Platform'
                    ],
                    [
                        'name' => 'desc',
                        'label' => 'Açıklama (Alt kısım)',
                        'type' => 'text',
                        'translatable' => true,
                        'help' => 'Örnek: Sertifikalı Uzman, İleri Seviye'
                    ],
                    [
                        'name' => 'icon',
                        'label' => 'İkon Tipi',
                        'type' => 'select',
                        'options' => [
                            'shield' => 'Kalkan (Shield) - Güvenlik/Sertifika',
                            'chart' => 'Grafik (Chart) - Analytics/Data',
                            'cloud' => 'Bulut (Cloud) - Cloud Platform',
                            'briefcase' => 'Çanta (Briefcase) - İş/Workspace'
                        ],
                        'default' => 'shield'
                    ]
                ],
                'default' => [
                    [
                        'title' => ['tr' => 'Google Ads', 'en' => 'Google Ads'],
                        'desc' => ['tr' => 'Sertifikalı Uzman', 'en' => 'Certified Expert'],
                        'icon' => 'shield'
                    ],
                    [
                        'title' => ['tr' => 'Analytics', 'en' => 'Analytics'],
                        'desc' => ['tr' => 'İleri Seviye', 'en' => 'Advanced Level'],
                        'icon' => 'chart'
                    ],
                    [
                        'title' => ['tr' => 'Cloud Platform', 'en' => 'Cloud Platform'],
                        'desc' => ['tr' => 'Onaylı Partner', 'en' => 'Approved Partner'],
                        'icon' => 'cloud'
                    ],
                    [
                        'title' => ['tr' => 'Workspace', 'en' => 'Workspace'],
                        'desc' => ['tr' => 'Kurumsal Çözüm', 'en' => 'Enterprise Solution'],
                        'icon' => 'briefcase'
                    ],
                ]
            ],

            // ==================== ÖZELLİKLER ====================
            [
                'name' => 'features',
                'label' => 'Özellikler (Alt kısımda yatay liste)',
                'type' => 'repeater',
                'help' => 'En fazla 4 özellik eklemeniz önerilir',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => 'Özellik Başlığı',
                        'type' => 'text',
                        'translatable' => true,
                        'help' => 'Örnek: Hızlı Performans, Güvenli Altyapı'
                    ],
                    [
                        'name' => 'text',
                        'label' => 'Özellik Açıklaması',
                        'type' => 'text',
                        'translatable' => true,
                        'help' => 'Kısa bir açıklama metni'
                    ],
                    [
                        'name' => 'icon',
                        'label' => 'İkon Tipi',
                        'type' => 'select',
                        'options' => [
                            'zap' => 'Yıldırım (Zap) - Hız/Performans',
                            'lock' => 'Kilit (Lock) - Güvenlik',
                            'headset' => 'Kulaklık (Headset) - Destek',
                            'cpu' => 'CPU (Processor) - Teknoloji/AI'
                        ],
                        'default' => 'zap'
                    ]
                ],
                'default' => [
                    [
                        'title' => ['tr' => 'Hızlı Performans', 'en' => 'Fast Performance'],
                        'text' => ['tr' => 'Google altyapısıyla maksimum hız', 'en' => 'Maximum speed with Google infrastructure'],
                        'icon' => 'zap'
                    ],
                    [
                        'title' => ['tr' => 'Güvenli Altyapı', 'en' => 'Secure Infrastructure'],
                        'text' => ['tr' => 'En yüksek güvenlik standartları', 'en' => 'Highest security standards'],
                        'icon' => 'lock'
                    ],
                    [
                        'title' => ['tr' => '7/24 Destek', 'en' => '24/7 Support'],
                        'text' => ['tr' => 'Kesintisiz teknik destek hizmeti', 'en' => 'Uninterrupted technical support'],
                        'icon' => 'headset'
                    ],
                    [
                        'title' => ['tr' => 'AI Teknolojileri', 'en' => 'AI Technologies'],
                        'text' => ['tr' => 'Yapay zeka destekli çözümler', 'en' => 'AI-powered solutions'],
                        'icon' => 'cpu'
                    ],
                ]
            ],
        ],
    ],
    'corporate-web-hero' => [
        'name' => 'Kurumsal Web Tasarım Hero',
        'view' => 'frontend.sections._corporate-web-hero',
        'data_handler' => null,
        'fields' => [
            ['name' => 'main_headline', 'label' => 'Ana Başlık', 'type' => 'textarea', 'translatable' => true, 'default' => 'Web Siteniz, 7/24 Çalışan En İyi Satış Personeliniz Olsun'],
            ['name' => 'sub_headline', 'label' => 'Alt Başlık', 'type' => 'textarea', 'translatable' => true, 'default' => 'Markanızın gücünü yansıtan, hızlı, güvenli ve Google dostu kurumsal web siteleri tasarlıyoruz.'],
            ['name' => 'hero_image', 'label' => 'Hero Görseli', 'type' => 'file'],
            ['name' => 'cta_primary_text', 'label' => 'Birincil Buton Yazısı', 'type' => 'text', 'translatable' => true, 'default' => 'Ücretsiz Analiz İste'],
            ['name' => 'cta_primary_url', 'label' => 'Birincil Buton Linki', 'type' => 'text', 'default' => '#contact'],
            ['name' => 'cta_secondary_text', 'label' => 'İkincil Buton Yazısı', 'type' => 'text', 'translatable' => true, 'default' => 'Portfolyo'],
            ['name' => 'cta_secondary_url', 'label' => 'İkincil Buton Linki', 'type' => 'text', 'default' => '#portfolio'],
            [
                'name' => 'trust_badges',
                'label' => 'Güven Rozetleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'badge_icon', 'label' => 'Rozet İkonu', 'type' => 'text', 'default' => 'fas fa-award'],
                    ['name' => 'badge_text', 'label' => 'Rozet Metni', 'type' => 'text', 'translatable' => true],
                ]
            ],
        ],
    ],
    'web-pain-points' => [
        'name' => 'Web Sitesi Sorunları',
        'view' => 'frontend.sections._web-pain-points',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Mevcut Siteniz Sizi Yansıtıyor mu?'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Bu Sorunlar Tanıdık Geliyor mu?'],
            [
                'name' => 'pain_points',
                'label' => 'Sorun Noktaları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-times-circle'],
                    ['name' => 'title', 'label' => 'Sorun Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'description', 'label' => 'Sorun Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'web-value-proposition' => [
        'name' => 'Next Medya Farkı',
        'view' => 'frontend.sections._web-value-proposition',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Next Medya Farkı: Sadece Tasarım Değil, Strateji Sunuyoruz'],
            ['name' => 'section_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'main_image', 'label' => 'Ana Görsel', 'type' => 'file'],
            [
                'name' => 'value_benefits',
                'label' => 'Değer Önerileri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-trophy'],
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'color', 'label' => 'Renk Tonu', 'type' => 'select', 'options' => [
                        'blue' => 'Mavi',
                        'green' => 'Yeşil',
                        'purple' => 'Mor',
                        'orange' => 'Turuncu',
                    ]],
                ]
            ],
        ],
    ],
    'web-social-proof' => [
        'name' => 'Portfolyo ve Sosyal Kanıt',
        'view' => 'frontend.sections._web-social-proof',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Başarı Hikayelerimiz'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Müşterilerimiz Ne Diyor?'],
            [
                'name' => 'case_studies',
                'label' => 'Durum Çalışmaları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'company_name', 'label' => 'Firma Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'company_logo', 'label' => 'Firma Logosu', 'type' => 'file'],
                    ['name' => 'project_image', 'label' => 'Proje Görseli', 'type' => 'file'],
                    ['name' => 'industry', 'label' => 'Sektör', 'type' => 'text', 'translatable' => true],
                    ['name' => 'problem', 'label' => 'Problem', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'solution', 'label' => 'Çözüm', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'result_metric_1', 'label' => 'Sonuç Metriği 1 (Sayı)', 'type' => 'text'],
                    ['name' => 'result_metric_1_label', 'label' => 'Metrik 1 Etiketi', 'type' => 'text', 'translatable' => true],
                    ['name' => 'result_metric_2', 'label' => 'Sonuç Metriği 2 (Sayı)', 'type' => 'text'],
                    ['name' => 'result_metric_2_label', 'label' => 'Metrik 2 Etiketi', 'type' => 'text', 'translatable' => true],
                    ['name' => 'result_metric_3', 'label' => 'Sonuç Metriği 3 (Sayı)', 'type' => 'text'],
                    ['name' => 'result_metric_3_label', 'label' => 'Metrik 3 Etiketi', 'type' => 'text', 'translatable' => true],
                    ['name' => 'project_url', 'label' => 'Proje Detay Linki', 'type' => 'text'],
                ]
            ],
            [
                'name' => 'testimonials',
                'label' => 'Müşteri Yorumları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'client_name', 'label' => 'Müşteri Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'client_position', 'label' => 'Pozisyon', 'type' => 'text', 'translatable' => true],
                    ['name' => 'client_company', 'label' => 'Firma', 'type' => 'text', 'translatable' => true],
                    ['name' => 'client_photo', 'label' => 'Müşteri Fotoğrafı', 'type' => 'file'],
                    ['name' => 'rating', 'label' => 'Yıldız (1-5)', 'type' => 'number', 'default' => '5'],
                    ['name' => 'testimonial_text', 'label' => 'Yorum Metni', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'web-why-choose-us' => [
        'name' => 'Neden Next Medya?',
        'view' => 'frontend.sections._web-why-choose-us',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Neden Bir Freelancer Değil de Next Medya?'],
            ['name' => 'section_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'comparison_image', 'label' => 'Karşılaştırma Görseli', 'type' => 'file'],
            [
                'name' => 'differentiators',
                'label' => 'Farklılaştırıcı Özellikler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-shield-alt'],
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'highlight', 'label' => 'Öne Çıkar', 'type' => 'checkbox'],
                ]
            ],
            [
                'name' => 'stats',
                'label' => 'İstatistikler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'number', 'label' => 'Sayı', 'type' => 'text'],
                    ['name' => 'suffix', 'label' => 'Ek (+, %, vb)', 'type' => 'text'],
                    ['name' => 'label', 'label' => 'Etiket', 'type' => 'text', 'translatable' => true],
                    ['name' => 'icon', 'label' => 'İkon', 'type' => 'text'],
                ]
            ],
        ],
    ],
    'web-design-process' => [
        'name' => 'Web Tasarım Süreci',
        'view' => 'frontend.sections._web-design-process',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Sizi 4 Adımda Dijital Dünyaya Taşıyoruz'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Şeffaf ve Öngörülebilir Süreç'],
            ['name' => 'cta_text', 'label' => 'CTA Butonu Metni', 'type' => 'text', 'translatable' => true, 'default' => 'Hemen Başlayalım'],
            ['name' => 'cta_url', 'label' => 'CTA Butonu Linki', 'type' => 'text', 'default' => '#contact'],
            [
                'name' => 'process_steps',
                'label' => 'Süreç Adımları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'step_number', 'label' => 'Adım Numarası', 'type' => 'text'],
                    ['name' => 'step_icon', 'label' => 'Adım İkonu', 'type' => 'text', 'default' => 'fas fa-lightbulb'],
                    ['name' => 'step_title', 'label' => 'Adım Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'step_description', 'label' => 'Adım Açıklaması', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'step_duration', 'label' => 'Süre', 'type' => 'text', 'translatable' => true],
                    [
                        'name' => 'step_features',
                        'label' => 'Adım Özellikleri',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'feature_text', 'label' => 'Özellik', 'type' => 'text', 'translatable' => true],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'ecommerce-features-showcase' => [
        'name' => 'E-Ticaret Özellikler Vitrini',
        'view' => 'frontend.sections._ecommerce-features-showcase',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'WooCommerce ile Neler Yapabilirsiniz?'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Profesyonel E-Ticaret Özellikleri'],
            ['name' => 'layout_style', 'label' => 'Layout Stili', 'type' => 'select', 'options' => [
                'grid' => 'Grid (Karo)',
                'tabs' => 'Sekmeli',
                'accordion' => 'Akordeon',
            ], 'default' => 'grid'],
            [
                'name' => 'feature_categories',
                'label' => 'Özellik Kategorileri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'category_name', 'label' => 'Kategori Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'category_icon', 'label' => 'Kategori İkonu', 'type' => 'text', 'default' => 'fas fa-shopping-cart'],
                    ['name' => 'category_color', 'label' => 'Kategori Rengi', 'type' => 'text', 'default' => '#3b82f6'],
                    [
                        'name' => 'features',
                        'label' => 'Özellikler',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'feature_icon', 'label' => 'Özellik İkonu', 'type' => 'text', 'default' => 'fas fa-check'],
                            ['name' => 'feature_title', 'label' => 'Özellik Başlığı', 'type' => 'text', 'translatable' => true],
                            ['name' => 'feature_description', 'label' => 'Özellik Açıklaması', 'type' => 'textarea', 'translatable' => true],
                            ['name' => 'feature_image', 'label' => 'Özellik Görseli (Opsiyonel)', 'type' => 'file'],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'ecommerce-pricing-packages' => [
        'name' => 'E-Ticaret Paket Fiyatlandırma',
        'view' => 'frontend.sections._ecommerce-pricing-packages',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Size Uygun Paketi Seçin'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Şeffaf Fiyatlandırma'],
            ['name' => 'show_annual_discount', 'label' => 'Yıllık İndirim Göster', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'annual_discount_text', 'label' => 'Yıllık İndirim Metni', 'type' => 'text', 'translatable' => true, 'default' => '2 Ay Ücretsiz'],
            [
                'name' => 'packages',
                'label' => 'Paketler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'package_name', 'label' => 'Paket Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'package_badge', 'label' => 'Paket Rozeti', 'type' => 'text', 'translatable' => true, 'default' => 'Popüler'],
                    ['name' => 'show_badge', 'label' => 'Rozet Göster', 'type' => 'checkbox'],
                    ['name' => 'package_icon', 'label' => 'Paket İkonu', 'type' => 'text', 'default' => 'fas fa-store'],
                    ['name' => 'package_description', 'label' => 'Paket Açıklaması', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'monthly_price', 'label' => 'Aylık Fiyat', 'type' => 'text'],
                    ['name' => 'annual_price', 'label' => 'Yıllık Fiyat', 'type' => 'text'],
                    ['name' => 'currency', 'label' => 'Para Birimi', 'type' => 'text', 'default' => '₺'],
                    ['name' => 'highlight', 'label' => 'Öne Çıkar', 'type' => 'checkbox'],
                    ['name' => 'button_text', 'label' => 'Buton Metni', 'type' => 'text', 'translatable' => true, 'default' => 'Başlayın'],
                    ['name' => 'button_url', 'label' => 'Buton Linki', 'type' => 'text', 'default' => '#contact'],
                    [
                        'name' => 'features',
                        'label' => 'Özellikler',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'feature_text', 'label' => 'Özellik', 'type' => 'text', 'translatable' => true],
                            ['name' => 'is_included', 'label' => 'Dahil', 'type' => 'checkbox', 'default' => '1'],
                            ['name' => 'feature_tooltip', 'label' => 'Açıklama (Tooltip)', 'type' => 'text', 'translatable' => true],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'ecommerce-integrations' => [
        'name' => 'E-Ticaret Entegrasyonları',
        'view' => 'frontend.sections._ecommerce-integrations',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Güçlü Entegrasyonlar'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'İş Süreçlerinizi Tek Platformda Yönetin'],
            ['name' => 'section_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'layout_type', 'label' => 'Layout Tipi', 'type' => 'select', 'options' => [
                'carousel' => 'Carousel (Otomatik Döner)',
                'grid' => 'Grid (Izgara)',
                'categories' => 'Kategorili',
            ], 'default' => 'categories'],
            [
                'name' => 'integration_categories',
                'label' => 'Entegrasyon Kategorileri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'category_name', 'label' => 'Kategori Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'category_icon', 'label' => 'Kategori İkonu', 'type' => 'text', 'default' => 'fas fa-plug'],
                    ['name' => 'category_description', 'label' => 'Kategori Açıklaması', 'type' => 'textarea', 'translatable' => true],
                    [
                        'name' => 'integrations',
                        'label' => 'Entegrasyonlar',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'integration_name', 'label' => 'Entegrasyon Adı', 'type' => 'text', 'translatable' => true],
                            ['name' => 'integration_logo', 'label' => 'Logo', 'type' => 'file'],
                            ['name' => 'integration_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                            ['name' => 'is_premium', 'label' => 'Premium Özellik', 'type' => 'checkbox'],
                            ['name' => 'setup_time', 'label' => 'Kurulum Süresi', 'type' => 'text', 'translatable' => true, 'default' => '5 dakika'],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'ecommerce-payment-security' => [
        'name' => 'Ödeme Yöntemleri ve Güvenlik',
        'view' => 'frontend.sections._ecommerce-payment-security',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Güvenli Ödeme Altyapısı'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Müşterileriniz Güvenle Alışveriş Yapabilir'],
            ['name' => 'left_image', 'label' => 'Sol Taraf Görseli', 'type' => 'file'],
            ['name' => 'show_payment_methods', 'label' => 'Ödeme Yöntemlerini Göster', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'show_security_features', 'label' => 'Güvenlik Özelliklerini Göster', 'type' => 'checkbox', 'default' => '1'],
            [
                'name' => 'payment_methods',
                'label' => 'Ödeme Yöntemleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'method_name', 'label' => 'Yöntem Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'method_logo', 'label' => 'Logo', 'type' => 'file'],
                    ['name' => 'method_description', 'label' => 'Açıklama', 'type' => 'text', 'translatable' => true],
                    ['name' => 'is_popular', 'label' => 'Popüler', 'type' => 'checkbox'],
                ]
            ],
            [
                'name' => 'security_features',
                'label' => 'Güvenlik Özellikleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'feature_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-shield-alt'],
                    ['name' => 'feature_title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'feature_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
            [
                'name' => 'trust_badges',
                'label' => 'Güven Rozetleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'badge_image', 'label' => 'Rozet Görseli', 'type' => 'file'],
                    ['name' => 'badge_text', 'label' => 'Rozet Metni', 'type' => 'text', 'translatable' => true],
                ]
            ],
        ],
    ],
    'ecommerce-success-metrics' => [
        'name' => 'E-Ticaret Başarı Metrikleri',
        'view' => 'frontend.sections._ecommerce-success-metrics',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Rakamlarla Başarımız'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Güvenilir E-Ticaret Çözümleri'],
            ['name' => 'background_style', 'label' => 'Arkaplan Stili', 'type' => 'select', 'options' => [
                'gradient' => 'Gradient',
                'solid' => 'Solid',
                'image' => 'Görsel',
            ], 'default' => 'gradient'],
            ['name' => 'background_image', 'label' => 'Arkaplan Görseli', 'type' => 'file'],
            ['name' => 'enable_counter_animation', 'label' => 'Sayaç Animasyonu', 'type' => 'checkbox', 'default' => '1'],
            [
                'name' => 'metrics',
                'label' => 'Metrikler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'metric_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-shopping-cart'],
                    ['name' => 'metric_number', 'label' => 'Sayı', 'type' => 'text'],
                    ['name' => 'metric_suffix', 'label' => 'Suffix (+ veya M gibi)', 'type' => 'text', 'default' => '+'],
                    ['name' => 'metric_title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'metric_description', 'label' => 'Açıklama', 'type' => 'text', 'translatable' => true],
                    ['name' => 'metric_color', 'label' => 'Renk', 'type' => 'text', 'default' => '#3b82f6'],
                ]
            ],
            [
                'name' => 'testimonial_highlight',
                'label' => 'Müşteri Yorumu (Öne Çıkan)',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'client_name', 'label' => 'Müşteri Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'client_company', 'label' => 'Şirket', 'type' => 'text', 'translatable' => true],
                    ['name' => 'client_photo', 'label' => 'Fotoğraf', 'type' => 'file'],
                    ['name' => 'testimonial_text', 'label' => 'Yorum Metni', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'rating', 'label' => 'Puan (1-5)', 'type' => 'text', 'default' => '5'],
                ]
            ],
        ],
    ],
    'ecommerce-faq' => [
        'name' => 'E-Ticaret SSS',
        'view' => 'frontend.sections._ecommerce-faq',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Sık Sorulan Sorular'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Merak Ettikleriniz'],
            ['name' => 'section_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'show_contact_cta', 'label' => 'İletişim CTA Göster', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'cta_title', 'label' => 'CTA Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Başka Sorularınız mı Var?'],
            ['name' => 'cta_description', 'label' => 'CTA Açıklaması', 'type' => 'text', 'translatable' => true, 'default' => 'Uzman ekibimiz size yardımcı olmak için burada'],
            ['name' => 'cta_button_text', 'label' => 'CTA Buton Metni', 'type' => 'text', 'translatable' => true, 'default' => 'İletişime Geçin'],
            ['name' => 'cta_button_url', 'label' => 'CTA Buton Linki', 'type' => 'text', 'default' => '#contact'],
            [
                'name' => 'faq_categories',
                'label' => 'SSS Kategorileri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'category_name', 'label' => 'Kategori Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'category_icon', 'label' => 'Kategori İkonu', 'type' => 'text', 'default' => 'fas fa-question-circle'],
                    [
                        'name' => 'questions',
                        'label' => 'Sorular',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'question', 'label' => 'Soru', 'type' => 'text', 'translatable' => true],
                            ['name' => 'answer', 'label' => 'Cevap', 'type' => 'textarea', 'translatable' => true],
                            ['name' => 'is_highlighted', 'label' => 'Öne Çıkar', 'type' => 'checkbox'],
                        ]
                    ],
                ]
            ],
        ],
    ],

    'premium-services-showcase' => [
        'name' => 'Premium Hizmet Vitrini',
        'view' => 'frontend.sections._premium-services-showcase',
        'data_handler' => null,
        'fields' => [
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Hizmetlerimiz'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Size Özel Çözümler'],
            ['name' => 'section_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'layout_style', 'label' => 'Layout Stili', 'type' => 'select', 'options' => [
                'cards-3d' => '3D Kartlar (Hover Efekti)',
                'glass-morphism' => 'Glass Morphism',
                'bento-grid' => 'Bento Grid (Modern)',
                'floating-cards' => 'Floating Cards (Animasyonlu)',
                'split-screen' => 'Split Screen (İki Kollu)',
            ], 'default' => 'cards-3d'],
            ['name' => 'enable_filter', 'label' => 'Kategori Filtresi Aktif', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'enable_hover_video', 'label' => 'Hover\'da Video Oynat', 'type' => 'checkbox', 'default' => '0'],
            ['name' => 'card_animation', 'label' => 'Kart Animasyonu', 'type' => 'select', 'options' => [
                'fade' => 'Fade In',
                'slide-up' => 'Slide Up',
                'zoom' => 'Zoom In',
                'rotate' => 'Rotate',
                'flip' => 'Flip',
            ], 'default' => 'slide-up'],
            [
                'name' => 'services',
                'label' => 'Hizmetler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'service_title', 'label' => 'Hizmet Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'service_category', 'label' => 'Kategori', 'type' => 'text', 'translatable' => true, 'default' => 'Genel'],
                    ['name' => 'service_short_desc', 'label' => 'Kısa Açıklama', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'service_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-rocket'],
                    ['name' => 'service_image', 'label' => 'Görsel', 'type' => 'file'],
                    ['name' => 'service_video', 'label' => 'Video URL (Hover için)', 'type' => 'text'],
                    ['name' => 'gradient_start', 'label' => 'Gradient Başlangıç Rengi', 'type' => 'text', 'default' => '#667eea'],
                    ['name' => 'gradient_end', 'label' => 'Gradient Bitiş Rengi', 'type' => 'text', 'default' => '#764ba2'],
                    ['name' => 'service_price', 'label' => 'Başlangıç Fiyatı (Opsiyonel)', 'type' => 'text', 'translatable' => true],
                    ['name' => 'service_badge', 'label' => 'Rozet (Popüler, Yeni, vb.)', 'type' => 'text', 'translatable' => true],
                    ['name' => 'service_link', 'label' => 'Detay Linki', 'type' => 'text'],
                    ['name' => 'is_featured', 'label' => 'Öne Çıkar', 'type' => 'checkbox'],
                    [
                        'name' => 'service_features',
                        'label' => 'Hizmet Özellikleri',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'feature_text', 'label' => 'Özellik', 'type' => 'text', 'translatable' => true],
                            ['name' => 'feature_icon', 'label' => 'Özellik İkonu', 'type' => 'text', 'default' => 'fas fa-check'],
                        ]
                    ],
                    [
                        'name' => 'service_stats',
                        'label' => 'İstatistikler (Opsiyonel)',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'stat_number', 'label' => 'Sayı', 'type' => 'text'],
                            ['name' => 'stat_label', 'label' => 'Etiket', 'type' => 'text', 'translatable' => true],
                            ['name' => 'stat_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-star'],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'references-showcase' => [
        'name' => 'Referanslar Vitrini',
        'view' => 'frontend.sections._references-showcase',
        'data_handler' => null,
        'fields' => [
            // Genel Ayarlar
            ['name' => 'section_title', 'label' => 'Bölüm Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Referanslarımız'],
            ['name' => 'section_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Güvenilir İş Ortakları'],
            ['name' => 'section_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true, 'default' => 'Türkiye\'nin önde gelen markalarıyla çalışmaktan gurur duyuyoruz.'],

            // Layout Seçenekleri
            ['name' => 'layout_style', 'label' => 'Layout Stili', 'type' => 'select', 'options' => [
                'grid' => 'Grid (Izgara)',
                'carousel' => 'Carousel (Kaydırmalı)',
                'masonry' => 'Masonry (Pinterest Tarzı)',
            ], 'default' => 'grid'],

            ['name' => 'show_category_filter', 'label' => 'Kategori Filtresi Göster', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'show_stats', 'label' => 'İstatistikleri Göster', 'type' => 'checkbox', 'default' => '1'],

            // Toplu Resim Yükleme
            ['name' => 'bulk_gallery_upload', 'label' => 'Toplu Galeri Resimleri', 'type' => 'file', 'multiple' => true, 'help' => 'Birden fazla resim seçebilirsiniz. Bu resimler sonra referanslara atanabilir.'],

            // İstatistikler
            [
                'name' => 'stats',
                'label' => 'İstatistikler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'stat_number', 'label' => 'Sayı', 'type' => 'text', 'default' => '500'],
                    ['name' => 'stat_suffix', 'label' => 'Ek (+, %, vb)', 'type' => 'text', 'default' => '+'],
                    ['name' => 'stat_label', 'label' => 'Etiket', 'type' => 'text', 'translatable' => true, 'default' => 'Mutlu Müşteri'],
                    ['name' => 'stat_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-users'],
                ]
            ],

            // Referanslar (Basitleştirilmiş)
            [
                'name' => 'references',
                'label' => 'Referanslar',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'company_name', 'label' => 'Firma Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'company_logo', 'label' => 'Firma Logosu', 'type' => 'file'],
                    ['name' => 'company_website', 'label' => 'Web Sitesi', 'type' => 'text'],
                    ['name' => 'company_category', 'label' => 'Kategori', 'type' => 'text', 'translatable' => true, 'default' => 'Genel'],
                    ['name' => 'is_featured', 'label' => 'Öne Çıkar', 'type' => 'checkbox', 'default' => '0'],

                    // Galeri Resimleri (İç içe repeater)
                    [
                        'name' => 'gallery_images',
                        'label' => 'Galeri Resimleri',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'image', 'label' => 'Resim', 'type' => 'file'],
                            ['name' => 'image_title', 'label' => 'Resim Başlığı', 'type' => 'text', 'translatable' => true],
                            ['name' => 'image_description', 'label' => 'Resim Açıklaması', 'type' => 'text', 'translatable' => true],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'about-us-comprehensive' => [
        'name' => 'Hakkımızda - Kapsamlı',
        'view' => 'frontend.sections._about-us-comprehensive',
        'data_handler' => null,
        'fields' => [
            // Hero Bölümü
            ['name' => 'hero_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Hakkımızda'],
            ['name' => 'hero_subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Dijital Dünyada Fark Yaratan Ekip'],
            ['name' => 'hero_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'hero_image', 'label' => 'Hero Görseli', 'type' => 'file'],
            ['name' => 'hero_video_url', 'label' => 'Tanıtım Videosu URL', 'type' => 'text'],

            // Hikayemiz
            ['name' => 'story_title', 'label' => 'Hikaye Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Hikayemiz'],
            ['name' => 'story_content', 'label' => 'Hikaye İçeriği', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'story_image', 'label' => 'Hikaye Görseli', 'type' => 'file'],
            ['name' => 'founded_year', 'label' => 'Kuruluş Yılı', 'type' => 'text', 'default' => '2015'],

            // Değerlerimiz
            ['name' => 'values_title', 'label' => 'Değerler Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Değerlerimiz'],
            [
                'name' => 'values',
                'label' => 'Değerler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'value_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-heart'],
                    ['name' => 'value_title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'value_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],

            // İstatistikler
            ['name' => 'stats_title', 'label' => 'İstatistik Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Rakamlarla Biz'],
            [
                'name' => 'statistics',
                'label' => 'İstatistikler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'stat_number', 'label' => 'Sayı', 'type' => 'text'],
                    ['name' => 'stat_suffix', 'label' => 'Ek (+, %, vb)', 'type' => 'text'],
                    ['name' => 'stat_label', 'label' => 'Etiket', 'type' => 'text', 'translatable' => true],
                    ['name' => 'stat_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-chart-line'],
                ]
            ],

            // Ekip
            ['name' => 'team_title', 'label' => 'Ekip Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Ekibimiz'],
            ['name' => 'team_subtitle', 'label' => 'Ekip Alt Başlığı', 'type' => 'text', 'translatable' => true],
            [
                'name' => 'team_members',
                'label' => 'Ekip Üyeleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'member_name', 'label' => 'İsim', 'type' => 'text', 'translatable' => true],
                    ['name' => 'member_position', 'label' => 'Pozisyon', 'type' => 'text', 'translatable' => true],
                    ['name' => 'member_photo', 'label' => 'Fotoğraf', 'type' => 'file'],
                    ['name' => 'member_bio', 'label' => 'Bio', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'member_linkedin', 'label' => 'LinkedIn', 'type' => 'text'],
                    ['name' => 'member_twitter', 'label' => 'Twitter', 'type' => 'text'],
                    ['name' => 'member_instagram', 'label' => 'Instagram', 'type' => 'text'],
                ]
            ],

            // Sertifikalar & Ödüller
            ['name' => 'awards_title', 'label' => 'Ödüller Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Ödüller & Sertifikalar'],
            [
                'name' => 'awards',
                'label' => 'Ödüller',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'award_name', 'label' => 'Ödül Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'award_organization', 'label' => 'Veren Kurum', 'type' => 'text', 'translatable' => true],
                    ['name' => 'award_year', 'label' => 'Yıl', 'type' => 'text'],
                    ['name' => 'award_image', 'label' => 'Görsel/Logo', 'type' => 'file'],
                    ['name' => 'award_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],

            // Kilometre Taşları (Timeline)
            ['name' => 'timeline_title', 'label' => 'Tarihçe Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Yolculuğumuz'],
            [
                'name' => 'milestones',
                'label' => 'Kilometre Taşları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'milestone_year', 'label' => 'Yıl', 'type' => 'text'],
                    ['name' => 'milestone_title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'milestone_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'milestone_icon', 'label' => 'İkon', 'type' => 'text', 'default' => 'fas fa-flag'],
                    ['name' => 'milestone_image', 'label' => 'Görsel', 'type' => 'file'],
                ]
            ],

            // CTA
            ['name' => 'cta_title', 'label' => 'CTA Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Birlikte Çalışmaya Hazır mısınız?'],
            ['name' => 'cta_description', 'label' => 'CTA Açıklaması', 'type' => 'text', 'translatable' => true],
            ['name' => 'cta_button_text', 'label' => 'CTA Buton Metni', 'type' => 'text', 'translatable' => true, 'default' => 'İletişime Geçin'],
            ['name' => 'cta_button_url', 'label' => 'CTA Buton URL', 'type' => 'text', 'default' => '/contact'],
        ],
    ],

    'contact-us-comprehensive' => [
        'name' => 'İletişim - Kapsamlı Sayfa',
        'view' => 'frontend.sections.contact-us-comprehensive',
        'data_handler' => null,
        'fields' => [
            // Bölüm Başlıkları
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'İletişim'],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Bize Ulaşın'],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true, 'default' => 'Dijital çözümleriniz için uzman ekibimizle hemen irtibata geçin.'],

            // Form Alanları
            ['name' => 'form_title', 'label' => 'Form Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Teklif Talep Formu'],
            ['name' => 'form_action', 'label' => 'Form Action URL', 'type' => 'text', 'default' => '/submit-contact-form'],
            ['name' => 'show_map', 'label' => 'Haritayı Göster', 'type' => 'checkbox', 'default' => '1'],

            // Bilgi Kutuları (Repeater: contact-info-boxes'dan türetildi)
            [
                'name' => 'info_boxes',
                'label' => 'İletişim Bilgi Kutuları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'icon', 'label' => 'İkon (Font Awesome class)', 'type' => 'text', 'default' => 'fas fa-map-marker-alt'],
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'content', 'label' => 'İçerik (Adres, Tel No, E-posta)', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'link_text', 'label' => 'Link Metni (Opsiyonel)', 'type' => 'text', 'translatable' => true],
                    ['name' => 'link_url', 'label' => 'Link URL (Opsiyonel)', 'type' => 'text'],
                ]
            ],

            // Harita Ayarları (google-map-section'dan türetildi)
            ['name' => 'map_embed_url', 'label' => 'Google Maps Embed URL', 'type' => 'text', 'default' => 'https://www.google.com/maps/embed?pb=...!Next+Medya!'],
            ['name' => 'map_height', 'label' => 'Harita Yüksekliği (px)', 'type' => 'number', 'default' => '500'],
        ],
    ],
    'generic-policy-page' => [
        'name' => 'Jenerik Politika/Metin Sayfası',
        'view' => 'frontend.sections._generic-policy-page',
        'data_handler' => null,
        'fields' => [
            // Temel Başlıklar
            ['name' => 'page_title', 'label' => 'Sayfa Başlığı', 'type' => 'text', 'translatable' => true, 'default' => 'Gizlilik Politikası'],
            ['name' => 'page_subtitle', 'label' => 'Alt Başlık/Giriş', 'type' => 'text', 'translatable' => true, 'default' => 'Son Güncelleme: 1 Ocak 2025'],

            // İçerik Yapısı (Ana Repeater)
            [
                'name' => 'content_sections',
                'label' => 'İçerik Bölümleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'section_title', 'label' => 'Bölüm Başlığı (H2)', 'type' => 'text', 'translatable' => true],
                    ['name' => 'section_content', 'label' => 'Bölüm Metni (Quill Editor)', 'type' => 'textarea', 'translatable' => true],

                    // Alt Başlıklar (İç İçe Repeater)
                    [
                        'name' => 'sub_sections',
                        'label' => 'Alt Bölümler (H3)',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'sub_title', 'label' => 'Alt Başlık (H3)', 'type' => 'text', 'translatable' => true],
                            ['name' => 'sub_content', 'label' => 'Alt Bölüm Metni (Quill Editor)', 'type' => 'textarea', 'translatable' => true],
                        ]
                    ]
                ]
            ],

            // Ek Ayarlar
            ['name' => 'show_table_of_contents', 'label' => 'İçindekiler Tablosu Göster', 'type' => 'checkbox', 'default' => '1'],
            ['name' => 'background_style', 'label' => 'Arkaplan Stili', 'type' => 'select', 'options' => [
                'light' => 'Açık (Beyaz)',
                'dark' => 'Koyu (Koyu Gri)',
                'clean' => 'Şeffaf/Temiz'
            ], 'default' => 'light'],
        ],
    ],
];

