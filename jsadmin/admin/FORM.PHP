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
       if ($_POST['submit'] && !empty($_FILES)) {
    $formok=true;
    //input vars
    
    $title=$_POST['title'];
    $thread=$_POST['elml'];
    //$date=date_default_timezone_set('France/Paris');
    //FILES VARS
    
    $img_tmp=$_FILES['upload']['tmp_name'];
    $img_name=$_FILES['upload']['name'];
    $target=dirname(__FILE__)."/uploaded/".$img_name;
    move_uploaded_file($img_tmp,$target);
    include("easyphpthumbnail.class.php");

    $thumb=new easyphpthumbnail;
    $thumb->Thumbsize=140;
    $thumb->Createthumb($target,'file');
    $thumb=dirname(__FILE__)."/".$img_name;
    if(copy($thumb,$target)){
       unlink($thumb);
        
    }
    $size=$_FILES['upload']['size'];
    $type=$_FILES['upload']['type'];
    $error=$_FILES['upload']['error'];
    
    if (!in_array($type,array('image/png','image/jpg','image/jpeg','image/gif','image/NEF'))) {
        $formok=False;
        echo "the uploaded file is not image";
    }
    if (filesize($target)>800000) {
        $formok=False;
        echo "the size of file is big";
    }
}
if ($formok) {
    if ($connect=mysqli_connect('localhost','root','afpc1234','flip')) {
        $content=file_get_contents($target);
        $titlescape=mysqli_real_escape_string($connect,$title);
        $threadescape=mysqli_real_escape_string($connect,$thread);
        $imagescape=mysqli_real_escape_string($connect,$content);

        
        $sqlthread="insert into threads(title,topic,status) values ('$titlescape','$threadescape',0)";
        $sqlimage="insert into image(name,size,type,content) values ('$img_name','$size','$type','$imagescape')";
        
        
        $querythread=mysqli_query($connect,$sqlthread);
        $queryimage=mysqli_query($connect,$sqlimage);

      if ($querythread && $queryimage) {
         $imageid=mysqli_insert_id($connect);
        }
         mysqli_close($connect);

    }
    else {
        echo "ther is wrong in connect with data base";
    }

    echo "success in insert data in database";
}


 error_reporting("E_ALL & `E_NOTIC");       
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
    $sql="SELECT type,content FROM image WHERE id=$imageid";
    $sth = $connect->query($sql);
    $result=mysqli_fetch_array($sth);
echo '<img src="data:image/jpeg;base64,'.base64_encode($result['content'] ).'"/>';

}
else {
    echo "there is not connection with database";
}
?>
        <hr />
    
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
        
<div class="write">
    <form  action="<?php echo $PHP_SELF; ?>" method="post" enctype="multipart/form-data" >
        <p>Adress
<input type="text" name="title"/>
</p>
<div>
<textarea class="tinymce" id="elml" name="elml"></textarea>
</div>
<p>
<div class="heee">
<input type="hidden" name="MAX_FILE_SIZE" value="800000"/>
<input  type="file" name="upload"/>
</div>
</p>
<p>
    <div class="heee">
<input  type="submit" name="submit" value="process"/>
</div>
</p>
    </form>
    </div>
    </div>
   </div>
   </div>
</body>
</html>