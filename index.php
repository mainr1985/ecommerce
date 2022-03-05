<?php 

require_once("vendor/autoload.php");
//use Hcode\DB;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	//echo "OK";
	$sql = new Hcode\DB\Sql(); //instanciando a classe sql pra testar conexão com o db
	$results = $sql->select ("SELECT * FROM tb_users"); //$sql->select está chamando o método 'select' da classe SQL pra realizar a query
	echo json_encode($results);

});

$app->run();

 ?>