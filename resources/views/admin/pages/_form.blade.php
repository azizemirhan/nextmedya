@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Sayfa Temel Bilgileri</h5>
    </div>
    <div class="card-body">
        {{--
            Eğer sayfa başlığını ÇOK DİLLİ yapmayı seçtiyseniz (Çözüm 2),
            bu bölümü kullanın.
        --}}
        <div class="mb-3">
            <label class="form-label">Sayfa Başlığı <span class="text-danger">*</span></label>
            <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-title-tr" type="button">TR</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-title-en" type="button">EN</button></li>
            </ul>
            <div class="tab-content mt-2">
                <div class="tab-pane fade show active" id="form-title-tr" role="tabpanel">
                    <input type="text" name="title[tr]" class="form-control" value="{{ old('title.tr', $page->getTranslation('title', 'tr') ?? '') }}" required>
                </div>
                <div class="tab-pane fade" id="form-title-en" role="tabpanel">
                    <input type="text" name="title[en]" class="form-control" value="{{ old('title.en', $page->getTranslation('title', 'en') ?? '') }}">
                </div>
            </div>
        </div>

        {{--
            Eğer sayfa başlığını TEK DİLLİ yapmayı seçtiyseniz (Çözüm 1),
            yukarıdaki bölümü silip bu bölümü kullanın.

        <div class="mb-3">
            <label for="title" class="form-label">Sayfa Başlığı <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}" required>
        </div>
        --}}

        <div class="mb-3">
            <label for="slug" class="form-label">URL Uzantısı (Slug) <span class="text-danger">*</span></label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
            <small class="text-muted">Örn: hakkimizda, kurumsal, iletisim</small>
        </div>
    </div>
</div>
