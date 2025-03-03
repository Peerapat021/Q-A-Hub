<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListpostController;
use App\Http\Controllers\ListcategoriesController;
use App\Http\Controllers\EditcategoriesController;
use Illuminate\Support\Facades\Route;

// หน้าแรกและหน้า Welcome
Route::get('/', [WelcomeController::class, 'index'])->name('welcome2');

// หน้า Home (ต้องมีการตรวจสอบสิทธิ์)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/myposts', [PostController::class, 'myPosts'])->name('posts.myposts');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// หน้าโพสต์
Route::resource('posts', PostController::class);
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{id}/posts', [PostController::class, 'showPosts'])->name('showPosts');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


// หน้า Admin (ต้องมีการตรวจสอบสิทธิ์และเป็นแอดมิน)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/adminlistpost', [AdminController::class, 'adminlistpost'])->name('adminlistpost');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edituser'])->name('admin.edit_User');
});


// หน้า Category
Route::resource('categories', CategoryController::class);
Route::get('/categories/{id}/posts', [CategoryController::class, 'showPosts'])->name('categories.showPosts');

// หน้า Comment
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::middleware('auth')->group(function () {
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// หน้า List Post และ List Category
Route::middleware('auth')->group(function () {
    Route::get('/listpost', [ListpostController::class, 'index'])->name('listpost');
    Route::get('/listcategories', [ListcategoriesController::class, 'index'])->name('listcategories');
});

// การรวมเส้นทางสำหรับการยืนยันตัวตน
require __DIR__ . '/auth.php';




/*ไม่เกี่ยวว*/
/*
 <?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListpostController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListcategoriesController;
use App\Http\Controllers\EditcategoriesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome2');
});



Route::get('/', [WelcomeController::class, 'index'])->name('welcome2');

Route::get('/welcome2', [WelcomeController::class, 'index']);



route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
route::get('post', [HomeController::class, 'post'])->middleware(['auth', 'admin']);
route::get('reder', [HomeController::class, 'reder'])->middleware(['auth', 'user']);
// เพิ่ม route resource สำหรับ PostController
Route::resource('posts', PostController::class);



Route::get('/welcome2', [WelcomeController::class, 'index'])->name('welcome2');

Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/myposts', [PostController::class, 'myPosts'])->name('posts.myposts');


Route::get('/admin/home', [AdminController::class, 'index'])->middleware('auth')->name('admin.home');
Route::get('/adminlistpost', [AdminController::class, 'adminlistpost'])->middleware('auth')->name('adminlistpost');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('show');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{id}/posts', [PostController::class, 'showPosts'])->name('showPosts');


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->middleware('auth')->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->middleware('auth')->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');


Route::resource('categories', CategoryController::class);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

// Route สำหรับแสดงฟอร์มแก้ไขหมวดหมู่
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route สำหรับบันทึกการแก้ไขหมวดหมู่
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');


Route::get('/categories/{id}/posts', [CategoryController::class, 'showPosts'])->name('categories.showPosts');

// เส้นทางสำหรับ ListcategoriesController
Route::get('/listcategories', [ListcategoriesController::class, 'index'])->name('categories.index');
Route::get('/listcategories', [ListcategoriesController::class, 'index'])->name('listcategories');
Route::get('/listpost', [ListpostController::class, 'index'])->middleware('auth')->name('listpost');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route สำหรับดึงข้อมูลผู้ใช้
Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users.index');
// Route สำหรับการแก้ไขผู้ใช้
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth')->name('users.update');
// Route สำหรับการลบผู้ใช้
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('users.destroy');
Route::get('/users/{id}/edituser', [UserController::class, 'edituser'])->middleware('auth')->name('users.edituser');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('users.destroy');


require __DIR__ . '/auth.php';

*/
