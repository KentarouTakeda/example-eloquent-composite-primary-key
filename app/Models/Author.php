<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $author_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 * @method static \Database\Factories\AuthorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Author query()
 * @mixin \Eloquent
 */
class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;

    protected $primaryKey = 'author_id';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * @return HasMany<Book, $this>
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_id');
    }
}
