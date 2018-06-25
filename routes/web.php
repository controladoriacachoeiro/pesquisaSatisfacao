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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@getIndex');

    //Questionário
    Route::group(['prefix' => 'questionario'], function () {
        Route::get('/', 'QuestionarioController@index')->name('questionarioIndex');
        Route::get('/cadastrar', 'QuestionarioController@showCadastrar');
        Route::post('/cadastrar', 'QuestionarioController@Cadastrar');
        Route::get('/editar/{id}', 'QuestionarioController@showEditar')->name('editarQuestionario');
        Route::post('/editar/{id}', 'QuestionarioController@Editar');
        Route::get('/mostrar/{id}', 'QuestionarioController@Mostrar')->name('mostrarQuestionario');
        Route::post('/deletar/{id}', 'QuestionarioController@Deletar');
        Route::get('/filtroRelatorio/{id}', 'QuestionarioController@filtroRelatorio')->name('filtroRelatorio');
        Route::post('/relatorio/{id}', 'QuestionarioController@Relatorio');
        Route::get('/relatorio/{id}/paginacao/{paginacao}/{dataIni}/{dataFim}', 'QuestionarioController@MostrarRelatorio')->name('mostrarRelatorio');
    });

    //Pergunta
    Route::group(['prefix' => 'pergunta'], function () {        
        Route::get('/cadastrar/{fk}', 'PerguntaController@showCadastrar')->name('cadastrarPergunta');
        Route::post('/cadastrar/{fk}', 'PerguntaController@Cadastrar');
        Route::get('/editar/{id}', 'PerguntaController@showEditar')->name('editarPergunta');
        Route::post('/editar/{id}', 'PerguntaController@Editar');
        Route::get('/mostrar/{id}', 'PerguntaController@Mostrar');
        Route::post('/deletar/{id}', 'PerguntaController@Deletar');
    });

    //Resposta
    Route::group(['prefix' => 'resposta'], function () {        
        Route::get('/cadastrar/{fk}', 'RespostaController@showCadastrar')->name('cadastrarResposta');
        Route::post('/cadastrar/{fk}', 'RespostaController@Cadastrar');
        Route::get('/editar/{id}', 'RespostaController@showEditar')->name('editarResposta');
        Route::post('/editar/{id}', 'RespostaController@Editar');
        Route::get('/mostrar/{id}', 'RespostaController@Mostrar');
        Route::post('/deletar/{id}', 'RespostaController@Deletar');
    });
});

//Questionário para responder
Route::get('questionario/{id}', 'QuestionarioController@showQuestionario')->name('showQuestionario');

//Resultado
Route::post('resultado/cadastrar', 'ResultadoController@Cadastrar')->name('cadastrarResultado');