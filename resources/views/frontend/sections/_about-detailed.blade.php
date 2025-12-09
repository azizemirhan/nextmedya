<section class="gap no-top about-style-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-data-left">
                    <figure>
                        {{-- Resim content'te varsa onu, yoksa placeholder göster --}}
                        <img src="{{ isset($content['image_one']) ? asset($content['image_one']) : 'https://placehold.co/370x500' }}" alt="About One">
                    </figure>
                    <figure class="about-image">
                        <img src="{{ isset($content['image_two']) ? asset($content['image_two']) : 'https://placehold.co/265x325' }}" alt="About Two">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-data-right">
                    {{-- Admin panelinden gelen çok dilli veriyi göster --}}
                    <span>{{ $content['small_title'] ?? 'Welcome to Our Company' }}</span>
                    <h2>{{ $content['main_title'] ?? 'Constro Provides a full range of services' }}</h2>
                    <div class="about-info">
                        <p>{{ $content['content'] ?? 'Default content text...' }}</p>
                        <figure>
                            <img src="{{ isset($content['signature_image']) ? asset($content['signature_image']) : '/site/assets/images/signature.png' }}" alt="Signature">
                        </figure>
                        <h3>{{ $content['signature_name'] ?? 'Walimes Jonnie' }}</h3>
                        <h4>{{ $content['signature_title'] ?? 'Director of Constro Company' }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
