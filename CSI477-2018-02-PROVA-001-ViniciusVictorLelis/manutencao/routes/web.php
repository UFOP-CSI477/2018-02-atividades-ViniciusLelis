<?php

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

Route::get('/', 'PaginasController@index');

Route::get('/relatorios', 'ManutencaoController@index');

Route::get('/administracao/equipamentos', 'EquipamentoController@create');

Route::get('/administracao/listar_equipamentos', 'EquipamentoController@index');

Route::get('/administracao/manutencoes', 'ManutencaoController@create');

Route::get('/administracao/pesquisar', 'ManutencaoController@search');

Route::resource('manutencoes', 'ManutencaoController');

Route::resource('equipamentos', 'EquipamentoController');