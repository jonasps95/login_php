<?php
	@session_start();

	$autoload = function($class){
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);



    