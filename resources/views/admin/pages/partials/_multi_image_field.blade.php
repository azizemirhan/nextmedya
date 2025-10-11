@php
    $fieldName = $field['name'];
    $existingImages = old($fieldName, $section->content[$fieldName] ?? []);
    // Eğer dizi değilse diziye çevir
    if (!is_array($existingImages)) {
        $existingImages = [];
    }
@endphp

<div class="mb-3 field-wrapper multi-image-field" data-field-name="{{ $fieldName }}">
    <label class="form-label fw-bold">{{ $field['label'] }}</label>

    {{-- Mevcut Resimler --}}
    <div class="sortable-images-container row g-2 mb-3" id="sortable-{{ $fieldName }}">
        @if(!empty($existingImages) && is_array($existingImages))
            @foreach($existingImages as $index => $imagePath)
                @if(!empty($imagePath))
                    <div class="col-md-3 sortable-image-item" data-index="{{ $index }}">
                        <div class="card">
                            <div class="card-body p-2 text-center">
                                <i class="bi bi-grip-vertical drag-handle mb-2" style="cursor: move;"></i>
                                <img src="{{ asset($imagePath) }}" class="img-fluid rounded mb-2"
                                     style="max-height: 100px; object-fit: cover;">
                                <input type="hidden" name="temp_{{ $fieldName }}[{{ $index }}]" value="{{ $imagePath }}"
                                       data-name="{{ $fieldName }}">
                                <button type="button" class="btn btn-sm btn-danger w-100 remove-image">
                                    <i class="bi bi-trash"></i> Kaldır
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    {{-- Yeni Resim Yükleme --}}
    <div class="upload-area">
        <input type="file"
               class="form-control multi-image-input"
               data-field-name="{{ $fieldName }}"
               multiple
               accept="image/*">
        <small class="text-muted">Birden fazla resim seçebilirsiniz. Sürükle-bırak ile sıralayabilirsiniz.</small>
    </div>
</div>

<style>
    .sortable-image-item {
        transition: all 0.3s ease;
    }

    .sortable-image-item.ui-sortable-helper {
        opacity: 0.8;
        transform: scale(1.05);
    }

    .sortable-placeholder {
        border: 2px dashed #007bff;
        background-color: #f0f8ff;
        visibility: visible !important;
        height: 150px;
    }

    .drag-handle {
        cursor: move;
        font-size: 1.2rem;
        color: #6c757d;
    }

    .upload-area {
        border: 2px dashed #dee2e6;
        padding: 1rem;
        border-radius: 0.375rem;
        background-color: #f8f9fa;
    }

    .multi-image-field img {
        max-height: 100px;
        width: 100%;
        object-fit: cover;
    }
</style>
