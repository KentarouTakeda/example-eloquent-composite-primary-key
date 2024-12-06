<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $author_id
 * @property int $book_id
 * @property-read \App\Models\Author $author
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @method static \Database\Factories\BookFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Book query()
 * @mixin \Eloquent
 */
class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $primaryKey = '複合キーのため主キー未設定';
    public $incrementing = false;
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'book_id';
    }

    /**
     * @return BelongsTo<Author, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    /**
     * @return HasMany<Comment, $this>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'book_id', 'book_id')->where('author_id', $this->author_id);
    }
}
