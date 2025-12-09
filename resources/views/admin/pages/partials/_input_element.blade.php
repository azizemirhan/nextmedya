{{-- resources/views/admin/pages/partials/_input_element.blade.php --}}
@php
    $dataAttrs = 'data-name="' . $field['name'] . '"' . ($lang ? ' data-lang="' . $lang . '"' : '');
    $isMultipleFile = isset($field['multiple']) && $field['multiple'] === true;
@endphp

@if($field['type'] === 'textarea')
    <div class="quill-editor-wrapper">
        <div class="quill-editor">{!! $value ?? '' !!}</div>
        <input type="hidden" {!! $dataAttrs !!} value="{{ $value ?? '' }}">
    </div>
@elseif($field['type'] === 'checkbox')
    <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input" {!! $dataAttrs !!} value="1"
                @checked(($value ?? false) == true || $value == 1 || $value === 'true' || $value === '1')>
        <label class="form-check-label">{{ $field['label'] ?? 'Aktif' }}</label>
    </div>
@elseif($field['type'] === 'file')
    @if($isMultipleFile)
        {{-- TOPLU DOSYA YÜKLEME --}}
        <input type="file" class="form-control" {!! $dataAttrs !!} multiple accept="image/*">
        <small class="text-muted">Birden fazla resim seçebilirsiniz (Ctrl+Click ile çoklu seçim)</small>

        @if(!empty($value) && is_array($value))
            <div class="mt-3">
                <p class="fw-bold">Mevcut Dosyalar:</p>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($value as $index => $filePath)
                        <div class="position-relative">
                            <img src="{{ asset($filePath) }}" height="80" class="rounded border" alt="Resim {{ $index + 1 }}">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle p-1"
                                    onclick="removeMultipleFile(this, '{{ $filePath }}')" style="margin: -5px;">
                                <i class="bi bi-x" style="font-size: 12px;"></i>
                            </button>
                            <small class="d-block text-muted text-center mt-1">{{ basename($filePath) }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        {{-- TEK DOSYA YÜKLEME --}}
        <input type="file" class="form-control" {!! $dataAttrs !!}>
        @if(!empty($value))
            <div class="mt-2">
                <img src="{{ asset($value) }}" height="50" alt="Mevcut Resim">
                <small class="d-block text-muted">{{ $value }}</small>
            </div>
        @endif
    @endif
@elseif($field['type'] === 'select' && isset($field['options']))
    <select class="form-select" {!! $dataAttrs !!}>
        @foreach($field['options'] as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(($value ?? '') == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
@else
    <input type="{{ $field['type'] }}" class="form-control" {!! $dataAttrs !!} value="{{ $value ?? '' }}">
@endif

@if($isMultipleFile)
    @push('scripts')
        <script>
            function removeMultipleFile(button, filePath) {
                if(confirm('Bu dosyayı kaldırmak istediğinizden emin misiniz?')) {
                    // Burada AJAX ile dosya silme işlemi yapılabilir
                    $(button).closest('.position-relative').fadeOut(300, function() {
                        $(this).remove();
                    });

                    // Alternatif: Form gönderildiğinde silinecek dosyaların listesini tut
                    let hiddenInput = $('<input type="hidden" name="remove_files[]" value="' + filePath + '">');
                    $(button).closest('form').append(hiddenInput);
                }
            }
        </script>
    @endpush
@endif