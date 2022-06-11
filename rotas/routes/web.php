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

Route::get('/', function () {
    return "<h1>Rota Principal</h1>";
});

Route::prefix('/aluno')->group(function() {

    Route::get('/', function() {

        $dados = array(
            "Jonathan Zapotosczny",
            "Karoline Goergen",
            "Gil Eduardo de Andrade",
            "Edevaldo Chaves",
            "Anderson Alex",
        );

        $alunos = "<ol>";

        $cont = 0;
        foreach($dados as $nome) {
            $alunos .= "<li>$nome</li>";
            $cont++;
            if($cont >= count($dados)) break;
        }
        
        $alunos .= "</ol>";
        return $alunos;

    })->name('aluno');

    Route::get('/notas', function() {
        return "<h1>Lista de notas! :D</h1>";
    })->name('aluno.notas');

});