<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RouteModelBindingTest extends TestCase
{
    #[Test]
    public function customizedKey(): void
    {
        Route::get('{author}/{book:book_id}/{comment:comment_id}',
            fn (Author $author, Book $book, Comment $comment) => [
                'author' => $author,
                'book' => $book,
                'comment' => $comment,
            ]
        )->middleware(SubstituteBindings::class);

        $response = $this->json(Request::METHOD_GET, '2/11/102');

        $response->assertJsonPath('author.author_id', 2);
        $response->assertJsonPath('book.author_id', 2);
        $response->assertJsonPath('book.book_id', 11);
        $response->assertJsonPath('comment.author_id', 2);
        $response->assertJsonPath('comment.book_id', 11);
        $response->assertJsonPath('comment.comment_id', 102);
    }

    #[Test]
    public function scopedResources(): void
    {
        Route::resource('authors.books.comments', CommentController::class)
            ->middleware(SubstituteBindings::class)
            ->scoped([
                'author' => 'author_id',
                'book' => 'book_id',
                'comment' => 'comment_id',
            ])
        ;

        $response = $this->json(Request::METHOD_GET, 'authors/2/books/11/comments/102');

        $response->assertJsonPath('author.author_id', 2);
        $response->assertJsonPath('book.author_id', 2);
        $response->assertJsonPath('book.book_id', 11);
        $response->assertJsonPath('comment.author_id', 2);
        $response->assertJsonPath('comment.book_id', 11);
        $response->assertJsonPath('comment.comment_id', 102);
    }

    #[Test]
    public function defaultRouteKeyName(): void
    {
        Route::resource('authors.books.comments', CommentController::class)
            ->scoped()
            ->middleware(SubstituteBindings::class)
        ;

        $response = $this->json(Request::METHOD_GET, 'authors/2/books/11/comments/102');

        $response->assertJsonPath('author.author_id', 2);
        $response->assertJsonPath('book.author_id', 2);
        $response->assertJsonPath('book.book_id', 11);
        $response->assertJsonPath('comment.author_id', 2);
        $response->assertJsonPath('comment.book_id', 11);
        $response->assertJsonPath('comment.comment_id', 102);
    }
}

class CommentController
{
    public function show(Author $author, Book $book, Comment $comment)
    {
        return [
            'author' => $author,
            'book' => $book,
            'comment' => $comment,
        ];
    }
}
