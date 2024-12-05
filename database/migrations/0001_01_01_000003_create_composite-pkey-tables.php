<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 著者: authors
        Schema::create('authors', function (Blueprint $table) {
            $table->bigInteger('author_id');

            $table->primary(['author_id']);
        });

        // 書籍: books
        Schema::create('books', function (Blueprint $table) {
            $table->bigInteger('author_id');
            $table->bigInteger('book_id');

            $table->primary(['author_id', 'book_id']);

            $table->foreign('author_id')->references('author_id')->on('authors');
        });

        // コメント: comments
        Schema::create('comments', function (Blueprint $table) {
            $table->bigInteger('author_id');
            $table->bigInteger('book_id');
            $table->bigInteger('comment_id');

            $table->primary(['author_id', 'book_id', 'comment_id']);

            $table->foreign(['author_id', 'book_id'])->references(['author_id', 'book_id'])->on('books');
        });
    }
};
