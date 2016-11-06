<!DOCTYPE html>
<html>

<?php include 'header.inc.php'; ?>
<body>
<div id="wrapper">
  <div id="page-wrapper" >
            <div id="page-inner">
	<?php
	if(isset($_POST['add-new'])){
    $username=$_POST["username"];
		$firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
		$password=$_POST["password"];
		$email=$_POST["email"];
        $errors =array();
		if (empty($username) || empty($password) || empty($lastname) || empty($firstname)) {
			$errors[]="Tous les champs sont obligatoires";
		}
		else{
		if ($connect=mysqli_connect('localhost','root','afpc1234','flip')){
		$sql ="INSERT INTO users1(username,firstname,lastname,email,password) VALUES('$username','$firstname','$lastname','$email','$password')";
		$query=mysqli_query($connect,$sql);
		$success = "L'utilisateur a été enregistré ";
      echo "<meta http-equiv='refresh' content='3;url=loginuser.php'>";
		}
	}
}
?>
	<div id="page">
		<div class="page-header">
  <h1 class="title">Nouvel Utilisateur</h1>
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
<div class="control-group">
  <label class="control-label" for="textinput-1">Prénom</label>
  <div class="controls">
    <input id="textinput-1" name="firstname" type="text" placeholder="Prénom" class="input-xlarge">
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="textinput-1">Nom</label>
  <div class="controls">
    <input id="textinput-1" name="lastname" type="text" placeholder="Nom" class="input-xlarge">
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
</div>

	</div>
  <script src="https://code.jquery.com/jquery.js"></script>
</body>