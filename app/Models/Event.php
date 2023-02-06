<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $date = ['created_at', 'updated_at', 'event_date'];

    public function eventImages(): HasMany
    {
        return $this->hasMany(EventImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
