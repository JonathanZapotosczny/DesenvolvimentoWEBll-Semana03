<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;

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

    Route::get('/limite/{total}', function($total) {

        $dados = array(
            1 => "Jonathan",
            2 => "Karoline",
            3 => "Edevaldo",
            4 => "Anderson",
            5 => "Pedro"
        );

        $alunos = "<ol>";

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


        $alunos .= "</ol>";

        return $alunos;
    })->name('aluno.limite')->where('total', '[0-9]+');

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


    })->name('aluno.matricula')->where('matricula', '[0-9]+');

    Route::get('/nome/{nome}', function($nome) {

        $dados = array(
            1 => "Jonathan",
            2 => "Karoline",
            3 => "Edevaldo",
            4 => "Anderson",
            5 => "Pedro"
        );

        $flag = false;
        $alunos = "<ul>";

        foreach($dados as $i) {
            if(strcmp($i, $nome) == 0) {
                $alunos .= "<li>".$nome."</li>";
                $flag = true;
            }
        }

        if($flag == false) {
            $alunos .= $alunos."<li>NÃO ENCONTRADO!</li>";
        }

        $alunos .= "</ul>";

        return $alunos;
    })->name('aluno.nome')->where('nome', '[A-Za-z]+');

});

Route::prefix('/nota')->group(function() {
    Route::get('/', function() {

    $header = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";

    $dados = array(
        array('matricula'=> 1, 'nome'=> "Jonathan", "nota"=> 9),
        array('matricula'=> 2, 'nome'=> "Karoline", "nota"=> 2),
        array('matricula'=> 3, 'nome'=> "Edevaldo", "nota"=> 8),
        array('matricula'=> 4, 'nome'=> "Anderson", "nota"=> 6),
        array('matricula'=> 5, 'nome'=> "Pedro", "nota"=> 4),
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

    })->name('nota');

    Route::get('limite/{limite}', function($limite) {

        $header = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";

        $dados = array(
            array('matricula'=> 1, 'nome'=> "Jonathan", "nota"=> 9),
            array('matricula'=> 2, 'nome'=> "Karoline", "nota"=> 2),
            array('matricula'=> 3, 'nome'=> "Edevaldo", "nota"=> 10),
            array('matricula'=> 4, 'nome'=> "Anderson", "nota"=> 6),
            array('matricula'=> 5, 'nome'=> "Pedro", "nota"=> 4),
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
        } else {
            $header = $header."<li>Tamanho Máximo = ".count($dados)."</li>";
        }

        $header .= "</ul></table>";
        return $header;

    })->name('nota.limite')->where('limite', '[0-9]+');

    Route::get('lancar/{nota}/{matricula}/{nome?}', function($nota, $matricula, $nome=null) {

        $header = "";

        $dados = array(
            array('matricula'=> 1, 'nome'=> "Jonathan", "nota"=> 9),
            array('matricula'=> 2, 'nome'=> "Karoline", "nota"=> 2),
            array('matricula'=> 3, 'nome'=> "Edevaldo", "nota"=> 10),
            array('matricula'=> 4, 'nome'=> "Anderson", "nota"=> 6),
            array('matricula'=> 5, 'nome'=> "Pedro", "nota"=> 4),
        );

        $aux = $dados;
        $flag = false;

        if($nome == null) {

        $indice = array_search($matricula, array_column($aux, 'matricula'));
        
        if($indice != 0) {
            $alterado = [
                'matricula' => $matricula,
                'nome' => $dados[$indice]['nome'],
                'nota' => $nota
            ];
            $dados[$indice] = $alterado;
        }else {
            echo "<h2> Matrícula NÃO EXISTE! </h2>";
            $flag = true;
        }

        }else {

            $indice = array_search($nome, array_column($aux, 'nome'));

            if($indice != 0) {
            
            $alterado = [
                'matricula' => $dados[$indice]['matricula'],
                'nome' => $dados[$indice]['nome'],
                'nota' => $nota
            ];

            $dados[$indice] = $alterado;

        } else {
            echo "<h2> Nome NÃO EXISTE! </h2>";
            $flag = true;
        }

        }

        if($flag == false) {
            $header = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";
            foreach($dados as $aluno) {
                $header .= "<tr>";
                foreach ($aluno as $key => $value) {
                    $header .= "<td>$value</td>";
                }
            $header .= "</tr>";
            }
        }
        $header .= "</ul></table>";
        return $header;

    })->name('nota.lancar')->where('nota', '[0-9]+')->where('matricula', '[0-9]+')->where('nome', '[A-Za-z]+');

    Route::get('conceito/{a}/{b}/{c}', function($a, $b, $c) {

        $header = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";
    
        $dados = array(
            array('matricula'=> 1, 'nome'=> "Ana", "nota"=> 9),
            array('matricula'=> 2, 'nome'=> "Bruno", "nota"=> 2),
            array('matricula'=> 3, 'nome'=> "Carol", "nota"=> 10),
            array('matricula'=> 4, 'nome'=> "Danilo", "nota"=> 6),
            array('matricula'=> 5, 'nome'=> "Ellen", "nota"=> 4),
        );
    
     
        foreach($dados as $aluno) {
            if($aluno["nota"] >= $a){
                $aluno["nota"] = "A";
            }
            else if($aluno["nota"] >= $b && $aluno["nota"] < $a){
                $aluno["nota"] = "B";
            }
            else if($aluno["nota"] >= $c && $aluno["nota"] < $b && $aluno["nota"] < $a){
                $aluno["nota"] = "C";
            }
            else {
                $aluno["nota"] = "D";
            }
            foreach ($aluno as $key => $value) {
                $header .= "<td>$value</td>";
            }
            $header .= "</tr>";
        }
    
        $header .= "</ul></table>";
        return $header;
    
    })->name('nota.conceito')->where('a', '[0-9]+')->where('b', '[0-9]+')->where('c', '[0-9]+');

    Route::post('conceito', function(Request $request) {
        $header = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";
    
        $dados = array(
            array('matricula'=> 1, 'nome'=> "Ana", "nota"=> 9),
            array('matricula'=> 2, 'nome'=> "Bruno", "nota"=> 2),
            array('matricula'=> 3, 'nome'=> "Carol", "nota"=> 10),
            array('matricula'=> 4, 'nome'=> "Danilo", "nota"=> 6),
            array('matricula'=> 5, 'nome'=> "Ellen", "nota"=> 4),

        );
    
        $a = $request -> A;
        $b = $request -> B;
        $c = $request -> C;
     
        foreach($dados as $aluno) {
            if($aluno["nota"] >= $a){
                $aluno["nota"] = "A";
            }
            else if($aluno["nota"] >= $b && $aluno["nota"] < $a){
                $aluno["nota"] = "B";
            }
            else if($aluno["nota"] >= $c && $aluno["nota"] < $b && $aluno["nota"] < $a){
                $aluno["nota"] = "C";
            }
            else {
                $aluno["nota"] = "D";
            }
            foreach ($aluno as $key => $value) {
                $header .= "<td>$value</td>";
            }
            $header .= "</tr>";
        }
    
        $header .= "</ul></table>";
        return $header;
    
    })->name('nota.conceito');

});
