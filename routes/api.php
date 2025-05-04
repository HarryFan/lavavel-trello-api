<?php
/**
 * API 路由設定
 *
 * @author HarryFan
 * @see Airbnb JavaScript Style Guide
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Controllers\AuthController;

// 認證相關
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

// Trello 主要功能
Route::middleware('auth:sanctum')->group(function () {
  // 看板
  Route::apiResource('boards', BoardsController::class);
  // 清單
  Route::apiResource('lists', ListsController::class);
  // 卡片
  Route::apiResource('cards', CardsController::class);
  // 通知設定
  Route::apiResource('notification-settings', NotificationSettingsController::class);
});
