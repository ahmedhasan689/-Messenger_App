<?php

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ConversationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('conversations', [ConversationController::class, 'index']);
    Route::get('conversations/{conversation}', [ConversationController::class, 'show']);
    Route::post('conversations/{conversation}/participants', [ConversationController::class, 'addParticipants']);
    Route::delete('conversations/{conversation}/participants', [ConversationController::class, 'removeParticipants']);

    Route::get('conversations/{id}/messages', [MessagesController::class, 'index']);
    Route::post('messages', [MessagesController::class, 'store'])->name('api.messages.store');
    Route::delete('messages/{id}', [MessagesController::class, 'destroy']);

});
