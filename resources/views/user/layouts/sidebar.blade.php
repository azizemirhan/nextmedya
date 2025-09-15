<div class="col-xxl-4 col-lg-4">
    <div class="profile__tab mr-40">
        <nav>
            <div class="nav nav-tabs tp-tab-menu flex-column" id="profile-tab" role="tablist">
                <a href="{{ route('dashboard') }}" class="nav-link"><span><i
                            class="fa-regular fa-user-pen"></i></span>Müşteri Paneli</a>
                <button class="nav-link" id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information"
                    type="button" role="tab" aria-controls="nav-information" aria-selected="false"
                    tabindex="-1"><span><i class="fa-solid fa-bell-concierge"></i></span>Hizmet Al</button>
                <button class="nav-link" id="nav-address-tab" data-bs-toggle="tab" data-bs-target="#nav-address"
                    type="button" role="tab" aria-controls="nav-address" aria-selected="false"
                    tabindex="-1"><span><i class="fa-solid fa-headset"></i></span>Destek</button>
                <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order"
                    type="button" role="tab" aria-controls="nav-order" aria-selected="false"
                    tabindex="-1"><span><i class="fa-solid fa-credit-card"></i></span>Faturalar & Ödemeler</button>
                <button class="nav-link" id="nav-notification-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-notification" type="button" role="tab" aria-controls="nav-notification"
                    aria-selected="false" tabindex="-1"><span><i class="fa-solid fa-chart-simple"></i></span>Raporlar
                    ve Analizler</button>
                <a href="{{ route('profile.getchange-password') }}" class="nav-link"><span><i
                            class="fa-solid fa-key"></i></span>Şifre Değiştir</a>

                <a href="{{ route('profile.edit') }}" class="nav-link"><span><i
                            class="fa-solid fa-gear"></i></span>Ayarlar</a>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="nav-link" id="nav-notification-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-notification" type="submit" role="tab"
                        aria-controls="nav-notification" aria-selected="false" tabindex="-1"><span><i
                                class="fa-solid fa-right-from-bracket"></i></span>Çıkış Yap
                    </button>
                </form>


            </div>
        </nav>
    </div>
</div>
