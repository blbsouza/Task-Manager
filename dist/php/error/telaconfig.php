<html>
<head>
	<meta charset="utf-8" />
<style>
	*{
		color:#fff;
		font-family: 'calibri light', 'century gothic', 'sans-serif';
		margin:0;
		padding:0;
	}
	body{
		height:100%;
		min-width:100vh;
		background:#0e9cf0;
		display:flex;
		flex-direction:column;
		align-itemns:center;
		justify-content:center;
		text-align:center;
	}
	#spinner{
		margin:0 auto;
		height:60px;
		width:60px;
		border:10px solid rgba(255,255,255,.3);
		border-bottom:10px solid rgba(255,255,255,.6);
		border-radius:100%;
		animation:roda 1s linear infinite;
	}
	@keyframes roda{
		from{
			transform:rotate(-360deg);
		}
	}
</style>
</head>
<body>
	
	<div id="spinner"></div>
	<h1 id="h1">Bem-Vindo à nossa página Task Manager</h1>
	<h2 id="h3">Não feche o navegador</h2>
	<br>
	<h2>Criando Tabela para esta página...</h2>
	<h3>Em instantes o programa abrirá...</h3>
	<?php
	include "../conn/pdo.php";
	$q = $conn->query('CREATE TABLE IF NOT EXISTS `tm_tasks`(
		`id` INT NOT NULL AUTO_INCREMENT,
		`data` DATE NOT NULL,
		`data_sts` DATE NOT NULL,
		`title` VARCHAR(100) NOT NULL,
		`subtitle` VARCHAR(100) NOT NULL,
		`txt` VARCHAR(500) NOT NULL,
		`sts` INT(1) NOT NULL,
		`urgency` INT(1) NOT NULL,
		PRIMARY KEY (`id`)
	)');
	sleep(5);
	echo "<script>window.location='../../'</script>";
	?>
</body>
</html>