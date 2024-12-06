<?php

namespace Tests;

use App\Models\Author;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Collection;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /** @var Collection<int, Author> */
    protected Collection $authors;

    /** @var Collection<int, Book> */
    protected Collection $books;

    /** @var Collection<int, Comment> */
    protected Collection $comments;

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
            Comment::factory()->create(['author_id' => 1, 'book_id' => 11, 'comment_id' => 103]),
            Comment::factory()->create(['author_id' => 2, 'book_id' => 11, 'comment_id' => 101]),
            Comment::factory()->create(['author_id' => 2, 'book_id' => 11, 'comment_id' => 102]),
            Comment::factory()->create(['author_id' => 2, 'book_id' => 11, 'comment_id' => 103]),
        ]);
    }
}
