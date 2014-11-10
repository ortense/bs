<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
</head>
<body>
	<h1>lista/colação: <?php echo $name ?></h1>
	<?php
		foreach ($this->data['data'] as $row) { 
			echo '<p>'.$row['colecao_id'].' - '.$row['sigla'].' - '.$row['nome'].'</p>';
		}
	?>
</body>
</html>