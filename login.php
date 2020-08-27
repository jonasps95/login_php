<?php
include ('config.php');
	if(isset($_COOKIE['lembrar'])){
		$user = $_COOKIE['user'];
		$password = $_COOKIE['password'];
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
		$sql->execute(array($user,$password));
			if($sql->rowCount() == 1){
				$info = $sql->fetch();
				$_SESSION['login'] = true;
				$_SESSION['user'] = $user;
				$_SESSION['password'] = $password;
				$_SESSION['nome'] = $info['nome']; 
				Painel::redirect('main');
			}
		}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Signin Template · Bootstrap</title>

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>
  <body class="text-center">

  <?php
      if(isset($_POST['acao'])){
          $user = $_POST['user'];
          $password = $_POST['password'];
          $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
          $sql->execute(array($user,$password));
                if($sql->rowCount() == 1){
                    $info = $sql->fetch();
                    //login sucesso
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    $_SESSION['nome'] = $info['nome'];
                      if(isset($_POST['lembrar'])){
                          setcookie('lembrar',true,time()+(60*60*24),'/');
                          setcookie('user',$user,time()+(60*60*24),'/');
                          setcookie('password',$password,time()+(60*60*24),'/');
                      }
                    Painel::redirect('main');
                }else{
                  //falhou
                  echo '<h2 class="erro-conexao">erro ao conectar-se</h2>';
                }
             }
  ?>

    <form action="login.php" method="POST" class="form-signin">
      <img class="mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label class="sr-only">User</label>
        <input type="text" name="user" id="inputEmail" class="form-control" placeholder="User" required autofocus>

        <label class="sr-only">Password</label>
        <input type="password" name="password"  id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="lembrar"> Remember me
        </label>
      </div>
      <input class="btn btn-lg btn-primary btn-block" type="submit" name="acao" value="Logar!"></input>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>
</body>
</html>
