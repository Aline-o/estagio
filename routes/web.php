<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/', function () {
    return view('welcome');
});

/*
Route::get('/insere}', function() {
    return view('insere');
});

Route::get('/visualizar}', function() {
    return view('visualizar');
});




Route::get('/cAluno}', function() {
    return view('create/aluno');
});

Route::get('/cCardapio}', function() {
    return view('create/cardapio');
});

Route::get('/cEscola}', function() {
    return view('create/escola');
});

Route::get('/cModEnsino}', function() {
    return view('create/modEnsino');
});

Route::get('/cNivelEnsino}', function() {
    return view('create/nivelEnsino');
});

Route::get('/cSerie}', function() {
    return view('create/serie');
});

Route::get('/cTurma}', function() {
    return view('create/turma');
});

Route::get('/cTurno}', function() {
    return view('create/turno');
});



Route::get('/insere}', function() {
    return view('insert/aluno');
});

Route::get('/insere}', function() {
    return view('insert/cardapio');
});

Route::get('/insere}', function() {
    return view('insert/escola');
});

Route::get('/insere}', function() {
    return view('insert/modEnsino');
});

Route::get('/insere}', function() {
    return view('insert/nivelEnsino');
});

Route::get('/iSerie}', function() {
    return view('insert/serie');
});

Route::get('/insere}', function() {
    return view('insert/turma');
});

Route::get('/insere}', function() {
    return view('insert/turno');
});



Route::get('/insere}', function() {
    return view('read/aluno');
});

Route::get('/insere}', function() {
    return view('read/cardapio');
});

Route::get('/insere}', function() {
    return view('read/escola');
});

Route::get('/insere}', function() {
    return view('read/modEnsino');
});

Route::get('/insere}', function() {
    return view('read/nivelEnsino');
});

Route::get('/rSerie}', function() {
    return view('read/serie');
});

Route::get('/insere}', function() {
    return view('read/turma');
});

Route::get('/insere}', function() {
    return view('read/turno');
});



Route::get('/insere}', function() {
    return view('update/aluno');
});

Route::get('/insere}', function() {
    return view('update/cardapio');
});

Route::get('/insere}', function() {
    return view('update/escola');
});

Route::get('/insere}', function() {
    return view('update/modEnsino');
});

Route::get('/insere}', function() {
    return view('update/nivelEnsino');
});

Route::get('/uSerie}', function() {
    return view('update/serie');
});

Route::get('/insere}', function() {
    return view('update/turma');
});

Route::get('/insere}', function() {
    return view('update/turno');
});
*/