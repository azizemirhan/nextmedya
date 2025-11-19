<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MeetingRequest extends Model
{
    protected $fillable = [
        'form_type',
        'name',
        'email',
        'phone',
        'company',
        'preferred_date',
        'preferred_time',
        'preferred_time_slot',
        'alternative_date',
        'alternative_time',
        'contact_methods',
        'meeting_type',
        'meeting_platform',
        'topic',
        'message',
        'ip',
        'user_agent',
        'referrer',
        'status',
        'is_read',
    ];

    protected $casts = [
        'contact_methods' => 'array',
        'preferred_date' => 'date',
        'alternative_date' => 'date',
        'is_read' => 'boolean',
    ];

    // Meeting topics
    public static $topics = [
        'new_project' => 'Yeni Proje Görüşmesi',
        'consultation' => 'Danışmanlık',
        'quotation' => 'Fiyat Teklifi',
        'support' => 'Teknik Destek',
        'partnership' => 'İş Birliği',
        'other' => 'Diğer',
    ];

    // Time slots
    public static $timeSlots = [
        'morning' => 'Sabah (09:00 - 12:00)',
        'afternoon' => 'Öğleden Sonra (13:00 - 17:00)',
        'evening' => 'Akşam (17:00 - 19:00)',
    ];

    // Meeting types
    public static $meetingTypes = [
        'online' => 'Online Toplantı',
        'office' => 'Ofisimizde',
        'client_office' => 'Sizin Ofisinizde',
    ];

    // Contact methods
    public static $contactMethods = [
        'phone' => 'Telefon',
        'video' => 'Video Konferans',
        'email' => 'E-posta',
        'whatsapp' => 'WhatsApp',
    ];

    // Platforms
    public static $platforms = [
        'zoom' => 'Zoom',
        'teams' => 'Microsoft Teams',
        'google_meet' => 'Google Meet',
        'skype' => 'Skype',
    ];

    public function getTopicLabelAttribute()
    {
        return self::$topics[$this->topic] ?? $this->topic;
    }

    public function getPreferredTimeLabelAttribute()
    {
        return self::$timeSlots[$this->preferred_time] ?? $this->preferred_time;
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('preferred_date', '>=', Carbon::today())
                     ->where('status', '!=', 'cancelled');
    }
}