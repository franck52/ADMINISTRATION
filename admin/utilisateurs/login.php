<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Se connecter</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/MonStyle.css">
		<link rel="stylesheet" type="text/css" href="./login.css">
	</head>
	<body>		
		<br><br>
		<div class="container container col-md-4 col-md-offset-4">
			<!-- class="container col-md-4 col-md-offset-4" -->
			<!-- <div class="photo">gggggg</div>	 -->		
			<div class="panel panel-primary">
				<div class="panel-heading">Se connecter</div>
				<div class="panel-body">
					<form method="post" action="seConnecter.php" class="form" onsubmit="return validate();">
					    <p id="errors"></p>	
						<div class="form-group">
							<label for="login" class="control-label">LOGIN</label>
							<input type="text" name="login" autocomplete="off" id="login" class="form-control"/>
							<i class="fa fa-times u_times"></i>
							<i class="fa fa-check u_check"></i>
						</div>
						
						<div class="form-group">
							<label for="pwd" class="control-label">Mot de passe</label>
							<input type="password" name="pwd" id="pwd" class="form-control"/>
							<i class="fa fa-times p_times"></i>
							<i class="fa fa-check p_check"></i>
						</div>
							
						<button type="submit" class="btn btn-primary btn-block">Se connecter</button>
						<br>
						
						<a href="page_add_utilisateur.php">Créer mon compte</a>
						&nbsp&nbsp&nbsp&nbsp&nbsp
						<a href="page_demande_pwd.php">Mot de passe oublié</a>
						
					</form>
					<script type="text/javascript" src="./login.js"></script>
				</div>
			</div>			
		</div>
	</body>
</html>



