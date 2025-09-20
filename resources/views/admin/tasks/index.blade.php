@extends('admin.layouts.master')

@section('title', 'Tasks | Scrumboard')

@push('styles')
    <link href="{{ asset('backend/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/light/apps/scrumboard.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/src/assets/css/dark/apps/scrumboard.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="middle-content container-xxl p-0">
        {{-- BREADCRUMB --}}
        <div class="secondary-nav">
            <div class="breadcrumbs-container" data-page-heading="Tasks">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z"/>
                        </svg>
                    </a>
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title"><h5 class="mb-0">Görev  Yönetimi</h5></div>
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Tasks</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
        </div>

        {{-- AKSİYON BUTONLARI --}}
        {{-- AKSİYON BUTONLARI --}}
        <div class="action-btn layout-top-spacing mb-3 mx-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <label class="mb-0 me-1 fw-semibold">Tablo Seç:</label>
                    <select id="board-select" class="form-select"></select>
                    <a href="#" id="edit-board-btn" class="btn btn-outline-info btn-sm">Düzenle</a> {{-- YENİ --}}
                    <button id="delete-board" class="btn btn-outline-danger btn-sm">Sil</button>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.boards.create') }}" class="btn btn-success">Yeni Board Ekle</a>
                    <button id="add-list" class="btn btn-secondary">Liste Ekle</button>
                </div>
            </div>
        </div>

        {{-- SCRUMBOARD ALANI --}}
        <div class="row scrumboard" id="cancel-row">
            <div class="col-lg-12 layout-spacing">
                <div class="task-list-section" id="scrumboard-container">
                    {{-- Listeler (Kolonlar) JavaScript ile buraya eklenecek --}}
                </div>
            </div>
        </div>
    </div>

    {{-- MODALS --}}
    @include('admin.tasks.partials.modals')

