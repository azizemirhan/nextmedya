{{-- Kişi Kartları --}}
<div class="row mt-3">
    @forelse ($contacts as $contact)
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
            <div class="card h-100">
                {{-- ... (Bir önceki cevaptaki card içeriğinin tamamı buraya gelecek) ... --}}
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-start">
                            @if($contact->profile_photo_path)
                                <img src="{{ asset($contact->profile_photo_path) }}" alt="{{ $contact->first_name }}"
                                     class="me-3 rounded-circle" style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                @php
                                    $fi = mb_substr($contact->first_name ?? '', 0, 1);
                                    $li = mb_substr($contact->last_name ?? '', 0, 1);
                                @endphp
                                <div class="avatar avatar-md me-3 avatar-initials rounded-circle">
                                    <span class="avatar-title">{{ $fi }}{{ $li }}</span>
                                </div>
                            @endif
                            <div>
                                <h6 class="mb-0">{{ $contact->first_name }} {{ $contact->last_name }}</h6>
                                <p class="mb-0 text-muted small">{{ $contact->job_title }}</p>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                       href="{{ route('admin.contacts.edit', $contact) }}">Düzenle</a></li>
                                <li><a class="dropdown-item share-btn" href="#" data-bs-toggle="modal"
                                       data-bs-target="#shareModal"
                                       data-name="{{ $contact->first_name }} {{ $contact->last_name }}"
                                       data-pdf-url="{{ route('admin.contacts.exportPdf', $contact) }}">Paylaş</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.contacts.exportPdf', $contact) }}"
                                       target="_blank">PDF İndir</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                       onclick="document.getElementById('delete-form-{{$contact->id}}').submit();">Sil</a>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                          id="delete-form-{{$contact->id}}" class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-2"><i
                                class="bi bi-building me-2"></i>{{ $contact->account?->name ?? 'Şirket belirtilmemiş' }}
                        </p>
                        <p class="mb-2"><i class="bi bi-envelope me-2"></i>{{ $contact->primary_email ?? '-' }}</p>
                        <p class="mb-0"><i class="bi bi-telephone me-2"></i>{{ $contact->primary_phone ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Arama kriterlerine uygun kişi bulunamadı.</div>
        </div>
    @endforelse
</div>
{{ $contacts->onEachSide(1)->links() }}


