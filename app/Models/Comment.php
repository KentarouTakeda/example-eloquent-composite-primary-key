<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $author_id
 * @property int $book_id
 * @property int $comment_id
 * @method static \Database\Factories\CommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Comment query()
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $primaryKey = '複合キーのため主キー未設定';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * @return BelongsTo<Book, $this>
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id')->where('author_id', $this->author_id);
    }
}
