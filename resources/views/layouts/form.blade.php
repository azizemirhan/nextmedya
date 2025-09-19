<div id="myModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="custom-modal-close" onclick="closeModal()"><i class="ri-close-line"></i></span>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3 justify-content-center">
                        <h2 id="heading">Bilgi Talep Formu</h2>
                        <p>Talebinizi iletmek için tüm alanları doldurun</p>
                        <span style="color: red; font-size: 30px">veya</span>
                        <a href="tel:+905326437544" class="btn btn-primary mt-20" id="contact-button">Bizimle Direkt
                            İletişime Geçebilirsiniz</a>
                        <form id="msform" method="POST" action="{{ route('support.request.store') }}">
                            @csrf
                            <!-- Progressbar -->
                            <ul id="progressbar" class="justify-content-center">
                                <li class="active" id="account"><strong>İletişim</strong></li>
                                <li id="personal"><strong>Talep Bilgileri</strong></li>
                                <li id="confirm"><strong>Bitiş</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <br>
                            <!-- Adım 1 -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">İletişim Bilgileriniz</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Adım 1 - 3</h2>
                                        </div>
                                    </div>
                                    <label class="fieldlabels">Ad Soyad: *</label>
                                    <input type="text" name="fullname" placeholder="Adınız ve Soyadınız" />
                                    <label class="fieldlabels">E-posta: *</label>
                                    <input type="email" name="email" placeholder="ornek@mail.com" />
                                    <label class="fieldlabels">Telefon: *</label>
                                    <input type="text" name="phone" placeholder="+90 5xx xxx xx xx" />
                                    <label class="fieldlabels">Firma Adı (Varsa):</label>
                                    <input type="text" name="company" placeholder="Firma Adınız" />
                                </div>
                                <input type="button" name="next" class="next action-button" value="İleri" />
                            </fieldset>
                            <!-- Adım 2 -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Talep Detayları</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Adım 2 - 3</h2>
                                        </div>
                                    </div>
                                    <select name="service_type">
                                        <option value="">Seçiniz</option>
                                        <option>Kurumsal Web Tasarım</option>
                                        <option>E-Ticaret Sitesi Tasarımı</option>
                                        <option>Seo Danışmanlığı</option>
                                        <option>Bakım & Teknik Destek</option>
                                        <option>Diğer</option>
                                    </select>
                                    <br>
                                    <label class="fieldlabels">Talep Başlığı: *</label>
                                    <input type="text" name="request_title" placeholder="Kısa ve net bir başlık" />
                                    <label class="fieldlabels">Talep Açıklaması: *</label>
                                    <textarea name="description" placeholder="Talebinizi detaylıca yazın"></textarea>
                                </div>
                                <button type="submit" class="next action-button">Gönder</button>
                                <input type="button" name="previous" class="previous action-button-previous"
                                    value="Geri" />
                            </fieldset>
                            <!-- Adım 3 -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Talebiniz Alındı</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Adım 3 - 3</h2>
                                        </div>
                                    </div>
                                    <br><br>
                                    <h2 class="purple-text text-center"><strong>TEŞEKKÜRLER</strong></h2>
                                    <br>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="purple-text text-center">Talebiniz başarıyla tarafımıza
                                                iletildi.</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
