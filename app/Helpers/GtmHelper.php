<?php 

if (!function_exists('gtm_hash')) {
    function gtm_hash($data) {
        if (empty($data)) return null;
        // Veriyi temizle: küçük harfe çevir, boşlukları sil
        $normalized = strtolower(trim($data));
        // SHA-256 ile şifrele
        return hash('sha256', $normalized);
    }
}