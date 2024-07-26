


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>¡Feliz Navidad!</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="css/pogo-slider.min.css">
	<!-- Responsive CSS -->
	<link rel="stylesheet" href="css/responsive.css">
	<!-- Styles CSS -->
	<link rel="stylesheet" href="css/styles.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark baanner_bg">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php"><img src="images/multicultural para fondos color - blanco.png" alt="image"> <!--img src="images/NAVIDAD LOGO YO AMO.png"--></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- Button trigger modal -->
			

			<!-- Modal -->
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title col-11 text-center" id="staticBackdropLabel">Iniciar Sesión</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="modal-body">
								<form autocomplete="off">
									<div class="mb-3">
										<label for="email" class="col-form-label">Usuario</label>
										<input type="text" class="form-control" id="emails" placeholder="Usuario">
									</div>
									<div class="mb-3">
										<label for="password" class="col-form-label">Contraseña</label>
										<input type="password" class="form-control" id="password" placeholder="Contraseña">
									
									</div>
									<div id="respuesta" class="mb-3"> </div>
								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-danger" id = "iniciar">Iniciar Sesión</button>
							

						</div>
					
					</div>

				</div>
			</div>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#about-us">Sobre Nosotros</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#gallery">Galeria</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#contact">Contacto</a>
					</li>
					
					
					<ul class="navbar-nav ml-auto">
					<div class="dropdown">
						<button class="dropbtn">Dropdown
						<i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content">
						<a href="#">Link 1</a>
						<a href="#">Link 2</a>
						<a href="#">Link 3</a>
						</div>
		
</ul>
					<li class="nav-item">
					<a class="btn btn-danger nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
						Inicio Sesión
</a>
						</li>
            </ul>
			
		</ul>
			
			</div>
		</div>
	</nav>



	<!-- Start Banner -->
	<div >
		<div class="container-fluid" id = "container" >
			<div class="row">

					
				<h2 class ="banner_ult">Felices Fiestas</h2>

			</div>
		</div>
	</div>
	<!-- End Banner -->

	<!-- about-us -->
	<div id="about-us" class="about-box" style="background-color: #f7f7f7;">
		<div class="about-a1">
			<div class="container" style = "background-color: #f7f7f7">
				<div class="row">
					<div class="col-lg-12" style = "background-color: #f7f7f7">
						<div class="title-box">
							<!--h2>Felices fiestas les desea la Municipalidad de Alto Hospicio</h2-->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="row align-items-center about-main-info">

							<div class="col-lg-6 col-md-6 col-sm-12 text_align_center">
								<div class="full">
									<img class="img-responsive" src="images/promocional1.jpg" alt="#" />
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<h2><img style="width: 60px;" src="images/maho_logo.png" alt="#" />Quienes somos</h2>
								<p>La Municipalidad de Alto Hospicio tiene como principal objetivo entregar a sus vecinos oportunidades y garantías de vivir en una 
									comuna preocupada de sus necesidades, a través de distintos proyectos que permitan un mejor desarrollo de la calidad de vida de 
									sus habitantes y el territorio, así como en las diversas áreas del quehacer comunal.</p>

								<a href="#" class="hvr-radial-out button-theme">Leer Mas</a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="about-a1" style="background-color: #f7f7f7 ; ">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="row align-items-center about-main-info">

							<div class="col-lg-6 col-md-6 col-sm-12">
								<h2><img style="width: 60px;" src="images/maho_logo.png" alt="#" /> Donde Estamos</h2>
								<p>
								Teléfono: 57 2583231
								<br>
								Dirección Municipalidad:
								<br>
								Av Ramón Pérez Opazo # 3125
								<br>
								Horarios Atención:
								<br>
								Lunes a Viernes: 8:30 am – 13:00 hrs </p>

								<a href="#" class="hvr-radial-out button-theme">Leer Mas</a>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 text_align_center">
								<div class="full">
									<img class="img-responsive" src="images/promocional2.jpg" alt="#" />
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- about-us -->
	<div class="title-box" id = "gallery">
	<br>
	<h2>Galeria</h2>
	</div>
	<!-- gallery -->
	<div  class="gallery-box" style="background: #f7f7f7;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">

					</div>
				</div>
			</div>
			<!--Carrusel -->
			<div class="row">
				<ul class="popup-gallery clearfix">
					<li>
						<a href="images/galeria1.jpg">
							<img class="img-fluid" src="images/galeria1.jpg" alt="single image">
							<span class="overlay"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
						</a>
					</li>
					<li>
						<a href="images/galeria2.jpg">
							<img class="img-fluid" src="images/galeria2.jpg" alt="single image">
							<span class="overlay"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
						</a>
					</li>
					<li>
						<a href="images/galeria3.jpg">
							<img class="img-fluid" src="images/galeria3.jpg" alt="single image">
							<span class="overlay"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
						</a>
					</li>
					<li>
						<a href="images/galeria4.jpg">
							<img class="img-fluid" src="images/galeria4.jpg" alt="single image">
							<span class="overlay"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
						</a>
					</li>
					<li>
						<a href="images/galeria5.jpg">
							<img class="img-fluid" src="images/galeria5.jpg" alt="single image">
							<span class="overlay"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
						</a>
					</li>
					<li>
						<a href="images/galeria6.jpg">
							<img class="img-fluid" src="images/galeria6.jpg" alt="single image">
							<span class="overlay"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
						</a>
					</li>
				</ul>
				
			</div>
		</div>
	</div>
	<!-- end gallery -->
	<div class="title-box">
	<br>
	<h2>Contactenos</h2>
	</div>
	<!-- contact -->
	<div id="contact" class="contact-box" style="background: #f7f7f7;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-6">
					<div class="contact-block">
						<form id="contactForm">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control mt-3" id="name" name="name" placeholder="Nombre" required data-error="Porfavor ingrese su nombre">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" placeholder="Correo Electronico" id="email" class="form-control mt-3" name="name" required data-error="Porfavor ingrese su correo electronico">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="number" placeholder="Numero telefonico" id="number" class="form-control mt-3" name="number" required data-error="Porfavor ingrese su numero telefonico" min =0 max = "999999999" onKeyPress="if(this.value.length==9) return false;"/>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="form-control mt-3" id="message" placeholder="Ingrese su mensaje" rows="8" data-error="Escriba su mensaje" required></textarea>
										<div class="help-block with-errors"></div>
									</div>
									<div class="submit-button text-center">
										<button class="btn btn-common mt-3" id="submit" type="submit">Enviar</button>
										<div id="msgSubmit" class="h3 text-center hidden"></div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact -->
	<!-- Start Footer -->
	<footer class="footer-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="footer-company-name">Municipalidad de Alto Hospicio </p>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/popper.min.js"></script>

	<script src="js/jquery.magnific-popup.min.js"></script>

	<script src="js/jquery.pogo-slider.min.js"></script>
	
	 
	
	<script src="js/slider-index.js"></script>
	


	<script src="js/form-validator.min.js"></script>
	<script src="js/contact-form-script.js"></script>
	<script src="js/isotope.min.js"></script>
	<script src="js/images-loded.min.js"></script>
	<!--Causa problemas en la velocidad de la pagina y en el scrolls-->
	<script src="js/custom.js"></script> 

	<script type="text/javascript" src="./datatables.js"></script>
    <script type="text/javascript" src="./js/idioma.js"></script>
    <script type="text/javascript" src="./js/INICIAR_SESION.js"></script>


	

	
</body>

</html>