<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Articles</title>

<link rel="stylesheet" type="text/css" href="demo/styles.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="demo/jquery.flip.min.js"></script>

<script type="text/javascript" src="demo/script.js"></script>

</head>

<body>

<h1>LISTE DES ARTICLES</h1>
<h2><a href=""></a></h2>

<?php

// Each sponsor is an element of the $sponsors array:
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
	$sqlget="SELECT threads.title, image.content,image.id ".
 "FROM threads LEFT JOIN image ".
	"ON threads.id = image.id where status=1 ";
	$article= array();
	$index=0;
	
	if($getresult=mysqli_query($connect,$sqlget)){
		for ($i=0; $i < 10; $i++) { 
	$row=mysqli_fetch_array($getresult);
	$article[$i] = $row;			

		
		}
		}
// Randomizing the order of sponsors:

shuffle($article);

?>



<div id="main">

	<div class="sponsorListHolder">

		
        <?php
			
			// Looping through the array:
			
			foreach($article as $company)
			{
				echo'
				<div class="sponsor" title="Click to flip">
					<div class="sponsorFlip">
						<img src="data:image/jpeg;base64,'.base64_encode( $company[1] ).'"/>
					</div>
					
					<div class="sponsorData">
						<div class="sponsorDescription">
							'.$company[0].'
						</div>
						<div class="sponsorURL">
							<a href="jsuser/more.php?id='.$company[2].'">Lire la suite</a>
						</div>
					</div>
				</div>
				
				';

}

}
		?>

        
        
    	<div class="clear"></div>
    </div>

</div>

<p class="note">Copyright réservés</p>

</body>
</html>
