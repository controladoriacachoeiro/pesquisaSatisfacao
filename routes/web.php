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
    return redirect()->route('home');
});

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
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



