<?php

	require_once "Sesion.php" ;

	$ses = Sesion::getInstance() ;

	$ses->close() ;
	echo $this->twig->render("login.php.twig");
