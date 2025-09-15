<div class="col-xxl-4 col-lg-4">
    <div class="profile__tab mr-40">
        <nav>
            <div class="nav nav-tabs tp-tab-menu flex-column" id="profile-tab" role="tablist">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><span><i
                            class="fa-regular fa-user-pen"></i></span>Müşteri Paneli</a>
                <a href="{{ route('admin.blog.index') }}" class="nav-link"><span><i
                            class="fa-solid fa-blog"></i></span>Bloglar</a>
                <a href="{{ route('categories.create') }}" class="nav-link"><span><i
                            class="fa-solid fa-list"></i></span>Kategori Ekle</a>
                <a href="{{ route('profile.getchange-password') }}" class="nav-link"><span><i
                            class="fa-solid fa-key"></i></span>Şifre Değiştir</a>
                <a href="{{ route('profile.edit') }}" class="nav-link"><span><i
                            class="fa-solid fa-gear"></i></span>Ayarlar</a>
            </div>
        </nav>
    </div>
</div>
