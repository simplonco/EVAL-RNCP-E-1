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
session_start();
if (!isset($_SESSION['username'])) {
   header("location:login.php");
}


?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script>
$(document).ready(function(){$("tr:odd").addClass("odd");});
</script>

<?php
   /*
      Place code to connect to your DB here.
   */
   $connect=mysqli_connect('localhost','root','afpc1234','flip');// include your code to connect to DB.
   
   $tbl_name="threads";     //your table name
   // How many adjacent pages should be shown on each side?
   $adjacents = 3;
   
   /* 
      First get total number of rows in data table. 
      If you have a WHERE clause in your query, make sure you mirror it here.
   */
   $query = "SELECT COUNT(*) as num FROM $tbl_name where status=0";
   $total_pages = mysqli_fetch_array(mysqli_query($connect,$query));
   $total_pages = $total_pages[num];
   
   /* Setup vars for query. */
   $targetpage = "unpublish.php";    //your file name  (the name of this file)
   $limit = 8;                         //how many items to show per page
   $page = $_GET['page'];
   if($page) 
      $start = ($page - 1) * $limit;         //first item to display on this page
   else
      $start = 0;                      //if no page var is given, set start to 0
   
   /* Get data. */
   $sql = "SELECT title,id,status FROM threads order by id desc LIMIT $start, $limit";
   $result = mysqli_query($connect,$sql);
  
   /* Setup page vars for display. */
   if ($page == 0) $page = 1;             //if no page var is given, default to 1.
   $prev = $page - 1;                     //previous page is page - 1
   $next = $page + 1;                     //next page is page + 1
   $lastpage = ceil($total_pages/$limit);    //lastpage is = total pages / items per page, rounded up.
   $lpm1 = $lastpage - 1;                 //last page minus 1
   
   /* 
      Now we apply our rules and draw the pagination object. 
      We're actually saving the code to a variable in case we want to draw it more than once.
   */
   $pagination = "";
   if($lastpage > 1)
   {  
      $pagination .= "<div class=\"pagination\">";
      //previous button
      if ($page > 1) 
         $pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
      else
         $pagination.= "<span class=\"disabled\">� previous</span>"; 
      
      //pages  
      if ($lastpage < 7 + ($adjacents * 2))  //not enough pages to bother breaking it up
      {  
         for ($counter = 1; $counter <= $lastpage; $counter++)
         {
            if ($counter == $page)
               $pagination.= "<span class=\"current\">$counter</span>";
            else
               $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";              
         }
      }
      elseif($lastpage > 5 + ($adjacents * 2))  //enough pages to hide some
      {
         //close to beginning; only hide later pages
         if($page < 1 + ($adjacents * 2))    
         {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
            {
               if ($counter == $page)
                  $pagination.= "<span class=\"current\">$counter</span>";
               else
                  $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";              
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";      
         }
         //in middle; hide some front and some back
         elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
         {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
            {
               if ($counter == $page)
                  $pagination.= "<span class=\"current\">$counter</span>";
               else
                  $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";              
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";      
         }
         //close to end; only hide early pages
         else
         {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
            {
               if ($counter == $page)
                  $pagination.= "<span class=\"current\">$counter</span>";
               else
                  $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";              
            }
         }
      }
      
      //next button
      if ($page < $counter - 1) 
         $pagination.= "<a href=\"$targetpage?page=$next\">next �</a>";
      else
         $pagination.= "<span class=\"disabled\">next �</span>";
      $pagination.= "</div>\n";     
   }
?>
<h1 class='title'>TABLEAU DE NONPUBLIER ARTICLES</h1>
<form action="#" method="post">

   <?php
if ($_GET['box']=='publish') {

   $id=intval($_GET['id']);
   $connect=mysqli_connect('localhost','root','afpc1234','flip');
   $query1="UPDATE threads SET status=1 WHERE id=$id";
   $sql=mysqli_query($connect,$query1);
   header("location:unpublish.php");
} 

        echo "<table class='table' width='50%' cellpadding='0' cellspacing='0'>";
      ?>
      <tr>
      <td>id</td>
      <td>article</td>
      <td>#</td>
      <td>#</td>
      <td>#</td>
      <td>#</td>
      </tr>
      <?php
      $id=1;
        while($row=mysqli_fetch_object($result)){

      if ($row->status==0) {
?>
            <tr>
            <td><?php echo $id++; ?></td>
         <td><?php echo $row->title;?></td>
         <td><a href='edit.php?id=<?php echo $row->id;?>'>Modifier</a></td>
         <td><input type="checkbox" name="checkbox[]" value="<?php echo $row->id;?>"></a></td>
            <td><input  type="submit" name="delete" value="Supprimer"/></td>
         <?php echo
         "<td><a href='unpublish.php?box=publish&id={$row->id}'>publish</a></td>"?>
         </tr>
         <?php
         } 
        }
        echo "</table>";
$num=mysqli_num_rows($result);
if ($_POST['delete']) {
    foreach($_POST['checkbox'] as $selected){
      $sql2="DELETE FROM threads WHERE id='$selected'";
      $query2=mysqli_query($connect,$sql2);
    }

    if($query2){
      
      echo "<meta http-equiv='refresh' content='0;url=delete2.php?id=".$id."'>";
    }
  }
mysqli_close($connect);
?>
</form>
<?=$pagination?>
</div>
</div>
</body>
</html>