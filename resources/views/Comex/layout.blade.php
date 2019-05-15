<?php
	// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
    ini_set('display_errors',1);
    
	$user = new Empregado();
	
	$apelido = strstr($user->getNome(), " ", true); 

	$perfil_user = $user->getNivelAcesso();
	// $perfil_user = '500';
	$funcao_user = $user->getFuncao();
	// $funcao_user = 'Developer';
	$data_caixa_user = date_format(date_create($user->getDataAdmissao()), "d/m/Y");
	// $data_caixa_user = '01/04/2018';
	$usuario = $user->getMatricula();
	// $usuario ='c079436';
	$nome_abreviado = $apelido;
	// $nome_abreviado = 'Vlad';
	$nome_user = $user->getNome();
	// $nome_user = 'Vlad';
	$unidade_user = $user->getLotacaoAdm();