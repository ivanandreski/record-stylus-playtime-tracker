<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Livewire\Home::class, '__invoke'])->name('home');

Route::get('/collection', [App\Http\Livewire\CollectionView::class, '__invoke'])->name('collection-view');

Route::get('/play-session', [App\Http\Livewire\PlaySessionsView::class, '__invoke'])->name('play-sessions-view');
Route::get('/play-session/{playSession}', [App\Http\Livewire\PlaySessionDetails::class, '__invoke']); 

Route::get('/stylus', [App\Http\Livewire\StylusView::class, '__invoke'])->name('stylus-view');
Route::get('/stylus/{stylus}', [App\Http\Livewire\StylusDetails::class, '__invoke']);
