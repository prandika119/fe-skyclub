<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// auth
Route::get('users/login', function () {
    return view('auth.login');
})->name('login');
Route::get('users/register', function () {
    return view('auth.register');
})->name('register');

Route::get('users/profile-user', function () {
    return view('profiles.profile');
})->name('profile.show');

// Forgot password
Route::get('users/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');
Route::get('users/reset-password', function () {
    return view('auth.set-password');
});


// Sparing
Route::get('sparing', function () {
    return view('bookings.sparing');
})->name('sparings.index');

// jadwal lapangan
Route::get('field-schedule', function () {
    return view('bookings.detailsewa');
})->name('schedule.index');

// reschedule
Route::get('reschedule/{id}', function () {
    return view('bookings.reschedule');
})->name('reschedule');

// payment
Route::get('payment/{id}', function () {
    return view('payments.detailPembayaran');
})->name('payment.index');
Route::get('payment-success', function () {
    return view('payments.pembayaranBerhasil');
})->name('payment.success');

// Wallet
Route::get('wallet', function () {
    return view('wallets.detailWallet');
})->name('wallet.index');
Route::get('wallet/topup', function () {
    return view('wallets.detailTopUp');
})->name('wallet.topup');
Route::get('wallet/withdraw', function () {
    return view('wallets.detailWithdraw');
})->name('wallet.withdraw');

// Notifications
Route::get('notification', function () {
    return view('profiles.notifikasi');
})->name('notifications.index');


// Article
Route::get('articles', function () {
    return view('articles.userIndex');
})->name('article.index');
Route::view('/articles/{id}', 'articles.articledetail')->where('id', '[0-9]+');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    // Field
    Route::get('/field-photo', function () {
        return view('admin.field.fieldPhotos');
    })->name('field.photo');
    Route::get('/field-description', function () {
        return view('admin.field.description');
    })->name('field.description');

    // Profile
    Route::get('/profile', function () {
        return view('profiles.profileAdmin');
    })->name('profile');

    // Bookings
    // Melihat semua booking
    Route::get('/all-booking', function () {
        return view('admin.booking.allBooking');
    })->name('booking.allBooking');
    // Reschedule booking
    Route::get('/reschedule-booking', function () {
        return view('admin.booking.rescheduleBooking');
    })->name('booking.reschedule');
    // Cancel booking
    Route::get('/cancel-booking', function () {
        return view('admin.booking.cancelBooking');
    })->name('booking.cancel');

    // Article
    Route::get('/articles', function () {
        return view('admin.article.article');
    })->name('articles');

    // Voucher
    Route::get('/voucher', function () {
    return view('admin.voucher.voucher');
    })->name('voucher');
});

