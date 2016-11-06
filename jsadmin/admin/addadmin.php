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
                <?php
                if(isset($_POST['add-new'])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $email=$_POST["email"];
        $errors =array();
        if (empty($username) || empty($password)) {
            $errors[]="ALL Fields requierd";
        }
        else{
        if ($connect=mysqli_connect('localhost','root','afpc1234','flip')){
        $sql ="INSERT INTO users(username,password,email) VALUES('$username','$password','$email')";
        $query=mysqli_query($connect,$sql);
        $success = "utilisateur a été enregistré"; 
        
       echo "<meta http-equiv='refresh' content='3;url=addadmin.php'>";
           
        }
    }
}
?>
    <div id="page">
        <div class="page-header">
  <h1 class="title">Nouvel Admin</h1>
</div>
<form class="form-horizontal" action="" method="POST">
<fieldset>
<br/>
<?php
if($success){
    echo '<div class="alert alert-success">'.$success.'</div>';
}
if(isset($errors))
{
    foreach ($errors as $error) {
        echo '<div class="alert alert-danger">'.$error.'</div>';
    }
}
?>
<div class="control-group">
  <label class="control-label" for="textinput-1">Nom d'utilisateur</label>
  <div class="controls">
    <input id="textinput-1" name="username" type="text" placeholder="Nom d'utilisateur" class="input-xlarge">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput-1">Mot de passe</label>
  <div class="controls">
    <input id="textinput-1" name="password" type="password" placeholder="Mot de passe" class="password">
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput-1">Mail</label>
  <div class="controls">
    <input id="textinput-1" name="email" type="email" placeholder="Mail" class="email">
  </div>
</div>
<!-- Button -->
<p>
<div class="control-group">
  <div class="controls">
    <button id="singlebutton-0" name="add-new" class="btn btn-primary">Enregistrer</button>
  </div>
</div>
</p>
</fieldset>
</form>

    </div>
  <script src="https://code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</div>
</div>
</body>