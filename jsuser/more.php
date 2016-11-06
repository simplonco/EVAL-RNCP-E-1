<!DOCTYPE html>
<html>

<?php include 'header.inc.php'; ?>
<body>
<div id="wrapper">
	<div id="page-wrapper" >
            <div id="page-inner">
            	<?php
session_start();
if (!isset($_SESSION['username'])) {
   ?>



	<div class="more">
	<?php
	
	if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
		$id = intval($_GET['id']);
		$sql2="SELECT content FROM image  WHERE id=$id";
		$query2=mysqli_query($connect,$sql2);
		while($row=mysqli_fetch_object($query2)){
			echo '<img src="data:image/jpeg;base64,'.base64_encode($row->content).'"/>';
		}
		?>
<p class="clear">
<?
		$sql="SELECT title,topic FROM threads  WHERE id=$id";
		$query=mysqli_query($connect,$sql);
		while($row=mysqli_fetch_object($query)){
			
			echo $row->title.'</br>';
			echo $row->topic;
			
		}
		
	}
	?>
	</p>
	<?php
	if ($connect=mysqli_connect('localhost','root','afpc1234','flip')){
		$sql1="SELECT * FROM comment where reference='$id' ";
$j=1;
		$query1=mysqli_query($connect,$sql1);
		while($row=mysqli_fetch_object($query1)){
			echo $j++;
			echo "-".$row->subject."<br>";
			echo $row->comment1."<br>";
		}
		}
	
	?>
	<hr />
	<a href="../indexuser.php">Retour Accueil</a>
	
	<P><a href="loginuser.php">Connecter pour Laisser un commentaire</a></p>
	
    	</div>

<?

}
else{
	$id = intval($_GET['id']);
	if(isset($_POST['submit'])){
    $subject=$_POST["subject"];
		$comment=$_POST["comment"];
        $errors =array();
		if (empty($comment) || empty($subject)) {
			$errors[]="Tous les champs sont obligatoires";
		}
		else{
		if ($connect=mysqli_connect('localhost','root','afpc1234','flip')){
		$sql ="INSERT INTO comment(subject,comment1,reference) VALUES('$subject','$comment','$id')";
		$query=mysqli_query($connect,$sql);
		$success = "La commentaire a été enregistré";
		      echo "<meta http-equiv='refresh' content='1;url=more.php?id=".$id."'>";
	
		}
	}
}

?>
	
	<div class="more">
	<?php
	
	if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
		
		$sql2="SELECT content FROM image  WHERE id=$id";
		$query2=mysqli_query($connect,$sql2);
		while($row=mysqli_fetch_object($query2)){
			echo '<img src="data:image/jpeg;base64,'.base64_encode($row->content).'"/>';
		}
		?>
	</div>
<p class="clear">
<?
		$sql="SELECT title,topic FROM threads  WHERE id=$id";
		$query=mysqli_query($connect,$sql);
		while($row=mysqli_fetch_object($query)){
			echo $row->title;
			echo $row->topic;
			echo "<hr />";
		}
		
	}
	?>
	</p>
	<a href="../indexuser.php">Retour Accueil</a>
<hr />
	<form action="#" method="post" >
<fieldset>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput-0">Sujet</label>
  <div class="controls">
    <input id="textinput-0" name="subject" type="text" placeholder="placeholder" class="input-xlarge">
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
	<label class="control-label" for="textinput-0">Commentaire</label>
  <div class="controls">                     
    <textarea id="textarea-0" name="comment"></textarea>
  </div>
</div>
<div class="control-group">
  <div class="controls">
    <button id="singlebutton-0" name="submit" class="btn btn-primary">Valider</button>
  </div>
</div>

</fieldset>
</form>
<?
if ($connect=mysqli_connect('localhost','root','afpc1234','flip')){
		$sql1="SELECT * FROM comment where reference='$id' ";
$j=1;
		$query1=mysqli_query($connect,$sql1);
		while($row=mysqli_fetch_object($query1)){
			echo $j++;
			echo "-".$row->subject."<br>";
			echo $row->comment1."<br>";
		}
		}
	
	?>
	<hr />
<a href="logoutuser.php">Déconnecter</a>
    	</div>  
<?php
}
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

</div>
</div>
</div>
</body>