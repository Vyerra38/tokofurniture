<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'recipient_name',
        'phone',
        'address',
        'city',
        'postal_code',
        'notes',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp' . number_format((float) $this->subtotal, 0, ',', '.');
    }

    public function getFormattedShippingCostAttribute(): string
    {
        return 'Rp' . number_format((float) $this->shipping_cost, 0, ',', '.');
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp' . number_format((float) $this->total, 0, ',', '.');
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'Menunggu Pembayaran' => 'bg-amber-100 text-amber-800 border-amber-300',
            'Diproses' => 'bg-blue-100 text-blue-800 border-blue-300',
            'Dikemas' => 'bg-purple-100 text-purple-800 border-purple-300',
            'Dikirim' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
            'Selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'Dibatalkan' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }
}
