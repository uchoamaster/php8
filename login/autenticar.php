<?php 

require_once("../conexao.php");
@session_start();

$usuario = $_POST['Usuario'];
$senha = $_POST['Senha'];

$query = $pdo->prepare("SELECT * FROM usuario where Usuario = :Usuario and Senha = :Senha");
	$query->bindValue(":Usuario", $usuario);
	$query->bindValue(":Senha", $senha);
	$query->execute();

	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);

	

	if($total_reg > 0){

		//CRIAR AS VARIAVEIS DE SESSÃO
		$_SESSION['nome_usuario'] = $res[0]['Nome'];
		$_SESSION['nivel_usuario'] = $res[0]['Nivel'];

		$nivel = $res[0]['Nivel'];

		if($nivel == 'Administrador'){
			echo "<script language='javascript'>window.location='painel-adm'</script>";
		}else if($nivel == 'Cliente'){
			echo "<script language='javascript'>window.location='painel-cliente'</script>";
		}else if($nivel == 'Vendedor'){
			echo "<script language='javascript'>window.location='painel-vendedor'</script>";
		}else if($nivel == 'Tesoureiro'){
			echo "<script language='javascript'>window.location='painel-tesoureiro'</script>";
		}else{
			echo "<script language='javascript'>window.alert('Usuário Sem Permissão para Acesso')</script>";
		echo "<script language='javascript'>window.location='index.php'</script>";
		}
		
	}else{
		echo "<script language='javascript'>window.alert('Dados Incorretos')</script>";
		echo "<script language='javascript'>window.location='index.php'</script>";
	}
	
 ?>