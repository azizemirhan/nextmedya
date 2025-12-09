============================================
🔔 YENİ İLETİŞİM FORMU MESAJI
============================================

nextmedya.com web sitenizden yeni bir iletişim formu mesajı aldınız.

============================================
İLETİŞİM BİLGİLERİ
============================================

👤 Ad Soyad: {{ $data['name'] }}
📧 E-posta: {{ $data['email'] }}
📋 Konu: {{ $data['subject'] ?? 'Belirtilmemiş' }}
📅 Tarih: {{ now()->format('d.m.Y H:i') }}

============================================
💬 MESAJ İÇERİĞİ
============================================

{{ $data['message'] }}

============================================
🔍 TEKNİK DETAYLAR
============================================

IP Adresi: {{ $data['ip'] ?? 'Bilinmiyor' }}
Tarayıcı: {{ $data['ua'] ?? 'Bilinmiyor' }}
Kaynak: Website İletişim Formu

============================================

Müşteriyi yanıtlamak için: {{ $data['email'] }}

---
Bu e-posta {{ config('app.name', 'Next Medya') }} web sitesi 
iletişim formundan otomatik olarak gönderilmiştir.

© {{ date('Y') }} {{ config('app.name') }}