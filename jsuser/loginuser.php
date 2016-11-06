<!DOCTYPE html>
<html>

<?php include 'header.inc.php'; ?>
<body>
<div id="wrapper">
  <div id="page-wrapper" >
            <div id="page-inner">
  <div id="login">
    <h1>Connexion</h1>
    <form action="checkuser.php" method="post">
    <p>
      <label for="username">Nom d'utilisateur</label>
      </p>
      <input type="text" name="username" placeholder="Nom d'utilisateur"/>
    
    <p>
      <label for="password">   Mot de passe     </label>
      </p>
      <input type="password" name="password" placeholder="Mot de passe"/>
    
     <p>
      <input type="submit" name="submit" id="submit" value="Valider"/>
    </p>  
    </form>
    <a href="adduser.php">Inscription</a>
  </div>
  </div>
  </div>
  </div>
</body>
</html>