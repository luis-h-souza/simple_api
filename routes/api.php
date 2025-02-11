<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/status', [ApiController::class, 'status']);
Route::get('/clients', [ApiController::class, 'clients']);
Route::get('/client-by-id/{id}', [ApiController::class, 'clientById']);
Route::post('/client', [ApiController::class, 'client']);

// Adicionar registro de um cliente
Route::post('/add-client', [ApiController::class, 'addClient']);

// Atualizar registro do cliente
Route::put('/update-client', [ApiController::class, 'updateClient']);

//Deleta registro de clientes
Route::delete('/delete-client/{id}', [ApiController::class, 'deleteClient']);
