<?php

use App\Models\Note;
use App\Models\NoteDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\NoteImageController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    return 'Halaman Dashboard';
});

Route::get('/notes', [NoteController::class, 'index'])->middleware('auth')->name('notes');
Route::get('/note/new', [NoteController::class, 'listNew'])->middleware('auth');
Route::get('/notes/division', [NoteController::class, 'listDivisionNote'])->middleware('auth');
Route::get('/notes/division/{id}', [NoteController::class, 'listNoteByDivisions'])->middleware('auth');
Route::get('/note/my', [NoteController::class, 'listMyNote'])->middleware('auth')->name('mynote');
Route::get('/note/trash', [NoteController::class, 'listTrashNote'])->middleware('auth');
Route::get('/note/alltrash', [NoteController::class, 'listAllTrashNote'])->middleware('is_admin');

Route::get('/notes/{note:slug}', [NoteController::class, 'show'])->middleware('auth');
Route::get('/notes/attendances/{note:slug}', [AttendanceController::class, 'index'])->middleware('auth');
Route::post('/notes/attendances/simpan', [AttendanceController::class, 'store'])->middleware('auth');
Route::delete('/notes/attendances/{attendance:id}', [AttendanceController::class, 'destroy'])->middleware('auth');

Route::get('/notes/images/{note:slug}', [NoteImageController::class, 'index'])->middleware('auth');
Route::post('/notes/images/simpan', [NoteImageController::class, 'store'])->middleware('auth');
Route::delete('/notes/images/{note_Image:id}', [NoteImageController::class, 'destroy'])->middleware('auth');


Route::get('/notes/create/form', [NoteController::class, 'formcreate'])->middleware('auth');
Route::post('/notes/simpan', [NoteController::class, 'store'])->middleware('auth');
Route::delete('/notes/{note:id}', [NoteController::class, 'delete'])->middleware('auth');
Route::get('/notes/{note:slug}/edit', [NoteController::class, 'edit'])->middleware('auth');
Route::put('/notes/{note:slug}/', [NoteController::class, 'update'])->middleware('auth');

Route::get('/notes/restore/{note:id}', [NoteController::class, 'restore'])->middleware('auth');
Route::get('/notes/forceDelete/{note:id}', [NoteController::class, 'forceDelete'])->middleware('auth');
Route::get('/note/word-export/{id}', [NoteController::class, 'wordExport']);

Route::get('/users', [UserController::class, 'index'])->middleware('auth');
Route::get('/users/{user:slug}', [UserController::class, 'show'])->middleware('auth');
Route::get('/users/create/form', [UserController::class, 'formcreate'])->middleware('is_admin');
Route::post('/users/simpan', [UserController::class, 'store'])->middleware('is_admin');
Route::get('/user/{user:slug}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::put('/user/{user:slug}/update', [UserController::class, 'update'])->middleware('auth');
Route::delete('/user/{user:slug}', [UserController::class, 'delete'])->middleware('auth');

Route::get('/users/edit/password', [UserController::class, 'editPassword'])->middleware('auth');
Route::put('/users/update/password/{user:slug}', [UserController::class, 'updatePassword'])->middleware('auth');
Route::get('/users/edit/data', [UserController::class, 'editUserData'])->middleware('auth');
Route::put('/users/update/data/{user:slug}', [UserController::class, 'updateUserData'])->middleware('auth');



Route::get('/histories', [HistoryController::class, 'index'])->middleware('auth');





