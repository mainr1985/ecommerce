<?php 

require_once("vendor/autoload.php"); //vem do composer
use \Slim\Slim; //usando o slim
use Hcode\Page; //o nome do namespace Hcode foi setado no composer.json. Page.php pra criar os templates
//use Hcode\PageAdmin; // PageAdmin.php pra criar os templates da administração

$app = new Slim();
$app->config('debug', true);

$app->get('/', function() 
{
	$page = new Page(); //instanciando a classe Page. Aqui já será desenhado o Header.html pelo construct
	$page->setTpl("index"); //vai desenhar o index.htlm na página

	//aqui já acabou a execução. o PHP vai limpar a memória, chamando o destruct que vai desenhar o footer
});


//criando a rota para PageAdmin
/*
$app->get('/admin', function()
{
	$page = new PageAdmin();
	$page->setTpl("index");
});*/


$app->run(); //aqui roda tudo

?>