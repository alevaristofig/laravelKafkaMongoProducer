<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsuarioMensagensController;
use App\Http\Controllers\Api\PacienteMensagensController;
use App\Http\Controllers\Api\MedicamentoMensagensController;
use App\Http\Controllers\Api\AplicacaoMensagensController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::group([
        'as' => 'usuarios'
    ],
        function() {
            Route::get('/usuarios',[UsuarioMensagensController::class,'index']);
            Route::post('/usuarios',[UsuarioMensagensController::class,'adicionar']);
            Route::get('/usuarios/produzirmensagem/{id}',[UsuarioMensagensController::class,'produzirMensagens']);
        }
    );

    Route::group([
        'as' => 'pacientes'
    ],
        function() {
            Route::get('/pacientes',[PacienteMensagensController::class,'index']);
            Route::post('/pacientes',[PacienteMensagensController::class,'adicionar']);
        }
    );

    Route::group([
        'as' => 'medicamentos'
    ],
        function() {
            Route::get('/medicamentos',[MedicamentoMensagensController::class,'index']);
            Route::post('/medicamentos',[MedicamentoMensagensController::class,'adicionar']);
        }
    );

    Route::group([
        'as' => 'aplicacao'
    ],
        function() {
            Route::get('/aplicacao',[AplicacaoMensagensController::class,'index']);
            Route::post('/aplicacao',[AplicacaoMensagensController::class,'adicionar']);
        }
    );
});
