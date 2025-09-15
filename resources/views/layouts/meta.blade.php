<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>@yield('meta_title', 'Next Medya ®| 20 Yıllık Deneyimle Web Tasarım, Yazılım ve SEO Ajansı')</title>
<meta name="description" content="@yield('meta_description', 'Next Medya, 20 yılı aşkın deneyimiyle web tasarım, özel yazılım geliştirme ve SEO hizmetlerinde sektörün öncüsüdür. Profesyonel dijital çözümlerle markanızı dijitalde öne çıkarıyoruz.')">
<meta name="keywords" content="@yield('meta_keywords', 'anahtar, kelimeler')">
<meta name="googlebot" content="index, follow">
<meta name="robots" content="index, follow">
<meta name="abstract" content="@yield('abstract', 'Abstract')">
<meta name="author" content="Next Medya ve Yazılım Ajansı">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="p:domain_verify" content="9b991e6044a789fb3ddfe21fd8c1e437" />
<meta name="google-site-verification" content="-2MdMtSvkmiU7ZJ3ChGBPqW_S_M-URiM3GaX_7PebJ0" />
<meta name="yandex-verification" content="adfa618551edfe3b" />
<meta property="og:locale" content="tr_TR" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Next Medya" />
<meta property="og:title" content="@yield('og_title', 'Başlık')" />
<meta property="og:description" content="@yield('og_description', 'Açıklama')" />
<meta property="og:image" content="@yield('og_image')" />
<meta property="og:image:secure_url" content="@yield('og_secure_url', 'Güvenli Resim')" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="@yield('og_image_alt')" />
<meta property="og:url" content="{{ url()->current() }}">
<link rel="canonical" href="{{ url()->current() }}" />

<script type="text/javascript">
    (function(m, e, t, r, i, k, a) {
        m[i] = m[i] || function() {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        for (var j = 0; j < document.scripts.length; j++) {
            if (document.scripts[j].src === r) {
                return;
            }
        }
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
            k, a)
    })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=103657257', 'ym');

    ym(103657257, 'init', {
        ssr: true,
        webvisor: true,
        clickmap: true,
        ecommerce: "dataLayer",
        accurateTrackBounce: true,
        trackLinks: true
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/103657257" style="position:absolute; left:-9999px;" alt="" />
    </div>
</noscript>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16607476877"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    /* Eğer GA4’ünüz de varsa, hem GA4 hem Ads config’i birlikte tutun: */
    // gtag('config', 'G-XXXXXXXX');  // (varsa GA4 ölçüm ID'niz)
    gtag('config', 'AW-16607476877'); // Bu maildeki Ads Conversion ID
</script>
<script>
    gtag('event', 'conversion', {
        'send_to': 'AW-16607476877/AKvbCP7Q5cEaEI35h-89'
    });
</script>
@php
    $structuredFolder = $structuredFolder ?? 'anasayfa';
    $structuredFile = $structuredFile ?? 'site.json';

    $filePath = public_path("structured-data/{$structuredFolder}/{$structuredFile}");
    $structuredData = file_exists($filePath) ? file_get_contents($filePath) : null;
@endphp
@if ($structuredData)
    <script type="application/ld+json">{!! $structuredData !!}</script>
@endif
<script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1106185197829879');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1106185197829879&ev=PageView&noscript=1" /></noscript>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-S2HP4XP0Z1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-S2HP4XP0Z1');
</script>
<!-- Google tag (gtag.js) event - delayed navigation helper -->
<script>
  // Helper function to delay opening a URL until a gtag event is sent.
  // Call it in response to an action that should navigate to a URL.
  function gtagSendEvent(url) {
    var callback = function () {
      if (typeof url === 'string') {
        window.location = url;
      }
    };
    gtag('event', 'ads_conversion_Contact_1', {
      'event_callback': callback,
      'event_timeout': 2000,
      // <event_parameters>
    });
    return false;
  }
</script>
<!-- Event snippet for Sayfa görüntüleme conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-16607476877/AKvbCP7Q5cEaEI35h-89'});
</script>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('avatar.png') }}">
<link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('site/assets/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('site/assets/css/swiper-bundle.css') }}">
<link rel="stylesheet" href="{{ asset('site/assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('site/assets/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('site/assets/css/font-awesome-pro.css') }}">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('site/assets/css/spacing.css') }}">
<link rel="stylesheet" href="{{ asset('site/assets/css/custom-animation.css') }}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('site/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('additional_main.css') }}">
