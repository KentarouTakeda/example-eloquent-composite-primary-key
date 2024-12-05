<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @var Collection<int, Author> */
    private Collection $authors;

    /** @var Collection<int, Book> */
    private Collection $books;

    /** @var Collection<int, Comment> */
    private Collection $comments;

    public function setUp(): void
    {
        parent::setUp();

        $this->authors = collect([
            Author::factory()->create(['author_id' => 1]),
            Author::factory()->create(['author_id' => 2]),
        ]);

        $this->books = collect([
            Book::factory()->create(['author_id' => 1, 'book_id' => 11]),
            Book::factory()->create(['author_id' => 1, 'book_id' => 12]),
            Book::factory()->create(['author_id' => 2, 'book_id' => 11]),
            Book::factory()->create(['author_id' => 2, 'book_id' => 12]),
        ]);

        $this->comments = collect([
            Comment::factory()->create(['author_id' => 1, 'book_id' => 11, 'comment_id' => 101]),
            Comment::factory()->create(['author_id' => 1, 'book_id' => 11, 'comment_id' => 102]),
            Comment::factory()->create(['author_id' => 2, 'book_id' => 11, 'comment_id' => 101]),
            Comment::factory()->create(['author_id' => 2, 'book_id' => 11, 'comment_id' => 102]),
        ]);
    }

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
        $this->assertCount(2, $book->comments);
    }

    #[Test]
    public function commentBelongsToBook(): void
    {
        $comment = $this->comments->first();

        $this->assertInstanceOf(Book::class, $comment->book);
        $this->assertCount(1, $comment->book()->get());
    }
}
