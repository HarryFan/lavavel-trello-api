<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListModel extends Model
{
  use HasFactory;

  /**
   * 指定資料表名稱
   *
   * @var string
   */
  protected $table = 'lists';

  /**
   * 可批量賦值的屬性
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'board_id',
    'title',
    'position',
  ];

  /**
   * 取得此清單所屬的看板
   */
  public function board(): BelongsTo
  {
    return $this->belongsTo(Board::class);
  }

  /**
   * 取得此清單的所有卡片
   */
  public function cards(): HasMany
  {
    return $this->hasMany(Card::class, 'list_id')->orderBy('position');
  }
}
