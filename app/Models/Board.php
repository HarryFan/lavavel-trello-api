<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\ListModel;

class Board extends Model
{
    use HasFactory;

    /**
     * 可批量賦值的屬性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',
    ];

    /**
     * 取得擁有此看板的使用者
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 取得此看板的所有清單
     */
    public function lists(): HasMany
    {
        return $this->hasMany(ListModel::class)->orderBy('position');
    }
}
