<?php
	
	require_once('../class/db.class.php');

	$usuario = $_POST['usuario'];
	$email   = $_POST['email'];
	$senha   = md5($_POST['senha']);

	$objDb = new db();
	$link  = $objDb->conecta_mysql();

	$sql1 = "SELECT * FROM usuarios WHERE usuario = '$usuario' OR email = '$email'";
	$consulta = mysqli_query($link,$sql1);

	$sql2   = "INSERT INTO usuarios(usuario,email,senha) VALUES ('$usuario','$email','$senha')";


	if($consulta){
		$dados_consulta = mysqli_fetch_array($consulta);

		$retorno_get = "";

		//se usuario ja existe
		if($dados_consulta['usuario'] == $usuario){

			$retorno_get .= 'existe_usuario=1&';
			$existe_usuario = $retorno_get;

		//se email ja existe
		}if($dados_consulta['email'] == $email){
			$retorno_get .= 'existe_email=1&';
			$existe_email = $retorno_get;
			
		//se email ou usuario existe, não cadastrar
		}if($existe_usuario || $existe_email){
				header('Location:../inscrevase.php?'.$retorno_get);
				end();

		//se email ou usuario não existe, cadastrar
		}elseif(mysqli_query($link,$sql2)){
			header('Location: ../index.php?reg_success=1&');

		//se der erro no cadastro
		}else{
			echo "Erro ao registrar usuario";
		}
	}

?>