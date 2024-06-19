<nav class="navbar navbar-expand-lg navbar-dark baanner_bg">
		<div class="container-fluid">
			<a class="navbar-brand" href=""><img src="../images/multicultural para fondos color - blanco.png" alt="image"> <!--img src="images/NAVIDAD LOGO YO AMO.png"--></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- Button trigger modal-->
			

			<!-- Barra de navegador  realizar cambio para que tenga campos relaciondos con la id -->

			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav ms-auto">
				<li class="nav-item">
						<a class="nav-link" href="ninos.php" id ="1" value = 1 name = "insert">Ver niños</a>
					</li>
          <li class="nav-item">
						<a class="nav-link" href="persona.php">Ver Persona</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="organizacion.php">Ver Organizacion</a>
					</li>
          <li class="nav-item">
						<a class="nav-link" href="po.php">Ver Detalle PO</a>
					</li>
					<li class="dropdown">
						<a class="nav-link"class="dropbtn">Registro de Cambios</a>
                <div class="dropdown-content">
                    <a href="#registro-cambios-ninos">Registro cambio Niños</a>
                    <a href="pHistorial.php">Registro cambio Personas</a>
                    <a href="oHistorial.php">Registro cambio Organizacion</a>
                </div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tipo_u.php">Tipo Usuario</a>
					</li>
					<li class="nav-item">
					<a class="btn btn-danger nav-link"  onclick="myFunction()">
						CERRAR  
            </a>
						</li>
<p id="demo"></p>


							<script>
								function myFunction() {
									Swal.fire({
									icon: "warning",
									title: "SALIENDO",
									width: 300,
									showConfirmButton: false,
									timer: 1500
									
									});
									const myTimeout = setTimeout(myGreeting, 1700);

									function myGreeting() {
										window.location.href="./cerrar.php"
								}
								}
							</script>
						</li>
					
				
					</ul>
				</ul>
			</div>
		</div>
</nav>