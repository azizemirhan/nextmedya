@php
    $mapLocation = data_get($content, 'map_location', 'New York');
    $mapZoom = data_get($content, 'map_zoom', 13);
    $mapHeight = data_get($content, 'map_height', 600);

    // Özel embed URL varsa onu kullan, yoksa otomatik oluştur
    $mapEmbedUrl = data_get($content, 'map_embed_url');

    if (empty($mapEmbedUrl)) {
        $encodedLocation = urlencode($mapLocation);
        $mapEmbedUrl = "https://maps.google.com/maps?q={$encodedLocation}&t=&z={$mapZoom}&ie=UTF8&iwloc=&output=embed";
    }
@endphp

<section class="googleMapSection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 noPadding">
                <div class="gmap" style="height: {{ $mapHeight }}px;">
                    <iframe
                            id="gmap_canvas"
                            src="{{ $mapEmbedUrl }}"
                            frameborder="0"
                            scrolling="no"
                            marginheight="0"
                            marginwidth="0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .googleMapSection {
            padding: 0;
            margin: 0;
        }

        .googleMapSection .container-fluid {
            padding: 0;
        }

        .googleMapSection .noPadding {
            padding: 0;
        }

        .gmap {
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .gmap iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .gmap {
                height: 450px !important;
            }
        }

        @media (max-width: 767px) {
            .gmap {
                height: 350px !important;
            }
        }
    </style>
@endpush