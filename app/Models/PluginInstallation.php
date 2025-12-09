<?php
// app/Models/PluginInstallation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PluginInstallation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plugin_installations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'plugin_id',
        'version',
        'action',
        'status',
        'message',
        'details',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'details' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Action types
     */
    const ACTION_INSTALL = 'install';
    const ACTION_UPDATE = 'update';
    const ACTION_UNINSTALL = 'uninstall';
    const ACTION_ACTIVATE = 'activate';
    const ACTION_DEACTIVATE = 'deactivate';

    /**
     * Status types
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    /**
     * Get the plugin that owns the installation.
     */
    public function plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class);
    }

    /**
     * Get the user that performed the installation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include successful installations.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', self::STATUS_SUCCESS);
    }

    /**
     * Scope a query to only include failed installations.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    /**
     * Scope a query to only include installations by action.
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Check if the installation is successful.
     */
    public function isSuccessful(): bool
    {
        return $this->status === self::STATUS_SUCCESS;
    }

    /**
     * Check if the installation failed.
     */
    public function isFailed(): bool
    {
        return $this->status === self::STATUS_FAILED;
    }

    /**
     * Check if the installation is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if the installation is processing.
     */
    public function isProcessing(): bool
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    /**
     * Get the action label.
     */
    public function getActionLabelAttribute(): string
    {
        return match($this->action) {
            self::ACTION_INSTALL => 'Yükleme',
            self::ACTION_UPDATE => 'Güncelleme',
            self::ACTION_UNINSTALL => 'Kaldırma',
            self::ACTION_ACTIVATE => 'Etkinleştirme',
            self::ACTION_DEACTIVATE => 'Devre Dışı Bırakma',
            default => ucfirst($this->action),
        };
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Bekliyor',
            self::STATUS_PROCESSING => 'İşleniyor',
            self::STATUS_SUCCESS => 'Başarılı',
            self::STATUS_FAILED => 'Başarısız',
            default => ucfirst($this->status),
        };
    }

    /**
     * Get the status color for UI.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_PROCESSING => 'info',
            self::STATUS_SUCCESS => 'success',
            self::STATUS_FAILED => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Set the installation as processing.
     */
    public function markAsProcessing(string $message = null): void
    {
        $this->update([
            'status' => self::STATUS_PROCESSING,
            'message' => $message,
        ]);
    }

    /**
     * Set the installation as successful.
     */
    public function markAsSuccessful(string $message = null, array $details = []): void
    {
        $this->update([
            'status' => self::STATUS_SUCCESS,
            'message' => $message,
            'details' => array_merge($this->details ?? [], $details),
        ]);
    }

    /**
     * Set the installation as failed.
     */
    public function markAsFailed(string $message = null, array $details = []): void
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'message' => $message,
            'details' => array_merge($this->details ?? [], $details),
        ]);
    }

    /**
     * Get formatted created at date.
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    /**
     * Get duration of the installation process.
     */
    public function getDurationAttribute(): ?string
    {
        if ($this->status === self::STATUS_PROCESSING || $this->status === self::STATUS_PENDING) {
            return null;
        }

        $seconds = $this->updated_at->diffInSeconds($this->created_at);

        if ($seconds < 60) {
            return $seconds . ' saniye';
        } elseif ($seconds < 3600) {
            return round($seconds / 60) . ' dakika';
        } else {
            return round($seconds / 3600, 1) . ' saat';
        }
    }
}
