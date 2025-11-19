<section class="gap no-top about-style-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-data-left">
                    <figure>
                        {{-- Resim content'te varsa onu, yoksa placeholder göster --}}
                        @if(isset($content['image_one']))
                            @optimizedImage($content['image_one'], 'About One', '')
                        @else
                            <img src="https://placehold.co/370x500" alt="About One">
                        @endif
                    </figure>
                    <figure class="about-image">
                        @if(isset($content['image_two']))
                            @optimizedImage($content['image_two'], 'About Two', '')
                        @else
                            <img src="https://placehold.co/265x325" alt="About Two">
                        @endif
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
                            @if(isset($content['signature_image']))
                                @optimizedImage($content['signature_image'], 'Signature', '')
                            @else
                                @optimizedImage('site/assets/images/signature.png', 'Signature', '')
                            @endif
                        </figure>
                        <h3>{{ $content['signature_name'] ?? 'Walimes Jonnie' }}</h3>
                        <h4>{{ $content['signature_title'] ?? 'Director of Constro Company' }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
