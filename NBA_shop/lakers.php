<?php 
   require 'config.php';

   // prepare sql statement 
   $sql = "SELECT * FROM images";
   
   $result  = mysqli_query($connection, $sql);

   // close connection to DB
   mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en-GB">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="style.css" type="text/css" />
  <link rel="icon" href="images/NBA.jpg" width="32px" />

  <title>NBA SHOP</title>
</head>

<body>
  <ul class="skip-links">
    <li><a href="#main_nav">Skip to navigation</a></li>
    <li><a href="#features">Skip to the main content</a></li>
  </ul>
  <header>
    <main class="brandheader">
      <img src="images/logo.jpg" alt="logo" class="homeLogo">
      <h1>UNOFFICIAL STORE</h1>
    </main>
    <h2>NBA Jerseys</h2>
    <nav id="main_nav">
      <a href="login.php">Members area</a>
      <a href="index.html">Home</a>
      <a href="lakers.php">New products</a>
      <a href="lakers.html">Lakers</a>
      <a href="bulls.html">Bulls</a>
      <a href="recomendations.html">Customer reviews</a>
      <a href="form.html">Contact us</a>
    </nav>
  </header>
  <main>
    <h2>New Products</h2>
    <section class="features" id="features">
      <?php 
        $rows =  mysqli_num_rows($result);
        if ($rows > 0 ){
              while( $row = mysqli_fetch_assoc($result)){
           
          ?>
      <figure id="adFigure">
        <img src="<?php echo $row['url']?>" alt="Anthony Davis Jersey"> 
        <h4><?php echo $row['description']?></h4>
        <button class="buttonADd">ADD</button>
      </figure>
      <?php    }    }?>
  
    </section>
  </main>
  <footer class="footer">
    <main class="footer-list">
      <a href="#" class="footer-link">Home</a>
      <a href="#" class="footer-link">Lakers</a>
      <a href="#" class="footer-link">Bulls</a>
      <a href="#" class="footer-link">Customer reviews</a>
      <a href="#" class="footer-link">Contact us</a>
    </main>
  </footer>
</body>

</html>