@endsection
@push('scripts')
    <script src="{{ asset('backend/src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        // Scrumboard uygulamasını bir obje içinde yöneterek kod tekrarını ve global değişkenleri azaltıyoruz.
        const ScrumboardApp = {
            // --- STATE ---
            CSRF: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '',
            currentBoardId: null,
            allUsers: [], // Kullanıcı atama için tüm kullanıcıları burada tutacağız

            // --- API HELPERS ---
            async apiFetch(url, opts = {}) {
                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.CSRF
                };
                const res = await fetch(url, {credentials: 'same-origin', ...opts, headers});
                if (!res.ok) {
                    const errorData = await res.json().catch(() => ({message: res.statusText}));
                    console.error('API Error:', errorData);
                    throw new Error(errorData.message || `HTTP ${res.status}`);
                }
                if (res.status === 204) { // 204 No Content durumunu kontrol et
                    return null; // Boş cevaplar için null dön
                }
                return res.json();
            },

            // --- RENDERING ---
            renderList(list, gridEl) {
                const listContainer = document.createElement('div');
                listContainer.className = 'task-list-container';
                listContainer.dataset.listId = list.id;
                listContainer.innerHTML = `
                    <div class="connect-sorting">
                        <div class="task-container-header">
                            <h6 class="s-heading">${this.escapeHtml(list.name)}</h6>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">...</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item delete-list-btn" href="#" data-list-id="${list.id}">Delete List</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="connect-sorting-content" data-sortable="true">
                            ${(list.tasks || []).sort((a, b) => (a.position ?? 0) - (b.position ?? 0)).map(t => this.getTaskHtml(t)).join('')}
                        </div>
                        <div class="add-s-task">
                            <a href="#" class="addTaskBtn" data-list-id="${list.id}">+ Add Task</a>
                        </div>
                    </div>`;
                gridEl.appendChild(listContainer);
            },
            getTaskHtml(task) {
                return `
                    <div class="card simple-title-task task-card" data-id="${task.id}">
                        <div class="card-body">
                            <div class="task-header">
                                <h4 class="">${this.escapeHtml(task.title)}</h4>
                            </div>
                        </div>
                    </div>`;
            },
            async renderTaskDetail(task) {
                const modalBody = document.getElementById('taskDetailModalBody');
                const assigneesHtml = task.assignees.map(u => `<span class="badge bg-secondary me-1">${this.escapeHtml(u.name)}</span>`).join('') || 'Atanan yok';
                const userOptionsHtml = this.allUsers.map(u => `<option value="${u.id}">${this.escapeHtml(u.name)}</option>`).join('');

                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" id="detail-task-title" class="form-control form-control-lg mb-3" value="${this.escapeHtml(task.title)}">
                            <textarea id="detail-task-description" class="form-control" rows="6" placeholder="Açıklama ekle...">${this.escapeHtml(task.description ?? '')}</textarea>
                            <button class="btn btn-primary mt-2 save-task-details" data-task-id="${task.id}">Kaydet</button>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Detaylar</h6>
                                    <div class="mb-2"><strong>Priority:</strong>
                                        <select id="detail-task-priority" class="form-select form-select-sm">
                                            <option value="low" ${task.priority === 'low' ? 'selected' : ''}>Low</option>
                                            <option value="normal" ${task.priority === 'normal' ? 'selected' : ''}>Normal</option>
                                            <option value="high" ${task.priority === 'high' ? 'selected' : ''}>High</option>
                                            <option value="urgent" ${task.priority === 'urgent' ? 'selected' : ''}>Urgent</option>
                                        </select>
                                    </div>
                                    <div class="mb-2"><strong>Due Date:</strong>
                                        <input type="date" id="detail-task-due_at" class="form-control form-control-sm" value="${task.due_at ? task.due_at.split('T')[0] : ''}">
                                    </div>
                                    <hr>
                                    <h6 class="card-title">Atananlar</h6>
                                    <div id="assignee-list" class="mb-2">${assigneesHtml}</div>
                                    <div class="input-group">
                                        <select class="form-select" id="add-assignee-select">${userOptionsHtml}</select>
                                        <button class="btn btn-outline-secondary add-assignee-btn" data-task-id="${task.id}" type="button">Ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
            },
            updateActionButtons(boardId) {
                const editBtn = document.getElementById('edit-board-btn');
                if (editBtn) {
                    let url = "{{ route('admin.boards.edit', ['board' => 'PLACEHOLDER']) }}";
                    editBtn.href = url.replace('PLACEHOLDER', boardId);
                }
            },

            // --- CORE LOGIC ---
            async loadBoard(boardId) {
                if (!boardId) return;
                this.currentBoardId = boardId;
                this.updateActionButtons(boardId); // DÜZELTME: 'this' eklendi
                const grid = document.getElementById('scrumboard-container');
                grid.innerHTML = '<div class="spinner-border text-primary" role="status"></div>';
                try {
                    const data = await this.apiFetch(`/admin/api/boards/${boardId}`);
                    grid.innerHTML = '';
                    (data?.lists ?? []).forEach(l => this.renderList(l, grid));
                    this.initDragAndDrop();
                } catch (e) {
                    grid.innerHTML = `<p class="text-danger">Board yüklenirken bir hata oluştu: ${e.message}</p>`;
                }
            },
            async openTaskDetail(taskId) {
                document.getElementById('taskDetailModalBody').innerHTML = '<div class="spinner-border text-primary" role="status"></div>';
                try {
                    const task = await this.apiFetch(`/admin/api/tasks/${taskId}`);
                    await this.renderTaskDetail(task);
                } catch (e) {
                    document.getElementById('taskDetailModalBody').innerHTML = '<p class="text-danger">Task detayı yüklenemedi.</p>';
                }
            },
            initDragAndDrop() {
                $('.connect-sorting-content').sortable({
                    connectWith: '.connect-sorting-content', items: ".card", cursor: 'move', placeholder: "ui-state-highlight",
                    update: async (event, ui) => {
                        const card = ui.item;
                        const taskId = card.data('id');
                        const newListId = card.closest('.task-list-container').data('listId');
                        const newPosition = card.index();
                        try {
                            await this.apiFetch(`/admin/api/tasks/${taskId}/move`, {
                                method: 'PATCH',
                                body: JSON.stringify({list_id: newListId, position: newPosition})
                            });
                        } catch (err) {
                            alert("Task taşınamadı, sayfa yenileniyor.");
                            this.loadBoard(this.currentBoardId);
                        }
                    }
                });
            },

            // --- EVENT BINDING ---
            bindEventListeners() {
                const sel = document.getElementById('board-select');
                const addListBtn = document.getElementById('add-list');
                const addListModal = new bootstrap.Modal(document.getElementById('addListModal'));
                const addTaskModal = new bootstrap.Modal(document.getElementById('addTaskModal'));
                const taskDetailModal = new bootstrap.Modal(document.getElementById('taskDetailModal'));

                sel.addEventListener('change', () => this.loadBoard(sel.value));
                document.getElementById('reload-board')?.addEventListener('click', () => this.loadBoard(sel.value));
                document.getElementById('delete-board').addEventListener('click', async () => {
                    if (!this.currentBoardId) return;
                    if (!confirm(`Panoyu silmek istediğinizden emin misiniz?`)) return;
                    try {
                        await this.apiFetch(`/admin/api/boards/${this.currentBoardId}`, {method: 'DELETE'});
                        window.location.reload();
                    } catch (e) { alert(`Board silinemedi: ${e.message}`); }
                });

                addListBtn.addEventListener('click', () => addListModal.show());
                document.querySelector('.add-list').addEventListener('click', async () => {
                    const listName = document.getElementById('s-list-name').value.trim();
                    if (!listName) return;
                    try {
                        await this.apiFetch('/admin/api/lists', {
                            method: 'POST',
                            body: JSON.stringify({ name: listName, board_id: this.currentBoardId })
                        });
                        document.getElementById('s-list-name').value = '';
                        addListModal.hide();
                        await this.loadBoard(this.currentBoardId);
                    } catch(e) { alert(`Liste eklenemedi: ${e.message}`); }
                });

                document.querySelector('.add-tsk').addEventListener('click', async () => {
                    const title = document.getElementById('s-task-title').value.trim();
                    const listId = document.getElementById('s-task-list-id').value;
                    if (!title) return;
                    try {
                        await this.apiFetch('/admin/api/tasks', {
                            method: 'POST',
                            body: JSON.stringify({ title, list_id: Number(listId), board_id: this.currentBoardId })
                        });
                        document.getElementById('s-task-title').value = '';
                        addTaskModal.hide();
                        await this.loadBoard(this.currentBoardId);
                    } catch(e) { alert(`Task eklenemedi: ${e.message}`); }
                });

                document.getElementById('scrumboard-container').addEventListener('click', e => {
                    const card = e.target.closest('.task-card');
                    if (card) {
                        e.preventDefault();
                        this.openTaskDetail(card.dataset.id);
                        taskDetailModal.show();
                    }
                    if (e.target.closest('.addTaskBtn')) {
                        e.preventDefault();
                        document.getElementById('s-task-list-id').value = e.target.closest('.addTaskBtn').dataset.listId;
                        addTaskModal.show();
                    }
                    if (e.target.closest('.delete-list-btn')) {
                        e.preventDefault();
                        const listId = e.target.closest('.delete-list-btn').dataset.listId;
                        if (!confirm("Bu listeyi silmek istediğinizden emin misiniz?")) return;
                        this.apiFetch(`/admin/api/lists/${listId}`, { method: 'DELETE' })
                            .then(() => this.loadBoard(this.currentBoardId))
                            .catch(err => alert(`Liste silinemedi: ${err.message}`));
                    }
                });

                document.getElementById('taskDetailModalBody').addEventListener('click', async e => {
                    const taskId = e.target.dataset.taskId || e.target.closest('[data-task-id]')?.dataset.taskId;
                    if (!taskId) return;

                    if (e.target.closest('.save-task-details')) {
                        const body = {
                            title: document.getElementById('detail-task-title').value,
                            description: document.getElementById('detail-task-description').value,
                            priority: document.getElementById('detail-task-priority').value,
                            due_at: document.getElementById('detail-task-due_at').value
                        };
                        try {
                            const updatedTask = await this.apiFetch(`/admin/api/tasks/${taskId}`, { method: 'PUT', body: JSON.stringify(body) });
                            await this.loadBoard(this.currentBoardId);
                            taskDetailModal.hide();
                        } catch (err) { alert(`Task güncellenemedi: ${err.message}`); }
                    }
                    if (e.target.closest('.add-assignee-btn')) {
                        const userId = document.getElementById('add-assignee-select').value;
                        try {
                            await this.apiFetch(`/admin/api/tasks/${taskId}/assignees`, { method: 'POST', body: JSON.stringify({ user_id: userId }) });
                            this.openTaskDetail(taskId);
                        } catch (err) { alert(`Kullanıcı atanamadı: ${err.message}`); }
                    }
                });
            },

            // --- UTILITIES ---
            escapeHtml(str) {
                if (str == null) return '';
                return String(str).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));
            },

            // --- INITIALIZATION ---
            async init() {
                this.bindEventListeners();
                const sel = document.getElementById('board-select');
                const addListBtn = document.getElementById('add-list');
                try {
                    this.allUsers = await this.apiFetch('/admin/api/users');
                    const boards = await this.apiFetch('/admin/api/boards');
                    if (!boards.length) {
                        sel.innerHTML = '<option>Board bulunamadı</option>';
                        sel.disabled = true; addListBtn.disabled = true;
                    } else {
                        sel.innerHTML = boards.map(b => `<option value="${b.id}">${this.escapeHtml(b.name)}</option>`).join('');
                        this.updateActionButtons(sel.value); // DÜZELTME: 'this' eklendi
                        await this.loadBoard(sel.value);
                    }
                } catch (e) {
                    sel.innerHTML = `<option>Hata: ${e.message}</option>`;
                    sel.disabled = true;
                }
            }
        };

        document.addEventListener('DOMContentLoaded', () => ScrumboardApp.init());
    </script>
@endpush
