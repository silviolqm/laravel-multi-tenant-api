<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransacaoController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
Route::prefix('api')->group(function () {
    Route::middleware([
        'api',
        InitializeTenancyByDomain::class,
        PreventAccessFromCentralDomains::class,
    ])->group(function () {
        //Rota para retornar o Tenant atual
        Route::get('/', function () {
            return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
        });

        //Rotas não-autenticadas para cadastro e login de novos usuarios desse tenant
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

        //Rota de teste para mostrar todas as transacoes. Apenas para facilitar demonstração.
        Route::get('/testetransacoes', [TransacaoController::class, 'index']);

        //Rotas autenticadas
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/user', function (Request $request) {
                return $request->user();
            });
            Route::post('/logout', [AuthController::class, 'logout']);

            Route::post('/transacoes', [TransacaoController::class, 'store']);
            Route::get('/transacoes/{id}', [TransacaoController::class, 'show']);
            Route::match(['put', 'patch'], '/transacoes/{id}', [TransacaoController::class, 'update']);
            Route::delete('/transacoes/{id}', [TransacaoController::class, 'destroy']);
        });
    });
});
