<?php
require 'vendor/autoload.php';
require 'config.php';

//instancie o objeto
$app = new \Slim\Slim(array(
	'templates.path' => 'views'
));
 
//defina a rota
$app->get('/', function () use ($app) {
	global $config;

	require 'lib/db_connect.php';
		$db = db_connect($config);
		$result = $db->query( 'SELECT * FROM colecoes;' );
		while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
			$data[] = $row;
		}

		$app->render('card_list.php', array(
				'name' => 'db_teste',
				'rows' => var_dump($data)
			)
		);

	echo 'Hello '.$config['appname'].'!';
});

$app->group('/cards', function() use ($app){
	
	$app->get('/',function() use ($app){

		echo "cards/home";
		
	});
	
	$app->get('/:colecao', function($colecao) use($app) {

		$data = array(
			'name'=> $colecao
		);

		$app->render('card_list.php', $data, 200);
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