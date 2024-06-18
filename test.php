<?php 

session_start();

if ($_SESSION["id_p"] == 1){

    echo "ERES ADMIN ";

}
elseif ($_SESSION["id_p"] == 2) {
    echo "ERES VISOR";
}
elseif ($_SESSION["id_p"] == 3) {
    echo "ERES REPRESENTANTE";
}
elseif ($_SESSION["id_p"] == 4) {
    echo "ERES PROVIDENCIA";
}
?>