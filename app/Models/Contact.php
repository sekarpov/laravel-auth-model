<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @method Builder forUser(User $user)
 * @method Builder favoredByUser(User $user)
 */
class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'contact_favorites', 'contact_id', 'user_id');
    }

    public function scopeFavoredByUser(Builder $query, User $user)
    {
        return $query->whereHas('favorites', function(Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
}
