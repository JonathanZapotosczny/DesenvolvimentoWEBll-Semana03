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
            1 => "Jonathan",
            2 => "Karoline",
            3 => "Edevaldo",
            4 => "Anderson",
            5 => "Pedro"
        );

        $alunos = "<ul>";

        $cont = 0;
        foreach($dados as $nome) {
            $alunos .= "<li>$nome</li>";
            $cont++;
            if($cont >= count($dados)) break;
        }
        
        $alunos .= "</ul>";
        return $alunos;

    })->name('aluno');

    Route::get('/limite/{total}', function($total) {

        $dados = array(
            1 => "Jonathan",
            2 => "Karoline",
            3 => "Edevaldo",
            4 => "Anderson",
            5 => "Pedro"
        );

        $alunos = "<ul>";

        if($total <= count($dados)) {
            $cont = 0;
            foreach($dados as $nome) {
                $alunos .= "<li>$nome</li>";
                $cont++;
                if($cont >= $total) break;
            }
        }else {
            $alunos = $alunos."<li>Tamanho Máximo = ".count($dados)."</li>";
        }
        
        
        $alunos .= "</ul>";
    
        return $alunos;
    })->name('aluno.limite');

    Route::get('/matricula/{matricula}', function($matricula) {

        $dados = array(
            1 => "Jonathan",
            2 => "Karoline",
            3 => "Edevaldo",
            4 => "Anderson",
            5 => "Pedro"
        );

        $alunos = "<ul>";
        if ($matricula <= count($dados)) {
            $alunos .= "<li>".$dados[$matricula]."</li>";
        }else {
            $alunos = $alunos."<li>NÃO ENCONTRADO!</li>";
        }
        

        $alunos .= "</ul>";

        return $alunos;
    
        
    })->name('aluno.matricula');

    Route::get('/nome/{nome}', function($nome) {

        $dados = array(
            1 => "Jonathan",
            2 => "Karoline",
            3 => "Edevaldo",
            4 => "Anderson",
            5 => "Pedro"
        );

        $alunos = "<ul>";

        foreach($dados as $i) {
            if(strcmp($i, $nome) == 0) {
                $alunos .= "<li>".$nome."</li>";
            }else {
                $alunos .= $alunos."<li>NÃO ENCONTRADO!</li>";
            }
        }
        
        $alunos .= "</ul>";
    
        return $alunos;
    })->name('aluno.nome');

    Route::get('/nota', function() {

        $header = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";

        $dados = array(
            array('matricula'=> 1, 'nome'=> "Jonathan", "nota"=> 8),
            array('matricula'=> 2, 'nome'=> "Karoline", "nota"=> 10),
            array('matricula'=> 3, 'nome'=> "Edevaldo", "nota"=> 9),
            array('matricula'=> 4, 'nome'=> "Anderson", "nota"=> 7),
            array('matricula'=> 5, 'nome'=> "Pedro", "nota"=> 6),
        );

        foreach($dados as $aluno) {
            $header .= "<tr>";
            foreach ($aluno as $key => $value) {
                $header .= "<td>$value</td>";
            }
            $header .= "</tr>";
        }

        $header .= "</ul></table>";
        return $header;

    })->name('aluno.nota');

    Route::get('/nota/limite/{limite}', function($limite) {

        $header = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";

        $dados = array(
            array('matricula'=> 1, 'nome'=> "Jonathan", "nota"=> 8),
            array('matricula'=> 2, 'nome'=> "Karoline", "nota"=> 10),
            array('matricula'=> 3, 'nome'=> "Edevaldo", "nota"=> 9),
            array('matricula'=> 4, 'nome'=> "Anderson", "nota"=> 7),
            array('matricula'=> 5, 'nome'=> "Pedro", "nota"=> 6),
        );

        if ($limite <= count($dados)) {
            $cont = 0;
                foreach($dados as $aluno) {
                    $header .= "<tr>";
                    foreach ($aluno as $key => $value) {
                        $header .= "<td>$value</td>";
                    }
                    $cont++;
                    if($cont >= $limite) break;
                    $header .= "</tr>";
                }
        }

        $header .= "</ul></table>";
        return $header;

    })->name('aluno.nota.limite');

});