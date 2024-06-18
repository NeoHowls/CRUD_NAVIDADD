<table id="myTable" class="table table-striped nowrap" style="width:100%">
        
            
            <thead>
            <tr>
                
                <th>id</th>
                <th>correlativo</th>
                <th>dni</th>
                <th>nombre</th>
                <th>sexo</th>
                <th>edad</th>

                <th>periodo</th>
                <th>descripcion</th>
                <th>fechaRegistro</th>
                <th>Naciemiento</th>
                <th>etnia</th>

                <th class="none">nacionalidad</th>
                <th class="none">comuna</th>
                <th class="none">tipo</th>
                <?php 
                if ($_SESSION["CUN"] == 1) {
                    echo "<th class='all'>acciones</th>";
                }
                else{
                    echo "<th class='never'>acciones</th>";
                }

                ?>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
    <script type="text/javascript" src="datatables.js"></script>
    <script type="text/javascript" src="js/ajax/idioma.js"></script>>
    <script type="text/javascript" src="index1.js">
        
    </script>