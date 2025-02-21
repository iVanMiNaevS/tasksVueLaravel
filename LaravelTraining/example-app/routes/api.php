<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/p', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/users", [AuthController::class, "getAll"]);

Route::post("/registration", [AuthController::class, "registration"]);
Route::post("/authorization", [AuthController::class, "login"]);

Route::get("/user/{user}", [AuthController::class, "user"])->middleware('auth:sanctum');
Route::post("/logout", [AuthController::class, "logout"])->middleware('auth:sanctum');

Route::post("/tasks", [TasksController::class, "add"])->middleware('auth:sanctum');
Route::post("/tasks/{task}/access", [TasksController::class, "addUsers"])->middleware('auth:sanctum');
Route::get("/tasks/{task}/access", [TasksController::class, "getUsers"])->middleware('auth:sanctum');
Route::delete("/tasks/{task}/access", [TasksController::class, "deleteUsers"])->middleware('auth:sanctum');
Route::get("/tasks/disk", [TasksController::class, "disk"])->middleware('auth:sanctum');
Route::get("/tasks/shared", [TasksController::class, "shared"])->middleware('auth:sanctum');
Route::get("/tasks/{id}", [TasksController::class, "getOne"])->middleware('auth:sanctum');
Route::delete("/tasks/{task}", [TasksController::class, "delete"])->middleware('auth:sanctum');
Route::patch("/tasks/{id}", [TasksController::class, "update"])->middleware('auth:sanctum');
