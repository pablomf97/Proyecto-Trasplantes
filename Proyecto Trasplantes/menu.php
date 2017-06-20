<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Proyecto Trasplantes</title>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
	</head>

	<body>
		 <div class="menu2" style="height:100%; width:20%; background-color: #21302a; position:absolute; margin-top:0px">
				<ul>

					<li>----------------Menu----------------</li>
					<li style="cursor: pointer" onclick="location.href='about.php'">
						Inicio
					</li>
					<li style="cursor: pointer">
					<div class="dropdown"> Listado de:
                       <div class="dropdown-content">
                       <a style="cursor: pointer" href="lista_medicos.php">Listado médicos</a>
                       <a style="cursor: pointer" href="lista_enfermeros.php">Listado enfermeros</a>
                       <a style="cursor: pointer" href="lista_labs.php">Listado laboratorios</a>
                       </div>
                       </div>
					</li>
					<!--Aquí la idea es que al poner el click encima, salga para consultar un listado de medicos, enfermeros, o laboratorios -->
					<li style="cursor: pointer" onclick="location.href='todas_camas.php'">
						Listado de camas
					</li>
					<li style="cursor: pointer" onclick="location.href='form_buscar_eventos.php'">
            			Buscar eventos
          			</li>
          			<li class="hide">-</li>
                    <li><br/></li>
                    <li><br/></li>
                    <li><br/></li>
                    <li><br/></li>
                    <li><br/></li>
                    <li><br/></li>

				</ul>
		  </div>
	</body>
</html>
