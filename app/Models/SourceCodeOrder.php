<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SourceCodeOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'source_code_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'amount',
        'currency',
        'notes',
        'payment_status',
        'payment_method',
        'payment_proof',
        'paid_at',
        'status',
        'download_token',
        'download_count',
        'max_downloads',
        'expires_at',
        'admin_notes',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'download_count' => 'integer',
        'max_downloads' => 'integer',
        'paid_at' => 'datetime',
        'expires_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sourceCode(): BelongsTo
    {
        return $this->belongsTo(SourceCode::class, 'source_code_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scopes
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->where('payment_status', 'paid');
    }

    // Accessors & Mutators
    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && Carbon::now()->isAfter($this->expires_at);
    }

    public function getCanDownloadAttribute(): bool
    {
        return $this->status === 'approved'
            && !$this->is_expired
            && $this->download_count < $this->max_downloads;
    }

    // Helper Methods
    public static function generateOrderNumber(): string
    {
        $date = Carbon::now()->format('Ymd');
        $lastOrder = static::whereDate('created_at', Carbon::today())
            ->latest('id')
            ->first();

        $number = $lastOrder ? ((int) substr($lastOrder->order_number, -4)) + 1 : 1;

        return sprintf('ORD-%s-%04d', $date, $number);
    }

    public function generateDownloadToken(): string
    {
        $token = Str::random(64);
        $this->update(['download_token' => $token]);
        return $token;
    }

    public function approve(User $approver, ?string $notes = null): bool
    {
        if (!$this->download_token) {
            $this->generateDownloadToken();
        }

        return $this->update([
            'status' => 'approved',
            'approved_at' => Carbon::now(),
            'approved_by' => $approver->id,
            'admin_notes' => $notes ?? $this->admin_notes,
            'expires_at' => Carbon::now()->addHours(24), // 24 hour expiry
        ]);
    }

    public function reject(?string $notes = null): bool
    {
        return $this->update([
            'status' => 'rejected',
            'admin_notes' => $notes ?? $this->admin_notes,
        ]);
    }

    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');

        // Mark as completed if reached max downloads
        if ($this->download_count >= $this->max_downloads) {
            $this->update(['status' => 'completed']);
        }
    }
}
