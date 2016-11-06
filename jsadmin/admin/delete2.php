<!DOCTYPE html>
<?php include 'header.php'; ?>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admins.php">LES ARTICLES</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">  <a href="../logout.php" class="btn btn-danger square-btn-adjust">Déconnecter</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a class="active-menu"  href="admins.php"><i class="fa fa-dashboard fa-3x"></i>TABLEAU DE BORD</a>
                    </li>
                    
                      <li  >
                        <a  href="topics.php"><i class="fa fa-table fa-3x"></i>LISTE DES ARTICLES/Modifier/Supprimer</a>
                    </li>
                    <li  >
                        <a  href="form.php"><i class="fa fa-edit fa-3x"></i>Ajouter un Article</a>
                    </li>				
					           <li>
                        <a  href="control.php"><i class="fa fa-desktop fa-3x"></i>Contrôler l'utilisateur Commentaires</a>
                    </li>
					                   
                    <li>
                        <a href="addadmin.php"><i class="fa fa-sitemap fa-3x"></i>Ajouter un Admin</a>
                        
                      </li>  
                  <li  >
                        <a  href="unpublish.php"><i class="fa fa-square-o fa-3x"></i>Liste Des Articles non Publiés</a>
                    </li>	
                </ul>
               
            </div>
            
        </nav>  
        <div id="page-wrapper" >
            <div id="page-inner">
                Supprimer
                <p>
<a href="topics.php">Retour list des Articles</a>
</p>
</div>
</div>
</body>
</html>
