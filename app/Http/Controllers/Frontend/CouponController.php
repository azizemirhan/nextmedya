<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Kupon doğrulama API endpoint'i
     */
    public function validateCoupon(Request $request)
    {
        try {
            $couponCode = strtoupper(trim($request->input('coupon_code')));
            $packagePrices = $request->input('package_prices', []);
            
            if (empty($couponCode)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kupon kodu boş olamaz'
                ], 400);
            }

            // Aktif pricing section'ını bul
            $pricingSection = $this->findPricingSection();
            
            if (!$pricingSection) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fiyat bilgisi bulunamadı'
                ], 404);
            }

            // Kupon kodlarını getir
            $couponCodes = $pricingSection->content['coupon_codes'] ?? [];
            
            // Kupon kodunu bul ve doğrula
            $validCoupon = $this->findValidCoupon($couponCodes, $couponCode);
            
            if (!$validCoupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Geçersiz kupon kodu'
                ], 404);
            }

            // İndirimli fiyatları hesapla
            $discountedPrices = $this->calculateDiscountedPrices(
                $packagePrices, 
                $validCoupon
            );

            return response()->json([
                'success' => true,
                'message' => 'Kupon başarıyla uygulandı!',
                'coupon' => [
                    'code' => $validCoupon['coupon_code'],
                    'name' => $validCoupon['coupon_name'][app()->getLocale()] ?? $validCoupon['coupon_name'],
                    'discount_type' => $validCoupon['discount_type'],
                    'discount_amount' => $validCoupon['discount_amount']
                ],
                'discounted_prices' => $discountedPrices,
                'savings' => $this->calculateSavings($packagePrices, $discountedPrices)
            ]);

        } catch (\Exception $e) {
            \Log::error('Coupon validation error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu. Lütfen tekrar deneyin.'
            ], 500);
        }
    }

    /**
     * Aktif pricing section'ını bul
     */
    private function findPricingSection()
    {
        // pricing-packages-advanced section'ını bul
        $page = Page::whereHas('sections', function($query) {
            $query->where('section_key', 'pricing-packages-advanced')
                  ->where('is_active', true);
        })->where('status', 'published')->first();

        if ($page) {
            return $page->sections()
                       ->where('section_key', 'pricing-packages-advanced')
                       ->where('is_active', true)
                       ->first();
        }

        return null;
    }

    /**
     * Geçerli kupon kodu bul
     */
    private function findValidCoupon($couponCodes, $couponCode)
    {
        foreach ($couponCodes as $coupon) {
            // Kupon kodu kontrolü
            if (strtoupper($coupon['coupon_code'] ?? '') !== $couponCode) {
                continue;
            }

            // Aktiflik kontrolü
            if (!($coupon['is_active'] ?? false)) {
                continue;
            }

            // Geçerlilik tarihi kontrolü
            if (!empty($coupon['valid_until'])) {
                $validUntil = Carbon::createFromFormat('Y-m-d', $coupon['valid_until'])->endOfDay();
                if (Carbon::now()->isAfter($validUntil)) {
                    continue;
                }
            }

            return $coupon;
        }

        return null;
    }

    /**
     * İndirimli fiyatları hesapla
     */
    private function calculateDiscountedPrices($packagePrices, $coupon)
    {
        $discountedPrices = [];
        $discountType = $coupon['discount_type'];
        $discountAmount = (float) $coupon['discount_amount'];
        $minimumAmount = (float) ($coupon['minimum_amount'] ?? 0);

        foreach ($packagePrices as $index => $price) {
            $originalPrice = (float) $price;
            
            // Minimum tutar kontrolü
            if ($minimumAmount > 0 && $originalPrice < $minimumAmount) {
                $discountedPrices[$index] = $originalPrice;
                continue;
            }

            if ($discountType === 'percent') {
                $discountedPrice = $originalPrice * (1 - $discountAmount / 100);
            } else { // fixed
                $discountedPrice = $originalPrice - $discountAmount;
            }

            // Negatif fiyat kontrolü
            $discountedPrices[$index] = max(0, $discountedPrice);
        }

        return $discountedPrices;
    }

    /**
     * Toplam tasarruf hesapla
     */
    private function calculateSavings($originalPrices, $discountedPrices)
    {
        $totalSavings = 0;
        
        foreach ($originalPrices as $index => $originalPrice) {
            $discountedPrice = $discountedPrices[$index] ?? $originalPrice;
            $totalSavings += ((float) $originalPrice - (float) $discountedPrice);
        }

        return round($totalSavings, 2);
    }

    /**
     * Kupon istatistikleri için endpoint
     */
    public function getCouponStats()
    {
        try {
            $pricingSection = $this->findPricingSection();
            
            if (!$pricingSection) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pricing section bulunamadı'
                ], 404);
            }

            $couponCodes = $pricingSection->content['coupon_codes'] ?? [];
            $activeCoupons = array_filter($couponCodes, function($coupon) {
                return ($coupon['is_active'] ?? false) && 
                       $this->isCouponValid($coupon);
            });

            return response()->json([
                'success' => true,
                'total_coupons' => count($couponCodes),
                'active_coupons' => count($activeCoupons),
                'coupons' => array_map(function($coupon) {
                    return [
                        'code' => $coupon['coupon_code'],
                        'name' => $coupon['coupon_name'][app()->getLocale()] ?? $coupon['coupon_name'],
                        'discount_type' => $coupon['discount_type'],
                        'discount_amount' => $coupon['discount_amount'],
                        'valid_until' => $coupon['valid_until'] ?? null,
                        'is_active' => $coupon['is_active'] ?? false
                    ];
                }, $activeCoupons)
            ]);

        } catch (\Exception $e) {
            \Log::error('Coupon stats error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu'
            ], 500);
        }
    }

    /**
     * Kupon geçerlilik kontrolü
     */
    private function isCouponValid($coupon)
    {
        // Geçerlilik tarihi kontrolü
        if (!empty($coupon['valid_until'])) {
            $validUntil = Carbon::createFromFormat('Y-m-d', $coupon['valid_until'])->endOfDay();
            if (Carbon::now()->isAfter($validUntil)) {
                return false;
            }
        }

        return true;
    }
}