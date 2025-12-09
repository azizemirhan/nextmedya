<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'form_type',
        'name',
        'email',
        'phone',
        'company',
        'service_type',
        'package_type',
        'package_price',
        'selected_features',
        'project_details',
        'budget_range',
        'timeline',
        'ip',
        'user_agent',
        'referrer',
        'is_read',
    ];

    protected $casts = [
        'selected_features' => 'array',
        'package_price' => 'decimal:2',
        'is_read' => 'boolean',
    ];

    // Service type labels
    public static $serviceTypes = [
        'web_design' => 'Web Tasarım',
        'mobile_app' => 'Mobil Uygulama',
        'seo' => 'SEO Optimizasyonu',
        'e_commerce' => 'E-Ticaret',
        'cms' => 'İçerik Yönetim Sistemi',
        'api_integration' => 'API Entegrasyonu',
        'custom_software' => 'Özel Yazılım',
    ];

    // Package types
    public static $packageTypes = [
        'basic' => 'Temel Paket',
        'professional' => 'Profesyonel Paket',
        'premium' => 'Premium Paket',
        'enterprise' => 'Kurumsal Paket',
    ];

    public function getServiceTypeLabelAttribute()
    {
        return self::$serviceTypes[$this->service_type] ?? $this->service_type;
    }

    public function getPackageTypeLabelAttribute()
    {
        return self::$packageTypes[$this->package_type] ?? $this->package_type;
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeByServiceType($query, $type)
    {
        return $query->where('service_type', $type);
    }
}