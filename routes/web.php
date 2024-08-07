<?php


use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;

Route::get("aa",function (){
    \Illuminate\Support\Facades\Artisan::call("migrate:fresh --seed");
});

//Route::get("send/test",function (){
//    $twilioSid = config('app.TWILIO_SID');
//    $twilioToken = config('app.TWILIO_AUTH_TOKEN');
//    $twilioWhatsAppNumber = "whatsapp:" . config('app.TWILIO_WHATSAPP_SENDER');
//    $recipientNumber = 'whatsapp:+972595544707'; // Replace with the recipient's phone number in WhatsApp format (e.g., "whatsapp:+1234567890")
//    $message = "Hello from Twilio WhatsApp API in Laravel! 🚀";
//
//    $twilio = new Client($twilioSid, $twilioToken);
//
//    try {
//        $twilio->messages->create(
//            'whatsapp:+972595544707',
//            [
//                "from" => $twilioWhatsAppNumber,
//                "body" => $message,
//            ]
//        );
//
//        return response()->json(['message' => $twilioWhatsAppNumber .'WhatsApp message sent successfully']);
//    } catch (\Exception $e) {
//        return response()->json(['error' => $e->getMessage()], 500);
//    }
//});


Route::post('locale',[\App\Http\Controllers\LanguageController::class,'switch'])->name('language.switch');

//Route::get('/', function () {
//    return view('welcome');
//});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'loginIndex'])->name('login.index');
    Route::post('/login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'login'])->name('login.store');
});
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users',[\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/station/{id}',[\App\Http\Controllers\Admin\UpdatePhaseController::class, 'indexPage'])->name('update.index');
    Route::get('/user/show/{id}',[\App\Http\Controllers\Admin\UserController::class, 'showUser'])->name('user.show');
    Route::get('/logout', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'logout'])->name('logout');
});

                                        ///   User   ///
Route::middleware('guest')->name('user.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\User\Auth\AuthController::class, 'loginIndex'])->name('login.index');
    Route::post('/login', [\App\Http\Controllers\User\Auth\AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [\App\Http\Controllers\User\Auth\AuthController::class, 'registerIndex'])->name('register.index');
    Route::post('/register', [\App\Http\Controllers\User\Auth\AuthController::class, 'register'])->name('register.store');
});
//Route::middleware('auth')->group(function () {
//    Route::get('/dashboard',[\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
//    Route::get('/profile',[\App\Http\Controllers\User\ProfileController::class, 'index'])->name('user.profile');
//    Route::post('/profile/{id}',[\App\Http\Controllers\User\ProfileController::class, 'show'])->name('user.profile.show');
//    Route::post('/profile',[\App\Http\Controllers\User\ProfileController::class, 'edit'])->name('user.profile.edit');
//    Route::post('/update',[\App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');
//    Route::get('/logout', [\App\Http\Controllers\User\Auth\AuthController::class, 'logout'])->name('logout');
//});
