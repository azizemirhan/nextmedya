@if ($errors->any())
    <div class="alert alert-danger">
        <h5 class="alert-heading">Formda Hatalar Bulundu!</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    {{-- Sol Taraf (Ana İçerikler) --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Ana Hizmet Bilgileri</h5></div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                    @foreach($activeLanguages as $code => $language)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    data-bs-toggle="tab"
                                    data-bs-target="#form-{{ $code }}"
                                    type="button">
                                {{ strtoupper($code) }} - {{ $language['native'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mt-3">
                    @foreach($activeLanguages as $code => $language)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="form-{{ $code }}" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label">Hizmet Başlığı ({{ strtoupper($code) }})</label>
                                <input type="text" class="form-control" name="title[{{ $code }}]"
                                       value="{{ old('title.'.$code, $service->getTranslation('title', $code)) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kısa Özet ({{ strtoupper($code) }})</label>
                                <textarea class="form-control" name="summary[{{ $code }}]" rows="3">{{ old('summary.'.$code, $service->getTranslation('summary', $code)) }}</textarea>
                            </div>

                            {{-- QUILL EDITOR İÇİN GÜNCELLENDİ --}}
                            <div class="mb-3">
                                <label class="form-label">Ana İçerik (Service Details) ({{ strtoupper($code) }})</label>
                                <div class="editor-container" style="height: 250px;">{!! old('content.'.$code, $service->getTranslation('content', $code)) !!}</div>
                                <input type="hidden" name="content[{{ $code }}]" class="editor-input">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Beklentiler İçeriği (Highest Expectations) ({{ strtoupper($code) }})</label>
                                <div class="editor-container" style="height: 150px;">{!! old('expectations_content.'.$code, $service->getTranslation('expectations_content', $code)) !!}</div>
                                <input type="hidden" name="expectations_content[{{ $code }}]" class="editor-input">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header"><h5 class="card-title mb-0">Faydalar ve Destek Öğeleri</h5></div>
            <div class="card-body">
                {{-- Benefits Repeater --}}
                <div id="benefits-repeater">
                    <h6>Hizmet Faydaları (Service Benefits)</h6>
                    <div class="items">
                        @forelse(old('benefits', $service->benefits ?? []) as $index => $benefit)
                            <div class="item border p-2 mb-3" data-index="{{ $index }}">
                                <div class="row">
                                    @foreach($activeLanguages as $code => $language)
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Fayda ({{ strtoupper($code) }})</label>
                                            <input type="text" name="benefits[{{ $index }}][text][{{ $code }}]"
                                                   class="form-control" placeholder="Fayda ({{ strtoupper($code) }})"
                                                   value="{{ is_array($benefit) ? ($benefit['text'][$code] ?? '') : '' }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu Faydayı Sil</button>
                            </div>
                        @empty
                            {{-- Hiç benefit yoksa boş bir tane göster --}}
                            <div class="item border p-2 mb-3" data-index="0">
                                <div class="row">
                                    @foreach($activeLanguages as $code => $language)
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Fayda ({{ strtoupper($code) }})</label>
                                            <input type="text" name="benefits[0][text][{{ $code }}]"
                                                   class="form-control" placeholder="Fayda ({{ strtoupper($code) }})">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu Faydayı Sil</button>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn btn-success btn-sm add-item mt-2" data-repeater="benefits">Yeni Fayda Ekle</button>
                </div>
                <hr>
                {{-- Support Items Repeater --}}
                <div id="support_items-repeater">
                    <h6>Destek Öğeleri (What can we support with?)</h6>
                    <div class="items">
                        @forelse(old('support_items', $service->support_items ?? []) as $index => $item)
                            <div class="item border p-2 mb-3" data-index="{{ $index }}">
                                <div class="row">
                                    @foreach($activeLanguages as $code => $language)
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Destek Öğesi ({{ strtoupper($code) }})</label>
                                            <input type="text" name="support_items[{{ $index }}][text][{{ $code }}]"
                                                   class="form-control" placeholder="Destek Öğesi ({{ strtoupper($code) }})"
                                                   value="{{ is_array($item) ? ($item['text'][$code] ?? '') : '' }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu Destek Öğesini Sil</button>
                            </div>
                        @empty
                            {{-- Hiç support item yoksa boş bir tane göster --}}
                            <div class="item border p-2 mb-3" data-index="0">
                                <div class="row">
                                    @foreach($activeLanguages as $code => $language)
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Destek Öğesi ({{ strtoupper($code) }})</label>
                                            <input type="text" name="support_items[0][text][{{ $code }}]"
                                                   class="form-control" placeholder="Destek Öğesi ({{ strtoupper($code) }})">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu Destek Öğesini Sil</button>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn btn-success btn-sm add-item mt-2" data-repeater="support_items">
                        Yeni Destek Öğesi Ekle
                    </button>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header"><h5 class="card-title mb-0">Sıkça Sorulan Sorular</h5></div>
            <div class="card-body" id="faqs-repeater">
                <div class="items">
                    @forelse(old('faqs', $service->faqs ?? []) as $index => $faq)
                        <div class="item border p-3 mb-3" data-index="{{ $index }}">
                            <div class="row">
                                @foreach($activeLanguages as $code => $language)
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Soru ({{ strtoupper($code) }})</label>
                                        <input type="text" name="faqs[{{ $index }}][question][{{ $code }}]" class="form-control"
                                               placeholder="Soru ({{ strtoupper($code) }})" value="{{ is_array($faq) ? ($faq['question'][$code] ?? '') : '' }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mt-2">
                                @foreach($activeLanguages as $code => $language)
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Cevap ({{ strtoupper($code) }})</label>
                                        <textarea name="faqs[{{ $index }}][answer][{{ $code }}]" class="form-control"
                                                  placeholder="Cevap ({{ strtoupper($code) }})" rows="3">{{ is_array($faq) ? ($faq['answer'][$code] ?? '') : '' }}</textarea>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu SSS'yi Sil</button>
                        </div>
                    @empty
                        {{-- Hiç FAQ yoksa boş bir tane göster --}}
                        <div class="item border p-3 mb-3" data-index="0">
                            <div class="row">
                                @foreach($activeLanguages as $code => $language)
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Soru ({{ strtoupper($code) }})</label>
                                        <input type="text" name="faqs[0][question][{{ $code }}]" class="form-control"
                                               placeholder="Soru ({{ strtoupper($code) }})">
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mt-2">
                                @foreach($activeLanguages as $code => $language)
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Cevap ({{ strtoupper($code) }})</label>
                                        <textarea name="faqs[0][answer][{{ $code }}]" class="form-control"
                                                  placeholder="Cevap ({{ strtoupper($code) }})" rows="3"></textarea>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu SSS'yi Sil</button>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-success btn-sm add-item mt-2" data-repeater="faqs">Yeni SSS Ekle</button>
            </div>
        </div>
    </div>
    {{-- Sağ Taraf (Ayarlar ve Görseller) --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Yayınlama Ayarları</h5></div>
            <div class="card-body">
                <div class="mb-3"><label for="slug" class="form-label">URL Uzantısı (Slug)</label><input type="text"
                                                                                                         class="form-control"
                                                                                                         id="slug"
                                                                                                         name="slug"
                                                                                                         value="{{ old('slug', $service->slug ?? '') }}"
                                                                                                         ></div>
                <div class="mb-3"><label for="status" class="form-label">Durum</label><select name="is_active"
                                                                                              id="status"
                                                                                              class="form-select">
                        <option value="1" @selected(old('is_active', $service->is_active ?? 1) == 1)>Aktif</option>
                        <option value="0" @selected(old('is_active', $service->is_active ?? 1) == 0)>Pasif</option>
                    </select></div>
                <div class="mb-3"><label for="order" class="form-label">Sıralama</label><input type="number"
                                                                                               class="form-control"
                                                                                               id="order" name="order"
                                                                                               value="{{ old('order', $service->order ?? 0) }}"
                                                                                               ></div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header"><h5 class="card-title mb-0">Kapak Görseli</h5></div>
            <div class="card-body">
                <input type="file" name="cover_image" class="form-control mb-2" accept="image/*" id="cover_image_input">
                {{-- ÖNİZLEME ALANI EKLENDİ --}}
                <div id="cover_image_preview" class="mt-2">
                    @if($service->cover_image)
                        <img src="{{ asset($service->cover_image) }}" alt="Mevcut Görsel" class="img-thumbnail"
                             width="200">
                    @endif
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header"><h5 class="card-title mb-0">Galeri Görselleri</h5></div>
            <div class="card-body">
                <input type="file" name="gallery_images[]" class="form-control mb-2" accept="image/*" multiple
                       id="gallery_images_input">
                <small class="text-muted">Birden çok resim seçebilirsiniz. Mevcut resimler silinmez, yenileri
                    eklenir.</small>

                {{-- YENİ VE MEVCUT RESİMLER İÇİN ÖNİZLEME ALANI --}}
                <div id="gallery_preview_container" class="mt-3 d-flex flex-wrap">
                    @if(!empty($service->gallery_images))
                        @foreach($service->gallery_images as $image)
                            {{-- Her bir mevcut resim için özel bir sarmalayıcı ve silme butonu --}}
                            <div class="gallery-item-wrapper me-2 mb-2">
                                <img src="{{ asset($image) }}" class="img-thumbnail">
                                <button type="button" class="btn btn-danger btn-sm delete-gallery-item"
                                        data-path="{{ $image }}">X
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div id="deleted_gallery_images"></div>
            </div>
        </div>

    </div>
    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">İptal</a>
    </div>
</div>

{{-- Aktif dillerin JavaScript için JSON formatında gönderilmesi --}}
<script>
    window.activeLanguages = @json(collect($activeLanguages)->keys()->toArray());
</script>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const UPLOAD_URL = "{{ route('admin.services.editor.uploadImage') }}";
            const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const activeLanguages = window.activeLanguages || ['tr', 'en'];

            const titleInput = document.querySelector('input[name="title[tr]"]');
            const slugInput = document.querySelector('#slug');

            if (titleInput && slugInput) {
                titleInput.addEventListener('input', function() {
                    if (!slugInput.value || slugInput.value === '') {
                        const slug = this.value
                            .toLowerCase()
                            .replace(/[^a-z0-9\s-]/g, '') // Özel karakterleri kaldır
                            .replace(/\s+/g, '-') // Boşlukları tire ile değiştir
                            .replace(/-+/g, '-') // Birden fazla tireyi tek tire yap
                            .trim('-'); // Başta ve sonta tire varsa kaldır

                        slugInput.value = slug;
                    }
                });
            }

            const quillToolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{'header': 1}, {'header': 2}],
                [{'list': 'ordered'}, {'list': 'bullet'}],
                [{'script': 'sub'}, {'script': 'super'}],
                [{'indent': '-1'}, {'indent': '+1'}],
                [{'direction': 'rtl'}],
                [{'size': ['small', false, 'large', 'huge']}],
                [{'header': [1, 2, 3, 4, 5, 6, false]}],
                [{'color': []}, {'background': []}],
                [{'font': []}],
                [{'align': []}],
                ['link', 'image', 'video'],
                ['clean']
            ];

            function imageHandler() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = async () => {
                    const file = input.files[0];
                    if (/^image\//.test(file.type)) {
                        const formData = new FormData();
                        formData.append('image', file);

                        try {
                            const response = await fetch(UPLOAD_URL, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': CSRF_TOKEN
                                }
                            });
                            const result = await response.json();

                            if (result.url) {
                                const range = this.quill.getSelection(true);
                                this.quill.insertEmbed(range.index, 'image', result.url);
                                this.quill.setSelection(range.index + 1);
                            } else {
                                console.error('Sunucudan URL alınamadı:', result);
                            }
                        } catch (error) {
                            console.error('Resim yükleme hatası:', error);
                        }
                    } else {
                        console.warn('Lütfen bir resim dosyası seçin.');
                    }
                };
            }

            document.querySelectorAll('.editor-container').forEach(container => {
                const quill = new Quill(container, {
                    modules: {
                        toolbar: {
                            container: quillToolbarOptions,
                            handlers: {
                                'image': imageHandler
                            }
                        }
                    },
                    theme: 'snow'
                });

                const input = container.nextElementSibling;
                quill.on('text-change', function () {
                    input.value = quill.root.innerHTML;
                });
                container.closest('form').addEventListener('submit', function () {
                    input.value = quill.root.innerHTML;
                });
            });

            // ===================================================================
            // RESİM ÖNİZLEME
            // ===================================================================
            const coverInput = document.getElementById('cover_image_input');
            const coverPreview = document.getElementById('cover_image_preview');
            if (coverInput) {
                coverInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            coverPreview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" width="200">`;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            const galleryInput = document.getElementById('gallery_images_input');
            const galleryPreviewContainer = document.getElementById('gallery_preview_container');
            if (galleryInput) {
                galleryInput.addEventListener('change', function(event) {
                    if (event.target.files) {
                        Array.from(event.target.files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const wrapper = document.createElement('div');
                                wrapper.classList.add('gallery-item-wrapper', 'me-2', 'mb-2');
                                wrapper.innerHTML = `<img src="${e.target.result}" class="img-thumbnail">`;
                                galleryPreviewContainer.appendChild(wrapper);
                            }
                            reader.readAsDataURL(file);
                        });
                    }
                });
            }

            document.querySelector('body').addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-gallery-item')) {
                    const wrapper = e.target.closest('.gallery-item-wrapper');
                    const imagePath = e.target.dataset.path;

                    const hiddenInputContainer = document.getElementById('deleted_gallery_images');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'delete_gallery_images[]';
                    input.value = imagePath;
                    hiddenInputContainer.appendChild(input);

                    wrapper.style.display = 'none';
                }
            });

            // ===================================================================
            // REPEATER FONKSİYONLARI
            // ===================================================================

            // Yeni öğe ekleme fonksiyonu
            function addNewItem(repeaterId) {
                console.log('addNewItem called with:', repeaterId); // Debug için

                // ID'leri normalize et (tire yerine underscore)
                const normalizedId = repeaterId.replace('-', '_');
                const container = document.querySelector(`#${normalizedId}-repeater .items`);

                if (!container) {
                    console.error('Container bulunamadı:', `#${normalizedId}-repeater .items`);
                    return;
                }

                const existingItems = container.querySelectorAll('.item');
                const newIndex = existingItems.length;

                let template = '';

                if (normalizedId === 'benefits' || normalizedId === 'support_items') {
                    const itemName = normalizedId === 'benefits' ? 'Fayda' : 'Destek Öğesi';
                    const deleteText = normalizedId === 'benefits' ? 'Faydayı' : 'Destek Öğesini';

                    template = `
                        <div class="item border p-2 mb-3" data-index="${newIndex}">
                            <div class="row">
                                ${activeLanguages.map(code => `
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">${itemName} (${code.toUpperCase()})</label>
                                        <input type="text" name="${normalizedId}[${newIndex}][text][${code}]"
                                               class="form-control" placeholder="${itemName} (${code.toUpperCase()})">
                                    </div>
                                `).join('')}
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu ${deleteText} Sil</button>
                        </div>
                    `;
                } else if (normalizedId === 'faqs') {
                    template = `
                        <div class="item border p-3 mb-3" data-index="${newIndex}">
                            <div class="row">
                                ${activeLanguages.map(code => `
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Soru (${code.toUpperCase()})</label>
                                        <input type="text" name="faqs[${newIndex}][question][${code}]" class="form-control"
                                               placeholder="Soru (${code.toUpperCase()})">
                                    </div>
                                `).join('')}
                            </div>
                            <div class="row mt-2">
                                ${activeLanguages.map(code => `
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Cevap (${code.toUpperCase()})</label>
                                        <textarea name="faqs[${newIndex}][answer][${code}]" class="form-control"
                                                  placeholder="Cevap (${code.toUpperCase()})" rows="3"></textarea>
                                    </div>
                                `).join('')}
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-item mt-2">Bu SSS'yi Sil</button>
                        </div>
                    `;
                }

                if (template) {
                    container.insertAdjacentHTML('beforeend', template);
                    console.log('Template eklendi:', normalizedId);
                } else {
                    console.error('Template oluşturulamadı!');
                }
            }

            // Event delegation ile button click'leri handle et
            document.addEventListener('click', function(e) {
                // Yeni öğe ekleme
                if (e.target.classList.contains('add-item')) {
                    e.preventDefault();
                    const repeaterId = e.target.getAttribute('data-repeater');
                    console.log('Add item clicked for repeater:', repeaterId); // Debug için
                    if (repeaterId) {
                        addNewItem(repeaterId);
                    } else {
                        console.error('Repeater ID bulunamadı!');
                    }
                }

                // Öğe silme
                if (e.target.classList.contains('remove-item')) {
                    e.preventDefault();
                    e.target.closest('.item').remove();
                }
            });
        });
    </script>
@endpush
@push('styles')
    <style>
        .gallery-item-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
        }
        .gallery-item-wrapper .img-thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .gallery-item-wrapper .delete-gallery-item {
            position: absolute;
            top: -5px;
            right: -5px;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            line-height: 1;
            font-weight: bold;
        }

        .item {
            background-color: #f8f9fa;
        }

        .nav-tabs .nav-link {
            font-size: 0.9rem;
        }
    </style>
@endpush
