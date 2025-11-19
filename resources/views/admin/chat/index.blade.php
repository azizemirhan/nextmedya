@extends('admin.layouts.master')
@section('content')
    <div class="chat-section layout-top-spacing">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="chat-system">
                    <div class="hamburger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu mail-menu d-lg-none">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </div>

                    <div class="user-list-box">
                        <div class="search">
                            <input type="text" class="form-control" placeholder="Kullanıcı Ara" v-model="searchQuery">
                        </div>
                        <div class="people ps ps--active-y">
                            <div v-for="session in filteredSessions"
                                 :key="session.id"
                                 :class="['person', { 'active': selectedSession && selectedSession.id === session.id }]"
                                 @click="selectSession(session.id)">
                                <div class="user-info">
                                    <div class="f-head">
                                        <img src="{{ asset('backend/default-avatar.png') }}" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">
                                            <span class="user-name"
                                                  v-text="session.visitor_name || 'Ziyaretçi #' + session.id"></span>
                                            <span class="user-meta-time"
                                                  v-text="formatTime(session.last_activity)"></span>
                                        </div>
                                        <span class="preview"
                                              v-text="session.visitor_email || session.visitor_ip"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chat-box">
                        <div v-if="!selectedSession" class="chat-not-selected">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                Sohbet Seçin
                            </p>
                        </div>

                        <div v-else class="chat-box-inner">
                            <div class="chat-meta-user chat-active">
                                <div class="current-chat-user-name">
            <span>
                <img src="{{ asset('backend/default-avatar.png') }}" alt="avatar">
                <span class="name" v-text="selectedSession.visitor_name || 'Ziyaretçi'"></span>
            </span>
                                </div>
                                <div class="chat-action-btn align-self-center">
                                    <button @click="closeSession" class="btn btn-sm btn-danger">
                                        Sohbeti Kapat
                                    </button>
                                </div>
                            </div>

                            <div class="chat-conversation-box" ref="messagesContainer">
                                <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                    <div class="chat active-chat">
                                        <div class="conversation-start"
                                             v-if="selectedSession.messages && selectedSession.messages.length > 0">
                                            <span v-text="formatDate(selectedSession.messages[0].created_at)"></span>
                                        </div>

                                        <template v-for="message in selectedSession.messages">
                                            <div :key="message.id"
                                                 :class="['bubble', message.sender_type === 'admin' ? 'me' : 'you']"
                                                 v-text="message.message">
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <!-- MESAJ INPUT'U BURASI ÖNEMLİ -->
                            <div class="chat-footer chat-active">
                                <div class="chat-input">
                                    <form @submit.prevent="sendMessage" class="chat-form">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path
                                                d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <input v-model="newMessage" type="text" class="mail-write-box form-control"
                                               placeholder="Mesaj yazın...">
                                        <button type="submit" class="btn btn-primary btn-sm">Gönder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .chat-section {
            padding: 20px 0;
        }

        .chat-system {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            height: 700px;
            overflow: hidden;
        }

        .user-list-box {
            width: 350px;
            border-right: 1px solid #e0e6ed;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .user-list-box .search {
            padding: 20px;
            border-bottom: 1px solid #e0e6ed;
            flex-shrink: 0;
        }

        .people {
            flex: 1;
            overflow-y: auto;
            min-height: 0;
        }

        .person {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f2f3;
            cursor: pointer;
            transition: all 0.3s;
        }

        .person:hover, .person.active {
            background: #f8f9fa;
        }

        .person.active {
            border-left: 3px solid #4361ee;
        }

        .user-info {
            display: flex;
            gap: 12px;
        }

        .f-head img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .f-body {
            flex: 1;
            min-width: 0;
        }

        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .user-name {
            font-weight: 600;
            color: #0e1726;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-meta-time {
            font-size: 12px;
            color: #888ea8;
            flex-shrink: 0;
        }

        .preview {
            font-size: 13px;
            color: #888ea8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-box {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 0;
        }

        .chat-not-selected {
            text-align: center;
            color: #888ea8;
        }

        .chat-not-selected svg {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .chat-box-inner {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .chat-meta-user {
            padding: 20px;
            border-bottom: 1px solid #e0e6ed;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            background: white;
        }

        .current-chat-user-name {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .current-chat-user-name img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .current-chat-user-name .name {
            font-weight: 600;
            color: #0e1726;
        }

        .chat-conversation-box {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: #f8f9fa;
            min-height: 0;
        }

        .conversation-start {
            text-align: center;
            margin-bottom: 20px;
        }

        .conversation-start span {
            background: #e0e6ed;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
            color: #888ea8;
        }

        .bubble {
            max-width: 70%;
            padding: 12px 18px;
            border-radius: 18px;
            margin-bottom: 10px;
            word-wrap: break-word;
            word-break: break-word;
            display: inline-block;
            width: auto;
        }

        .bubble.me {
            background: #4361ee;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 4px;
            text-align: left;
        }

        .bubble.you {
            background: white;
            color: #0e1726;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .chat {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .chat-footer {
            padding: 15px 20px;
            border-top: 1px solid #e0e6ed;
            background: white;
            flex-shrink: 0;
            position: relative;
            z-index: 10;
        }

        .chat-input {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-form {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .chat-input svg {
            color: #888ea8;
            flex-shrink: 0;
        }

        .mail-write-box {
            flex: 1;
            border-radius: 25px;
            border: 1px solid #e0e6ed;
            padding: 10px 20px;
            min-height: 40px;
            outline: none;
        }

        .mail-write-box:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .people::-webkit-scrollbar,
        .chat-conversation-box::-webkit-scrollbar {
            width: 6px;
        }

        .people::-webkit-scrollbar-track,
        .chat-conversation-box::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .people::-webkit-scrollbar-thumb,
        .chat-conversation-box::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .people::-webkit-scrollbar-thumb:hover,
        .chat-conversation-box::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        @media (max-width: 992px) {
            .chat-system {
                flex-direction: column;
                height: auto;
                min-height: 600px;
            }

            .user-list-box {
                width: 100%;
                max-height: 200px;
            }
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '.chat-section',
            data: {
                sessions: @json($sessions),
                selectedSession: null,
                newMessage: '',
                searchQuery: '',
                pollingInterval: null,
                notificationSound: null
            },
            computed: {
                filteredSessions() {
                    if (!this.searchQuery) return this.sessions;

                    return this.sessions.filter(session => {
                        const name = session.visitor_name || '';
                        const email = session.visitor_email || '';
                        const query = this.searchQuery.toLowerCase();
                        return name.toLowerCase().includes(query) || email.toLowerCase().includes(query);
                    });
                }
            },
            mounted() {
                this.initNotificationSound();
                this.startPolling();
                if (this.sessions.length > 0) {
                    this.selectSession(this.sessions[0].id);
                }
            },
            methods: {
                initNotificationSound() {
                    this.notificationSound = new Audio('{{ asset('sounds/message.mp3') }}');
                },
                playNotificationSound() {
                    if (this.notificationSound) {
                        this.notificationSound.currentTime = 0;
                        this.notificationSound.play().catch(e => console.log('Ses çalınamadı:', e));
                    }
                },
                async selectSession(id) {
                    try {
                        const response = await axios.get(`/admin/chat/session/${id}`);

                        const previousMessageCount = this.selectedSession ? this.selectedSession.messages.length : 0;

                        this.selectedSession = response.data;

                        if (this.selectedSession.messages.length > previousMessageCount && previousMessageCount > 0) {
                            this.playNotificationSound();
                        }

                        this.$nextTick(() => this.scrollToBottom());

                        const session = this.sessions.find(s => s.id === id);
                        if (session) {
                            session.unread_visitor_messages_count = 0;
                        }
                    } catch (error) {
                        console.error('Failed to load session:', error);
                    }
                },
                async sendMessage() {
                    if (!this.newMessage.trim() || !this.selectedSession) return;

                    try {
                        const response = await axios.post(`/admin/chat/session/${this.selectedSession.id}/send`, {
                            message: this.newMessage
                        });

                        this.selectedSession.messages.push(response.data);
                        this.newMessage = '';
                        this.playNotificationSound();
                        this.$nextTick(() => this.scrollToBottom());
                    } catch (error) {
                        console.error('Failed to send message:', error);
                    }
                },
                async closeSession() {
                    if (!confirm('Bu sohbeti kapatmak istediğinizden emin misiniz?')) return;

                    try {
                        await axios.post(`/admin/chat/session/${this.selectedSession.id}/close`);
                        this.selectedSession.status = 'closed';
                        alert('Sohbet kapatıldı');
                        this.selectedSession = null;
                    } catch (error) {
                        console.error('Failed to close session:', error);
                    }
                },
                startPolling() {
                    this.pollingInterval = setInterval(() => {
                        if (this.selectedSession) {
                            this.selectSession(this.selectedSession.id);
                        }
                    }, 3000);
                },
                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.messagesContainer;
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    });
                },
                formatTime(datetime) {
                    const date = new Date(datetime);
                    return date.toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'});
                },
                formatDate(datetime) {
                    const date = new Date(datetime);
                    const today = new Date();
                    const yesterday = new Date(today);
                    yesterday.setDate(yesterday.getDate() - 1);

                    if (date.toDateString() === today.toDateString()) {
                        return 'Bugün, ' + this.formatTime(datetime);
                    } else if (date.toDateString() === yesterday.toDateString()) {
                        return 'Dün, ' + this.formatTime(datetime);
                    } else {
                        return date.toLocaleDateString('tr-TR') + ', ' + this.formatTime(datetime);
                    }
                }
            },
            beforeDestroy() {
                if (this.pollingInterval) {
                    clearInterval(this.pollingInterval);
                }
            }
        });
    </script>
@endpush
