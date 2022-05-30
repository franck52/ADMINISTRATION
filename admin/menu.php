
<?php

	$id		=$_SESSION['user']['id_admin'];
	$login	=$_SESSION['user']['login'];
	$role	=$_SESSION['user']['roles'];

?>


	<nav class="navbar navbar-inverse navbar-fixed-top" id="menu_sup">
		<div class="container-fluid">
	    <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
           <a class="navbar-brand" href="#">RCI</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

		<div class="navbar-header">
				<a  class="navbar-brand" href="../../index.php">
					<span class="glyphicon glyphicon-home"></span>
						Accueil 
				</a>
		</div>

		<ul class="nav navbar-nav">
			<li> 
				<a href="../candidat/page_les_candidats.php">           
					<span class="fa fa-mortar-board"></span> 
					Les candidats
				</a> 
			</li>

			<li class=""> 
				<a href="../votant/page_les_votants.php">      
					<span class="fa fa-id-card"></span> 
					 Les votants
				</a> 
			</li>
			<?php if($role=="Directeur"){?>
			<li> 
				<a href="../votant/sauvegarde_bulletin.php">      
					<span class="glyphicon glyphicon-book"></span> 
					 Enregistrement
				</a> 
			</li>
            <?php } ?>
			<?php if($role=="Directeur"){?>
			<li> 
				<a href="../active_votes/enregistrer_pv_et_bulletin_null.php">       
					<span class="fa fa-book"></span>
                    
					PV 
				</a> 
			</li>
			<?php } ?>
			
			<li> 
				<a href="../active_votes/publier_les_resultats.php">       
					<!-- <span class="fa fa-product-hunt"></span> -->
					<i class="glyphicon glyphicon-folder-open"></i> 
					Résultats  
				</a> 
			</li>
			<?php if($role=="Directeur"){?>
				<li>
					<a href="../utilisateurs/resultats_detail.php">   
						<span class="glyphicon glyphicon-folder-open"></span> 
						Resultats détaillés
					</a>
				</li>
			<?php } ?>
			
			<?php if($role=="Directeur"){?>
				<li>
					<a href="../utilisateurs/page_les_utilisateurs.php">   
						<span class="fa fa-users"></span> 
						Les Utilisateurs 
					</a>
				</li>
			<?php } ?>	
			
		</ul>

		<ul class="nav navbar-nav navbar-right">
		
			<li class="dropdown">
			
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-user-circle-o"></span>&nbsp
						<?php echo $login ?>
					<span class="caret"></span>
				</a>
				
				<ul class="dropdown-menu">
					<li>
						<a href="../utilisateurs/page_edit_utilisateur.php?id=<?php echo $id ?>">
							<span class="fa fa-vcard-o"></span>&nbsp
							Mon Compte
						</a>
					</li>
					<li>
						<a href="../utilisateurs/seDeconnecter.php">
							<span class="fa fa-sign-out"></span>&nbsp
							Se déconnecter
						</a>
					</li>
				</ul>
				
			</li>
				
		</ul>
	</div>
	</div>


	</nav>

