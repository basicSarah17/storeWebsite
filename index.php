<?php
// Include the database connection file
require_once 'config.php';
?>
<html lang="en"> 
<head> 

<link rel="stylesheet" href="./css/index.css">
</head>
<body> 

    <header>
   <form action="/search" method="get"> 
  <input type="text" name="query" placeholder="Search..."> 
  <button type="submit">Search</button> 
  <title>SIX DIAMONDS-home page </title>
 
  
  <?php
require 'navbar.php';

?>


  <main> 
    <h1> Welcome to our website</h1> 
    <img src="./image/logo.jpeg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    </header> 
    </form> 
</main> 



   
<br>
<br>
<br>

<form ><fieldset style="background-image:url(./image/gray.jpeg); background-repeat:repeat">
<legend><h1 style="font-family: serif;">SixDiamonds</h1></legend>
<h3>Six diamonds is
A website that sells jewelry online and enables you to buy and design jewelry online, where you can have a more enjoyable shopping experience.
This jewelry website offers you a wide range of jewelry in various shapes and sizes, including rings, bracelets, necklaces, earrings, and other pieces.</h3></figcaption>
</fieldset>
</form>

<br><br>
<div></div>
<br><br>
<br><br>
<br><br>


<footer>
<h2> TO CONTACT US</h2>
<ul>
<li>EMAIL:info@almass.com</li>
<li>PHONE:0116576546</li>
</ul>
</footer>


</body> 
</html>

<?php   require 'chatPage.php'; ?>