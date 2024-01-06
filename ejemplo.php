  <!-- CONTENEDOR CENTRAL-->
  <div class="contenedorCentral">
		<div class="menu">
			<img src="imagenes/logo2.png" alt="logo" class="logo">
			<ul class="menu-content">
				<li><a href="usuario.php">Mi Usuario</a></li>
				<li><a href="home.php">Productos</a></li>
				<li><a href="pedidos.php">Mis Pedidos</a></li>
				<li><a href="cerrar.php">Cerrar sesion</a></li>
			</ul>
		</div>

    <!-- CONTENEDOR DEL CARRUSEL, esta echo con una libreria de Bootstrap  cuenta con 3 imagenes-->
		<div class="banner">
			<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
				<div class="carousel-indicators">
					<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
					<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
					<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
				</div>
				<div class="carousel-inner">
					<div class="carousel-item active" data-bs-interval="3000">
						<img src="imagenes/imagen5.jpg" class="imagenCarrusel" alt="banner">
						<div class="carousel-caption d-none d-md-block"></div>
					</div>
					<div class="carousel-item" data-bs-interval="3000">
						<img src="imagenes/imagencarrusel.jpg" class="imagenCarrusel" alt="banner">
						<div class="carousel-caption d-none d-md-block"></div>
					</div>
					<div class="carousel-item" data-bs-interval="3000">
						<img src="imagenes/imagen3.jpg" class="imagenCarrusel" alt="banner">
						<div class="carousel-caption d-none d-md-block"></div>
					</div>
				</div>
			</div>
		</div>