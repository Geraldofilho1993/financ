<?
$userid = $_POST["username"];
$password = $_POST["passwd"];
if ($userid and $password)
{
   // iniciando sess�o
   session_start();
   
   include "./includes/config.php";
   // abrindo uma conex�o com o banco de dados
   $db_conn = mysql_connect($server, $db_user, $db_pass) or die ("Erro na conex�o com a Base de Dados");
   // definindo a base de dados 
   mysql_select_db($database, $db_conn);
   
   //montando comando de select
   $query = "select * from usuar where apelido='$userid' and senha='".md5($password)."'";
   
   //print $query;
   // resgatando resultado da pesquida executada no banco
   $result = mysql_query($query, $db_conn);

   // testando se usu�rio existe
   if (mysql_num_rows($result) == 1 )
   {
   	  // resgatando dados do registro retornado pela pesquisa
      $dados = mysql_fetch_array($result);
      
      //colocando mensagem de boas vindas na sess�o
      $_SESSION["boasvindas"] = "Seja bem vindo " . $dados["nome"] . "!";
      
      // Se usuario v�lido entao registra o usuario na sess�o
      $_SESSION["valid_user"] = $userid;
   }
}

// se existir um usu�rio na sess�o
if ($_SESSION["valid_user"])
{
	
    // redirecionando usu�rio a p�gina principal
  ?>
	   <html><head><meta http-equiv="refresh" content="0;URL=principal.php"></head>
		<body>
	       Redirecionando .....
		</body>
	 </html>
  <?
}else{
	
   $erros = "Falha na autenticacao do usuario informado";
   // n�o est� logado.
   include "index.php";
}

?>
