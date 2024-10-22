<?php

use App\Models\Book;
use App\Models\Category;
use App\Jobs\SendReminderEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authentication;
use App\Http\Controllers\bookController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\authorController;
use App\Http\Controllers\recordController;
use App\Http\Controllers\categoryController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\CustomAuthentication;
use App\Http\Controllers\borrowbookController;
use App\Http\Controllers\reminderController;

// Route::view('home','home');
Route::view('borrow_book', 'borrow_book');
Route::view('book_detail', 'book_detail');
Route::view('create', 'create');
Route::view('author', 'author');
Route::view('dashboard', 'dashboard');
Route::view('author/author_detail', 'author/author_detail');
Route::view('author/addauthor', 'author/addauthor');
Route::view('category/categorylist', 'category/categorylist');
Route::view('category/addcategory', 'category/addcategory');
Route::view('book/addbook', 'book/addbook');
Route::view('book/showbook', 'book/showbook');
Route::view('records/record', 'records/record');

Route::middleware([Authentication::class])->group(function () {
    //register
    Route::get('/', function () {
        return view('register');
    });
    Route::post('register', [loginController::class, 'register']);
    Route::view('register', 'register');

    //login
    Route::view('login', 'login');
    Route::post('/login', [loginController::class, 'login']);
});

//dashboard

//multiple authentication
Route::get('/dashboard', [adminController::class, 'dashboard']);


//bookdetail-----------------------

//categoryadd with foreign key
//authoradd with foreign key
Route::get('book/addbook', [bookController::class, 'bookform']);

//booklist
Route::get('book/showbook', [bookController::class, 'showbook'])->name('book.list');

//tabel ssp
Route::get('booklist', [bookController::class, 'listBook'])->name('book.list');

//addbook
Route::post('book/addbook', [bookController::class, 'addbook']);

//update
Route::get('book/updatebook/{id}', [bookController::class, 'editbook']);
Route::post('book/updatebook/{id}', [bookController::class, 'updatebook']);



//multiple delete

Route::post('/books/delete-multiple', [bookController::class, 'deleteMultiple'])->name('books.deleteMultiple');



//categorydetail-----------------------------------------
//show
Route::get('category/categorylist', [categoryController::class, 'showcategory'])->name('category.list');

//tabel ssp
Route::get('categorylist', [CategoryController::class, 'listCategory'])->name('category.list');

//add
Route::post('category/addcategory', [categoryController::class, 'add']);

//update
Route::get('category/updatecategory/{id}', [categoryController::class, 'edit']);
Route::post('category/updatecategory/{id}', [categoryController::class, 'update']);



//multiple delete
Route::post('/categories/delete-multiple', [categoryController::class, 'deleteMultiple'])->name('category.deleteMultiple');

// Soft delete a book
Route::delete('/category/{id}/soft-delete', [categoryController::class, 'softDelete']);





//authordetail--------------------------------------------
//show
Route::get('author/author_detail', [authorController::class, 'showauthor'])->name('author.list');

//tabel ssp
Route::get('authorlist', [authorController::class, 'listAuthor'])->name('author.list');

//add
Route::post('author/addauthor', [authorController::class, 'add']);

//update
Route::get('author/update/{id}', [authorController::class, 'edit']);

Route::post('author/update/{id}', [authorController::class, 'update']);


//multiple delete

Route::post('/authors/delete-multiple', [AuthorController::class, 'deleteMultiple'])->name('authors.deleteMultiple');




//records--------------------------
Route::get('records/record', [recordController::class, 'showrecord'])->name('record.list');

//tabel ssp
Route::get('recordlist', [recordController::class, 'listrecord'])->name('record.list');

//delete
Route::get('record/delete/{id}', [recordController::class, 'delete']);

//multiple delete

Route::post('/records/delete-multiple', [recordController::class, 'deleteMultiple'])->name('records.deleteMultiple');




//Home page ------------------
//bookdetail show
Route::get('home', [homeController::class, 'index']);

//borrow book
Route::get('/book_detail/{id}', [homeController::class, 'bookdetail']);


//store && borrow book&& return book

Route::post('borrow/{id}', [recordController::class, 'borrowBook'])->name('borrow.book');
Route::post('return/{id}', [borrowbookController::class, 'returnBook'])->name('return.book');


// web.php (Routes file)
Route::get('/borrow_book', [borrowbookController::class, 'showProfile']);





//logout
Route::get('/logout', [loginController::class, 'logout']);

Route::get('books-data', [bookController::class, 'getBooksData'])->name('books.data');

// Route::get('/send-reminder-emails', [reminderController::class, 'sendReminderEmails']);