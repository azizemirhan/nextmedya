<h2>Yeni Müşteri Talebi</h2>
<p><strong>Ad Soyad:</strong> {{ $data['fullname'] }}</p>
<p><strong>E-posta:</strong> {{ $data['email'] }}</p>
<p><strong>Telefon:</strong> {{ $data['phone'] }}</p>
<p><strong>Firma:</strong> {{ $data['company'] ?? '-' }}</p>
<p><strong>Hizmet Türü:</strong> {{ $data['service_type'] }}</p>
<p><strong>Başlık:</strong> {{ $data['request_title'] }}</p>
<p><strong>Talep Açıklaması:</strong><br>{{ $data['description'] }}</p>
