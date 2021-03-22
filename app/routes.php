<?php
//register
$route[] = ['/', 'HomeController@index'];

$route[] = ['/user/create', 'UserController@create'];
$route[] = ['/user/store', 'UserController@store'];

$route[] = ['/login', 'UserController@login'];
$route[] = ['/login/auth', 'UserController@auth'];
$route[] = ['/logout', 'UserController@logout'];

$route[] = ['/adm','AdministratorController@index','auth'];

$route[] = ['/painel','PainelController@index','auth'];
$route[] = ['/painel/show','PainelController@show','auth'];
$route[] = ['/painel/loadscreen','PainelController@loadScreen','auth'];
$route[] = ['/painel/store','PainelController@store','auth'];
$route[] = ['/painel/groups','PainelController@groups','auth'];
$route[] = ['/painel/question', 'PainelController@question'];
$route[] = ['/painel/operando', 'PainelController@operando'];

$route[] = ['/questionador','QuestionadorController@index','auth'];
$route[] = ['/questionador/show','QuestionadorController@show','auth'];

$route[] = ['/logs','LogsController@index','auth'];


$route[] = ['/pergunta/show','PerguntaController@show','auth'];
$route[] = ['/pergunta/question','PerguntaController@question','auth'];

$route[] = ['/grupo','GrupoController@index','auth'];
$route[] = ['/grupo/show','GrupoController@show','auth'];

$route[] = ['/pontos/store','PontosController@store','auth'];
$route[] = ['/ponto/delete','PontosController@delete','auth'];

$route[] = ['/fila/index','FilaController@index','auth'];
$route[] = ['/fila/store','FilaController@store','auth'];
$route[] = ['/fila/find','FilaController@find','auth'];
$route[] = ['/fila/delete','FilaController@delete','auth'];

$route[] = ['/controlador','ControladorController@index','auth'];

$route[] = ['/atividade', 'AtividadeController@index','auth'];

$route[] = ['/retPontos/store','PunishmentController@store'];

$route[] = ['/addPontos/store','AddPunctuationController@store'];








return $route;