<?php

use App\Http\Controllers\ProfileController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\historyBooking;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminFieldController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\newController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/main', function (){
    return view('home');
})->name('main');

Route::get('/infor', function () {
    return view('profile.news.infor');
})->name('news.infor');

Route::get('/booking/history', function () {
    $query = Booking::where('user_id', auth()->id())->with('field')->latest();
    if (request('status') === 'paid') {
        $query->where('status', 'paid');
    } elseif (request('status') === 'unpaid') {
        $query->where('status', 'unpaid')->orWhereNull('status');
    } elseif (request('status') === 'canceled') {
        $query->where('status', 'canceled');
    }
    $history = $query->get();
    return view('booking.history', compact('history'));
})->middleware('auth')->name('booking.history');



// Route::get('/review', function(){
//     return view('profile.news.review');
// })->name('news.review');  
Route::get('/news', [ArticleController::class, 'index'])->name('profile.news.news');
Route::get('/booking', [BookingController::class, 'showBookingForm'])->name('components.partials.booking');
Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/news/{id}/read', [newController::class, 'readMore'])->name('news.read_more');

require __DIR__.'/auth.php';
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', AdminUserController::class, ['as' => 'admin']);
    Route::resource('fields', AdminFieldController::class, ['as' => 'admin']);
    Route::resource('bookings', AdminBookingController::class, ['as' => 'admin']);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    Route::get('articles-stats', [\App\Http\Controllers\Admin\ArticleController::class, 'stats'])->name('articles.stats');
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('videos', App\Http\Controllers\Admin\VideoController::class, [
        'as' => 'admin'
    ]);
});

Route::post('/videos/{video}/increase-view', [App\Http\Controllers\VideoController::class, 'increaseView'])->name('videos.increaseView');
Route::post('/infor/send-email', [\App\Http\Controllers\InforController::class, 'sendEmail'])->name('infor.sendEmail');
Route::get('/payment/{booking}', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment');
Route::post('/payment/{booking}/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/{item}', function ($item) {
    return view('payment', compact('item'));
})->name('payment');
Route::get('/redirect-after-login', function () {
    if (auth()->user()->role === 'admin') { // hoặc is_admin nếu bạn dùng cột này
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('main'); // hoặc route trang chủ user
})->middleware('auth');