<?php
	require "../../app_lista_tarefas/tarefa.model.php";
	require "../../app_lista_tarefas/tarefa.service.php";
	require "../../app_lista_tarefas/conexao.php";

	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";

	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir'){
	
	$conexao = new Conexao();
	$tarefa = new Tarefa();

	$tarefa->__set('tarefa',$_POST['tarefa']);

	$tarefa_service = new TarefaService($conexao, $tarefa);
	$tarefa_service->inserir();

	//echo "<pre>";
	//print_r($tarefa_service);
	//echo "</pre>";

	header('Location: nova_tarefa.php?inclusao=1');
	}else if ($acao == 'recuperar') {
		$conexao = new Conexao();
		$tarefa = new Tarefa();

		$tarefa_service = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefa_service->recuperar();

	
	
	} else if ($acao == 'atualizar') {
		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefa->__set('id', $_POST['id']);
		$tarefa->__set('tarefa', $_POST['tarefa']);
		$tarefa_service = new TarefaService($conexao, $tarefa);
		
 		if ($tarefa_service->atualizar()) {

 			if (isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
 				 header('Location: index.php');

 			}else {
 				header('Location: todas_tarefas.php');
 			}
 			 
 		}
	
	
	} else if ($acao == 'remover') {
		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefa->__set('id', $_GET['id']);

		$tarefa_service = new TarefaService($conexao, $tarefa);
		$tarefa_service->remover();

		if (isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
 				 header('Location: index.php');

 			}else {
 				header('Location: todas_tarefas.php');
 			}

	
	}else if ($acao == 'marcarRealizada') {
		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefa->__set('id', $_GET['id']);
		$tarefa->__set('id_status',2);

		$tarefa_service = new TarefaService($conexao, $tarefa);
		$tarefa_service->marcarRealizada();
		

		if (isset($_GET['pag']) && $_GET['pag'] == 'index' ) {
 				 header('Location: index.php');

 			}else {
 				header('Location: todas_tarefas.php');
 			}

	
	}else if ($acao == 'recuperarTarefasPendentes') {
		$tarefa = new Tarefa();
		$conexao = new Conexao();
		$tarefa->__set('id_status',1);
		$tarefa_service = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefa_service->recuperarTarefasPendentes();
			
	}
?>