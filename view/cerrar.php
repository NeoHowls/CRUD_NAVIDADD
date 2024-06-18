<?php 
session_start();
if(isset($_SESSION['test'])){
    /*
    var_dump( $_COOKIE);
    print("<br>");
    var_dump($_SESSION);

    print("<br>");
    print("<br>");
    session_regenerate_id();
    session_destroy();

    var_dump( $_COOKIE);
    print("<br>");
    var_dump($_SESSION);
    */
    /* session_regenerate_id(); */
    session_destroy();
    ?>
    <script type="text/javascript"> 
    window.location.href="../../PAGINA_PRINCIPAL/index.php"
    </script> 
<?php
}

?>