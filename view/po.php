<!--AUTOCOMPLETAR NOT FOUND,-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href= ../style/bootstrap.css >
	<link rel="stylesheet" href= ../js/jquery-3.7.0.js >
    <link rel="stylesheet" href= ../style/styles.css >
    <link rel="stylesheet" href="../datatables.css" >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* estilos */
    </style>


    <?php
    session_start();
    ?>

    <title>Navidad</title>
    
  </head>
  <body id = "bodyt">
  <!--NAV BAR NEW -->
<?php
include_once("./nav_bar.php");
?>

<!--NAV BAR END -->
    
   

      <!--  x-->
      <?php 
		

	
	  require_once '../controller/controller_vista.php';
      $nu = 5;
	  //permisos
	  if($nu == 1){
        test();
      }

	  //etnia
      elseif($nu == 2){
		test2();
		
      }

      //persona
      elseif($nu == 3){
		test3();
		
      }
      
      //organizacion
      elseif($nu == 4){
		test4();
		
      }

      //Detalle_PO
      elseif($nu == 5){
		test5();
		
      }
      
      ?>
    <!-- -->
    </div>
	
    </div>
    

    
    
  </body>
</html>
    