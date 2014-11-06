<?php
require 'vendor/autoload.php';
require 'config.php';
require 'lib/db_connect.php';

//instancie o objeto
$app = new \Slim\Slim(array(
	'templates.path' => 'views'
));
 
//defina a rota
$app->get('/', function () use ($app) {
	global $config;

	echo 'Hello '.$config['appname'].'!';
});

$app->group('/cards', function() use ($app){
	
	$app->get('/',function() use ($app){

		global $config;
		
		$db = db_connect($config);
		$result = $db->query( "SELECT * FROM colecao" );
		while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
			$data[] = $row;
		}

		$app->render('card_list.php', array(
				'title' => 'Coleções',
				'name' => 'Coleções',
				'data' => $data
			)
		);
		
	});
	
	$app->get('/:colecao', function($colecao) use($app) {
		
	});

	$app->get('/:colecao/:card', function($colecao, $card) use ($app){

		$data = array(
			'colecao'=> $colecao,
			'card'=> $card
		);

		$app->render('card_detail.php', $data, 200);
	});
});

$app->get('/busca', function () use ($app) { 
	
	if ( isset($_GET['q']) ) {
		$termo = $_GET['q'];
	}
	else{
		$termo = 'busca vazia';
	}
	
	$data = array(
		'termo'=> $termo
	);

	$app->render('search_result.php', $data, 200);
});


//rode a aplicação Slim 
$app->run();