@extends('admin.layouts.master')
@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                            Medya Yönetimi
                        </h1>
                        <span id="mediaCount" class="ml-3 px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-full"></span>
                    </div>

                    <button onclick="openUploadModal()" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span>Yeni Yükle</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters Bar -->
        <div class="bg-white border-b px-4 py-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Search -->
                    <div class="flex-1 min-w-[300px]">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" id="searchInput" placeholder="Dosya ara..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <!-- Type Filter -->
                    <select id="typeFilter" class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                        <option value="">Tüm Tipler</option>
                        <option value="image">🖼️ Resimler</option>
                        <option value="video">🎬 Videolar</option>
                        <option value="audio">🎵 Ses Dosyaları</option>
                        <option value="document">📄 Dökümanlar</option>
                        <option value="other">📎 Diğer</option>
                    </select>

                    <!-- Folder Filter -->
                    <select id="folderFilter" class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                        <option value="">Tüm Klasörler</option>
                    </select>

                    <!-- View Toggle -->
                    <div class="flex bg-gray-100 rounded-lg p-1">
                        <button onclick="setViewMode('grid')" id="gridViewBtn" class="px-3 py-1 rounded-md text-gray-600 hover:text-gray-900 transition-all view-btn active">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button onclick="setViewMode('list')" id="listViewBtn" class="px-3 py-1 rounded-md text-gray-600 hover:text-gray-900 transition-all view-btn">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Favorites Toggle -->
                    <button id="favoritesToggle" onclick="toggleFavorites()" class="px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-all flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <span>Favoriler</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bulk Actions Bar -->
        <div id="bulkActionsBar" class="hidden bg-purple-50 border-b border-purple-200 px-4 py-3">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-purple-700 font-medium"><span id="selectedCount">0</span> öğe seçildi</span>
                    <button onclick="clearSelection()" class="text-purple-600 hover:text-purple-800 text-sm underline">Temizle</button>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="bulkAction('favorite')" class="px-3 py-1 bg-white border border-purple-300 text-purple-700 rounded-md hover:bg-purple-50 transition-all text-sm">
                        ⭐ Favorilere Ekle
                    </button>
                    <button onclick="bulkAction('archive')" class="px-3 py-1 bg-white border border-purple-300 text-purple-700 rounded-md hover:bg-purple-50 transition-all text-sm">
                        📦 Arşivle
                    </button>
                    <button onclick="bulkAction('delete')" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-all text-sm">
                        🗑️ Sil
                    </button>
                </div>
            </div>
        </div>

        <!-- Media Container -->
        <div class="max-w-7xl mx-auto px-4 py-6">
            <!-- Grid View -->
            <div id="mediaGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                <!-- Loading skeleton -->
                <div class="skeleton-loader hidden">
                    <div class="skeleton h-40 rounded-lg mb-2"></div>
                    <div class="skeleton h-4 rounded w-3/4 mb-1"></div>
                    <div class="skeleton h-3 rounded w-1/2"></div>
                </div>
            </div>

            <!-- List View -->
            <div id="mediaList" class="hidden bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 py-3 text-left">
                            <input type="checkbox" id="selectAll" class="media-checkbox">
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Önizleme</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosya Adı</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tip</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Boyut</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody id="mediaListBody" class="divide-y divide-gray-200">
                    <!-- Items will be inserted here -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Medya bulunamadı</h3>
                <p class="mt-1 text-sm text-gray-500">Yeni medya yükleyerek başlayın.</p>
                <div class="mt-6">
                    <button onclick="openUploadModal()" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-all">
                        Medya Yükle
                    </button>
                </div>
            </div>

            <!-- Pagination -->
            <div id="pagination" class="mt-6 flex justify-center"></div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white border-b px-6 py-4 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Dosya Yükle</h2>
                <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="uploadForm" class="p-6">
                @csrf
                <div id="dropZone" class="upload-zone rounded-2xl p-12 text-center cursor-pointer transition-all duration-300">
                    <svg class="mx-auto h-16 w-16 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-white font-medium mb-2">Dosyaları buraya sürükleyin</p>
                    <p class="text-white/80 text-sm mb-4">veya</p>
                    <label for="fileInput" class="px-6 py-2 bg-white/20 backdrop-blur text-white rounded-lg hover:bg-white/30 transition-all cursor-pointer inline-block">
                        Dosya Seç
                    </label>
                    <input type="file" id="fileInput" name="files[]" multiple class="hidden" accept="image/*,video/*,audio/*,.pdf,.doc,.docx">
                    <p class="text-white/60 text-xs mt-4">Maksimum dosya boyutu: 25MB</p>
                </div>

                <div id="selectedFiles" class="mt-4 space-y-2"></div>

                <div class="mt-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hedef Klasör</label>
                        <input type="text" name="folder" value="uploads" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="auto_webp" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700">WebP versiyonlarını otomatik oluştur</span>
                    </label>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeUploadModal()" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                        İptal
                    </button>
                    <button type="button" onclick="uploadFiles()" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all">
                        Yükle
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Media Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div id="detailContent"></div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Media grid animations */
        .media-card {
            animation: fadeIn 0.3s ease-in;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .media-card:hover {
            transform: translateY(-4px);
        }

        /* Glassmorphism effect */
        .glass-morphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Upload zone */
        .upload-zone {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .upload-zone::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .upload-zone:hover::before {
            left: 100%;
        }

        .upload-zone.dragover {
            background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%);
            transform: scale(1.02);
        }

        /* Checkbox styling */
        .media-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
            appearance: none;
            border: 2px solid #e5e7eb;
            border-radius: 4px;
            background: white;
            position: relative;
            transition: all 0.3s;
        }

        .media-checkbox:checked {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        .media-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 14px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global variables
        let currentPage = 1;
        let selectedItems = new Set();
        let mediaData = [];
        let viewMode = 'grid';

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadMedia();
            loadFolders();
            initEventListeners();
            initDragDrop();
        });

        // Event Listeners
        function initEventListeners() {
            // Search with debounce
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => loadMedia(), 300);
            });

            // Filters
            document.getElementById('typeFilter').addEventListener('change', () => loadMedia());
            document.getElementById('folderFilter').addEventListener('change', () => loadMedia());

            // File input
            document.getElementById('fileInput').addEventListener('change', handleFileSelect);
        }

        // Load Media
        async function loadMedia(page = 1) {
            currentPage = page;

            // Show loading
            showLoading();

            const params = new URLSearchParams({
                page: currentPage,
                per_page: 24,
                search: document.getElementById('searchInput').value,
                type: document.getElementById('typeFilter').value,
                folder_id: document.getElementById('folderFilter').value,
                favorites_only: document.getElementById('favoritesToggle').classList.contains('active')
            });

            try {
                const response = await fetch('/admin/media/api/list?' + params);
                const data = await response.json();

                mediaData = data.data;
                renderMedia(data.data);
                renderPagination(data);
                updateMediaCount(data.total);
            } catch (error) {
                console.error('Error loading media:', error);
            }
        }

        // Render Media Grid
        function renderMedia(items) {
            if (!items || items.length === 0) {
                document.getElementById('emptyState').classList.remove('hidden');
                document.getElementById('mediaGrid').classList.add('hidden');
                document.getElementById('mediaList').classList.add('hidden');
                return;
            }

            document.getElementById('emptyState').classList.add('hidden');

            if (viewMode === 'grid') {
                renderGridView(items);
            } else {
                renderListView(items);
            }
        }

        // Render Grid View
        function renderGridView(items) {
            const grid = document.getElementById('mediaGrid');
            grid.classList.remove('hidden');
            document.getElementById('mediaList').classList.add('hidden');

            grid.innerHTML = items.map(item => `
        <div class="media-card bg-white rounded-lg shadow-sm hover:shadow-xl cursor-pointer overflow-hidden group">
            <div class="relative">
                <input type="checkbox"
                       class="media-checkbox absolute top-2 left-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity"
                       data-id="${item.id}"
                       onchange="toggleSelection(${item.id})"
                       ${selectedItems.has(item.id) ? 'checked' : ''}>

                <div class="aspect-square bg-gray-100 relative overflow-hidden" onclick="showDetail(${item.id})">
                    ${renderThumbnail(item)}
                </div>

                ${item.is_favorite ? '<span class="absolute top-2 right-2 text-yellow-400">⭐</span>' : ''}

                <span class="absolute bottom-2 right-2 px-2 py-1 text-xs font-medium text-white bg-black/50 backdrop-blur rounded">
                    ${item.extension.toUpperCase()}
                </span>
            </div>

            <div class="p-3">
                <p class="text-sm font-medium text-gray-900 truncate" title="${item.filename}">
                    ${item.filename}
                </p>
                <p class="text-xs text-gray-500 mt-1">${item.size}</p>
            </div>
        </div>
    `).join('');
        }

        // Render List View
        function renderListView(items) {
            const list = document.getElementById('mediaList');
            list.classList.remove('hidden');
            document.getElementById('mediaGrid').classList.add('hidden');

            const tbody = document.getElementById('mediaListBody');
            tbody.innerHTML = items.map(item => `
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-3">
                <input type="checkbox" class="media-checkbox" data-id="${item.id}"
                       onchange="toggleSelection(${item.id})"
                       ${selectedItems.has(item.id) ? 'checked' : ''}>
            </td>
            <td class="px-4 py-3">
                <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden">
                    ${renderThumbnail(item, true)}
                </div>
            </td>
            <td class="px-4 py-3">
                <div class="flex items-center">
                    <span class="font-medium text-gray-900">${item.filename}</span>
                    ${item.is_favorite ? '<span class="ml-2 text-yellow-400">⭐</span>' : ''}
                </div>
            </td>
            <td class="px-4 py-3">
                <span class="px-2 py-1 text-xs font-medium rounded-full ${getTypeBadgeClass(item.type)}">
                    ${item.type}
                </span>
            </td>
            <td class="px-4 py-3 text-sm text-gray-600">${item.size}</td>
            <td class="px-4 py-3 text-sm text-gray-600">${formatDate(item.created_at)}</td>
            <td class="px-4 py-3">
                <button onclick="showDetail(${item.id})" class="text-purple-600 hover:text-purple-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </td>
        </tr>
    `).join('');
        }

        // Render Thumbnail
        function renderThumbnail(item, small = false) {
            const size = small ? 'w-full h-full object-cover' : 'w-full h-full object-cover';

            if (item.type === 'image') {
                return `<img src="${item.url}" alt="${item.filename}" class="${size}">`;
            }

            const icons = {
                video: '<svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>',
                audio: '<svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>',
                document: '<svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
                other: '<svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>'
            };

            return `<div class="flex items-center justify-center h-full">${icons[item.type] || icons.other}</div>`;
        }

        // Render Pagination
        function renderPagination(data) {
            const pagination = document.getElementById('pagination');

            if (data.last_page <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let html = '<div class="flex items-center space-x-1">';

            // Previous button
            if (data.current_page > 1) {
                html += `<button onclick="loadMedia(${data.current_page - 1})" class="px-3 py-2 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>`;
            }

            // Page numbers
            for (let i = 1; i <= data.last_page; i++) {
                if (i === data.current_page) {
                    html += `<button class="px-4 py-2 rounded-lg bg-gradient-to-r from-purple-600 to-blue-600 text-white font-medium">${i}</button>`;
                } else if (i === 1 || i === data.last_page || (i >= data.current_page - 2 && i <= data.current_page + 2)) {
                    html += `<button onclick="loadMedia(${i})" class="px-4 py-2 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 transition-colors">${i}</button>`;
                } else if (i === data.current_page - 3 || i === data.current_page + 3) {
                    html += `<span class="px-2 text-gray-400">...</span>`;
                }
            }

            // Next button
            if (data.current_page < data.last_page) {
                html += `<button onclick="loadMedia(${data.current_page + 1})" class="px-3 py-2 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>`;
            }

            html += '</div>';
            pagination.innerHTML = html;
        }

        // Toggle Selection
        function toggleSelection(id) {
            if (selectedItems.has(id)) {
                selectedItems.delete(id);
            } else {
                selectedItems.add(id);
            }
            updateBulkActionsBar();
        }

        // Update Bulk Actions Bar
        function updateBulkActionsBar() {
            const bar = document.getElementById('bulkActionsBar');
            const count = document.getElementById('selectedCount');

            if (selectedItems.size > 0) {
                bar.classList.remove('hidden');
                count.textContent = selectedItems.size;
            } else {
                bar.classList.add('hidden');
            }
        }

        // Clear Selection
        function clearSelection() {
            selectedItems.clear();
            document.querySelectorAll('.media-checkbox').forEach(cb => cb.checked = false);
            updateBulkActionsBar();
        }

        // Bulk Action
        async function bulkAction(action) {
            if (selectedItems.size === 0) return;

            const messages = {
                delete: 'Seçili dosyalar silinecek. Emin misiniz?',
                archive: 'Seçili dosyalar arşivlenecek. Emin misiniz?',
                favorite: 'Seçili dosyalar favorilere eklenecek. Emin misiniz?'
            };

            const result = await Swal.fire({
                title: 'Emin misiniz?',
                text: messages[action],
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Evet',
                cancelButtonText: 'İptal',
                confirmButtonColor: '#7c3aed',
                cancelButtonColor: '#6b7280'
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch('/admin/media/bulk-action', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            action: action,
                            ids: Array.from(selectedItems)
                        })
                    });

                    const data = await response.json();

                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    clearSelection();
                    loadMedia(currentPage);
                } catch (error) {
                    Swal.fire('Hata!', 'İşlem sırasında bir hata oluştu.', 'error');
                }
            }
        }

        // Show Detail
        async function showDetail(id) {
            const media = mediaData.find(m => m.id === id);
            if (!media) return;

            const modal = document.getElementById('detailModal');
            const content = document.getElementById('detailContent');

            content.innerHTML = `
        <div class="relative">
            <button onclick="closeDetailModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="p-6">
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        ${media.type === 'image' ?
                `<img src="${media.url}" alt="${media.filename}" class="w-full h-auto">` :
                `<div class="aspect-video flex items-center justify-center">
                                ${renderThumbnail(media)}
                            </div>`
            }
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">${media.filename}</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Tip:</span>
                            <span class="font-medium">${media.type}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Boyut:</span>
                            <span class="font-medium">${media.size}</span>
                        </div>
                        ${media.dimensions?.width ? `
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Boyutlar:</span>
                            <span class="font-medium">${media.dimensions.width} × ${media.dimensions.height}</span>
                        </div>` : ''}
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Format:</span>
                            <span class="font-medium">${media.extension.toUpperCase()}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">Yüklenme:</span>
                            <span class="font-medium">${formatDate(media.created_at)}</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">URL</label>
                        <div class="flex">
                            <input type="text" value="${media.url}" readonly
                                   class="flex-1 px-3 py-2 border border-gray-200 rounded-l-lg bg-gray-50 text-sm">
                            <button onclick="copyToClipboard('${media.url}')"
                                    class="px-3 py-2 bg-purple-600 text-white rounded-r-lg hover:bg-purple-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-3">
                        <button onclick="deleteMedia(${id})"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            Sil
                        </button>
                        <button onclick="closeDetailModal()"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Kapat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

            modal.classList.remove('hidden');
        }

        // Delete Media
        async function deleteMedia(id) {
            const result = await Swal.fire({
                title: 'Emin misiniz?',
                text: 'Bu dosya silinecektir!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sil',
                cancelButtonText: 'İptal',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280'
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/admin/media/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        closeDetailModal();
                        Swal.fire({
                            icon: 'success',
                            title: 'Silindi!',
                            text: 'Dosya başarıyla silindi.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        loadMedia(currentPage);
                    }
                } catch (error) {
                    Swal.fire('Hata!', 'Silme işlemi başarısız oldu.', 'error');
                }
            }
        }

        // Drag & Drop
        function initDragDrop() {
            const dropZone = document.getElementById('dropZone');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('dragover');
            }

            function unhighlight(e) {
                dropZone.classList.remove('dragover');
            }

            dropZone.addEventListener('drop', handleDrop, false);
        }

        // Handle File Drop
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        // Handle File Select
        function handleFileSelect(e) {
            const files = e.target.files;
            handleFiles(files);
        }

        // Handle Files
        function handleFiles(files) {
            const fileList = document.getElementById('selectedFiles');
            fileList.innerHTML = '';

            Array.from(files).forEach(file => {
                const size = (file.size / 1024 / 1024).toFixed(2);
                const item = document.createElement('div');
                item.className = 'flex items-center justify-between p-3 bg-gray-50 rounded-lg';
                item.innerHTML = `
            <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <div>
                    <p class="text-sm font-medium text-gray-900">${file.name}</p>
                    <p class="text-xs text-gray-500">${size} MB</p>
                </div>
            </div>
        `;
                fileList.appendChild(item);
            });
        }

        // Upload Files
        async function uploadFiles() {
            const formData = new FormData(document.getElementById('uploadForm'));

            try {
                const response = await fetch('/admin/media/upload', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    closeUploadModal();
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    loadMedia();
                } else {
                    Swal.fire('Hata!', data.message || 'Yükleme başarısız oldu.', 'error');
                }
            } catch (error) {
                Swal.fire('Hata!', 'Yükleme sırasında bir hata oluştu.', 'error');
            }
        }

        // Load Folders
        async function loadFolders() {
            try {
                const response = await fetch('/admin/media/folders');
                const folders = await response.json();

                const select = document.getElementById('folderFilter');
                folders.forEach(folder => {
                    const option = document.createElement('option');
                    option.value = folder.id;
                    option.textContent = folder.name;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading folders:', error);
            }
        }

        // View Mode
        function setViewMode(mode) {
            viewMode = mode;
            document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active', 'bg-white', 'shadow'));

            if (mode === 'grid') {
                document.getElementById('gridViewBtn').classList.add('active', 'bg-white', 'shadow');
            } else {
                document.getElementById('listViewBtn').classList.add('active', 'bg-white', 'shadow');
            }

            renderMedia(mediaData);
        }

        // Toggle Favorites
        function toggleFavorites() {
            const btn = document.getElementById('favoritesToggle');
            btn.classList.toggle('active');
            btn.classList.toggle('bg-yellow-50');
            btn.classList.toggle('border-yellow-300');
            loadMedia();
        }

        // Utility Functions
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('tr-TR', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function getTypeBadgeClass(type) {
            const classes = {
                image: 'bg-green-100 text-green-800',
                video: 'bg-purple-100 text-purple-800',
                audio: 'bg-blue-100 text-blue-800',
                document: 'bg-yellow-100 text-yellow-800',
                other: 'bg-gray-100 text-gray-800'
            };
            return classes[type] || classes.other;
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Kopyalandı!',
                    text: 'URL panoya kopyalandı.',
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        }

        function updateMediaCount(total) {
            document.getElementById('mediaCount').textContent = `${total} dosya`;
        }

        function showLoading() {
            // Loading state implementation
        }

        // Modal Functions
        function openUploadModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.getElementById('uploadForm').reset();
            document.getElementById('selectedFiles').innerHTML = '';
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
@endpush
