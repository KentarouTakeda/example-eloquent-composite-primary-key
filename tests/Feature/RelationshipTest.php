<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Comment;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RelationshipTest extends TestCase
{
    #[Test]
    public function authorHasManyBooks(): void
    {
        $author = $this->authors->first();

        $this->assertInstanceOf(Book::class, $author->books->first());
        $this->assertCount(2, $author->books);
    }

    #[Test]
    public function bookBelongsToAuthor(): void
    {
        $book = $this->books->first();

        $this->assertInstanceOf(Author::class, $book->author);
        $this->assertCount(1, $book->author()->get());
    }

    #[Test]
    public function bookHasManyComments(): void
    {
        $book = $this->books->first();

        $this->assertInstanceOf(Comment::class, $book->comments->first());
        $this->assertCount(3, $book->comments);
    }

    #[Test]
    public function commentBelongsToBook(): void
    {
        $comment = $this->comments->first();

        $this->assertInstanceOf(Book::class, $comment->book);
        $this->assertCount(1, $comment->book()->get());
    }
}
