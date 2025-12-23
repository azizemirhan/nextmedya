@php
    $smallTitle = data_get($content, 'small_title.' . app()->getLocale(), 'Bize Ulaşın');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'Bir Mesajınız mı Var?');
@endphp

<section class="gap contact-form-section">
    <div class="container">
        <div class="heading-style-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="data">
                            <span>{{ $smallTitle }}</span>
                            <h2>{{ $mainTitle }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-style">


                    <form id="contactForm" action="{{ route('frontend.contact.submit') }}" method="POST"
                          class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="name" placeholder="Adınız Soyadınız *" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="E-posta Adresiniz *" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="phone" placeholder="Telefon Numaranız">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="subject" placeholder="Konu">
                            </div>
                            <div class="col-lg-12">
                                <textarea name="message" placeholder="Mesajınız... *" required></textarea>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn-style"><span>Mesajı Gönder</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
