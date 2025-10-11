<?php

return [
    'main-slider' => [
        'name' => 'Ana Slider',
        'view' => 'frontend.sections._main-slider',
        'fields' => [
            [
                'name' => 'slides',
                'label' => 'Slaytlar',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'label', 'label' => 'Etiket', 'type' => 'text', 'translatable' => true],
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'highlight_text', 'label' => 'Vurgulanan Metin', 'type' => 'text', 'translatable' => true],
                    ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'primary_button_text', 'label' => 'Birincil Buton Metni', 'type' => 'text', 'translatable' => true],
                    ['name' => 'primary_button_link', 'label' => 'Birincil Buton Linki', 'type' => 'text'],
                    ['name' => 'secondary_button_text', 'label' => 'İkincil Buton Metni', 'type' => 'text', 'translatable' => true],
                    ['name' => 'secondary_button_link', 'label' => 'İkincil Buton Linki', 'type' => 'text'],
                    ['name' => 'image', 'label' => 'Görsel', 'type' => 'file'],
                    ['name' => 'project_stat', 'label' => 'Proje Sayısı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'customer_stat', 'label' => 'Müşteri Sayısı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'award_stat', 'label' => 'Ödül Sayısı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'customer_experience_stat', 'label' => 'Müşteri Deneyimi', 'type' => 'text', 'translatable' => true],
                    ['name' => 'point_stat', 'label' => 'Ortalama Puan', 'type' => 'text', 'translatable' => true],
                ],
            ]
        ],
    ],
    'animation' => [
        'name' => 'Animasyon',
        'view' => 'frontend.sections._animations',
        'fields' => [],
    ],
    'service-cards-news' => [
        'name' => 'Hizmet Kartları ve Referanslar',
        'view' => 'frontend.sections._service-cards-news',
        'fields' => [
            [
                'name' => 'title',
                'label' => 'Ana Başlık (örn: Hizmetlerimiz)',
                'type' => 'text',
                'translatable' => true
            ],
            [
                'name' => 'subtitle',
                'label' => 'Alt Başlık / Açıklama',
                'type' => 'textarea',
                'translatable' => true
            ],
            [
                'name' => 'services',
                'label' => 'Hizmet Kartları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'icon_svg',
                        'label' => 'Kart İkonu (SVG Kodu)',
                        'type' => 'text'
                    ],
                    [
                        'name' => 'card_title',
                        'label' => 'Kart Başlığı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'card_description',
                        'label' => 'Kart Açıklaması',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                ]
            ],
            [
                'name' => 'logos',
                'label' => 'Referans Logoları',
                'type' => 'multi_image', // YENİ TİP
            ],
        ],
    ],
    'pricing-table' => [
        'name' => 'Paketler',
        'view' => 'frontend.sections._pricing-table',
        'fields' => [
            ['name' => 'most_popular_badge', 'label' => 'En Popüler Rozet Metni', 'type' => 'text', 'translatable' => true],
            [
                'name' => 'packages',
                'label' => 'Fiyat Paketleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'plan_name', 'label' => 'Paket Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'is_popular', 'label' => 'Öne Çıkan Paket', 'type' => 'select', 'options' => ['0' => 'Hayır', '1' => 'Evet']],
                    ['name' => 'currency', 'label' => 'Para Birimi', 'type' => 'text'],
                    ['name' => 'monthly_price', 'label' => 'Fiyat', 'type' => 'text'],
                    ['name' => 'payment_period', 'label' => 'Ödeme Periyodu', 'type' => 'text', 'translatable' => true],
                    ['name' => 'payment_info', 'label' => 'Ödeme Bilgisi', 'type' => 'text', 'translatable' => true],
                    ['name' => 'discount_info_1', 'label' => 'İndirim Bilgisi 1', 'type' => 'text', 'translatable' => true],
                    ['name' => 'discount_info_2', 'label' => 'İndirim Bilgisi 2', 'type' => 'text', 'translatable' => true],
                    [
                        'name' => 'features',
                        'label' => 'Özellikler',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'feature_text', 'label' => 'Özellik', 'type' => 'text', 'translatable' => true],
                            ['name' => 'is_new', 'label' => 'Yeni Özellik mi?', 'type' => 'select', 'options' => ['0' => 'Hayır', '1' => 'Evet']],
                        ],
                    ],
                    ['name' => 'cta_button_text', 'label' => 'Buton Metni', 'type' => 'text', 'translatable' => true],
                    ['name' => 'cta_button_icon', 'label' => 'Buton İkonu (Emoji)', 'type' => 'text'],
                    ['name' => 'cta_button_link', 'label' => 'Buton Linki', 'type' => 'text'],
                ],
            ],
        ],
    ],
];
