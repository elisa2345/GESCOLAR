<?php
 session_start();

 if(isset($_REQUEST['logar']))

 {
     try
     {
          include 'includes/conexao.php';

         $stmt = $conexao -> prepare("SELECT * FROM usuarios WHERE usario = ? AND senha = ? ");
         $stmt -> bindparam(1,$_REQUEST['usuario']);
         $stmt -> bindparam(2,$_REQUEST['senha']);
         $stmt -> execute();

         if($stmt->rowCount()>0) {
             $dados_usuario = $stmt->fetchObject();

             $_SESSION['gescolar_dados_usuario']= $dados_usuario;

             header("Location: index.php");
         } else {
             header("Location: login.php?erro=true");
         }
        } catch (Exception $e){
            echo $e->getMessage();
        }
 }
 ?>

 <link href="css/estilos.css" type="text/css" rel="stylesheet"/>
 <style>
 fieldset {with:30%; margin-top:10%;}
 </style>
 <fieldset>
   <legend>Login</legend>
   <form method = "post" action="login.php?logar=true">
    <label> Usuário:
           <input name = "usuario" type= "text" required/>
    </label>
    <label> Senha:
           <input name = "senha" type= "passaword" required/>
           </label>
     <button type= "submit">Entrar</button>
    </form>
 </fieldset>   