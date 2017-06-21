</div>
	  <?php
	   include_once ("menu2.php");
	  ?>
	  	 <div class="tituloPagina"></div>
			<div style="margin-left:25%;"class="col-5 col-tab-5 texto5">
				<article class="paciente">
					<form method="post" action="controlador_paciente.php">
						<div class="fila_paciente">
                            <?php
                            if((isset($_SESSION["nuevo"]) and $_SESSION["nuevo"]==TRUE)||isset($paciente)) {
                                ?><h3>Creando nuevo paciente:</h3>
                                <!-- Editando título -->
                                <h4>Nombre: <input id="NOMBRE" name="NOMBRE"
                                                   type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NOMBRE"]; ?>"/><?php if (!isset($temp)) echo($fila["NOMBRE"]); ?>
                                </h4>
                                <h4>NIF: <input id="NIF" name="NIF" pattern="^[0-9]{8}[A-Z]"
                                                title="Ocho dígitos seguidos de una letra mayúscula"
                                                type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NIF"]; ?>"/><?php if (!isset($temp)) echo($fila["NIF"]); ?>
                                </h4>
                                <h4>Nº Seguridad Social: <input id="NSEGSOC" name="NSEGSOC"
                                                                type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NSEGSOC"]; ?>"/> <?php if (!isset($temp)) echo($fila["NSEGSOC"]); ?>
                                </h4>
                                <h4>Fecha de nacimiento: <input id="FECHANAC" pattern="[0-9]{2}/[0-9]{2}/[0-9]{2}"
                                                                title="dd/mm/aa" name="FECHANAC"
                                                                type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["FECHANAC"]; ?>"/><?php if (!isset($temp)) echo($fila["FECHANAC"]); ?>
                                </h4>
                                <h4>Dirección: <input id="DIRECCION" name="DIRECCION" type="text"
                                                      value="<?php echo $fila["DIRECCION"]; ?>"/></h4>
                                <h4>Código postal: <input id="CP" name="CP" type="text" pattern="^[0-9]{5}"
                                                          title="Cinco dígitos" value="<?php echo $fila["CP"]; ?>"/>
                                </h4>
                                <h4>Localidad: <input id="LOCALIDAD" name="LOCALIDAD" type="text"
                                                      value="<?php echo $fila["LOCALIDAD"]; ?>"/></h4>
                                <h4>Provincia: <input id="PROVINCIA" name="PROVINCIA" type="text"
                                                      value="<?php echo $fila["PROVINCIA"]; ?>"/></h4>
                                <h4>Teléfono: <input id="TELEFONO" name="TELEFONO" pattern="^[0-9]{9}"
                                                     title="Nueve dígitos" type="tel"
                                                     value="<?php echo $fila["TELEFONO"]; ?>"/></h4>
                                <h4>Médico de familia: <input id="MEDICOFAMILIA" name="MEDICOFAMILIA" type="text"
                                                              value="<?php echo $fila["MEDICOFAMILIA"]; ?>"/></h4>
                                <h4>Centro de salud: <input id="CENTROSALUD" name="CENTROSALUD" type="text"
                                                            value="<?php echo $fila["CENTROSALUD"]; ?>"/></h4>
                                <?php
                            }else{
                            ?>
							<div class="datos_paciente">
								<input id="NOMBRE" name="NOMBRE"
									type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
								<input id="NIF" name="NIF"
									type="hidden" value="<?php echo $fila["NIF"]; ?>"/>
								<input id="NSEGSOC" name="NSEGSOC"
									type="hidden" value="<?php echo $fila["NSEGSOC"]; ?>"/>
								<input id="FECHANAC" name="FECHANAC"
									type="hidden" value="<?php echo $fila["FECHANAC"]; ?>"/>
								<input id="DIRECCION" name="DIRECCION"
									type="hidden" value="<?php echo $fila["DIRECCION"]; ?>"/>
								<input id="CP" name="CP"
									type="hidden" value="<?php echo $fila["CP"]; ?>"/>
								<input id="LOCALIDAD" name="LOCALIDAD"
									type="hidden" value="<?php echo $fila["LOCALIDAD"]; ?>"/>
								<input id="PROVINCIA" name="PROVINCIA"
									type="hidden" value="<?php echo $fila["PROVINCIA"]; ?>"/>
								<input id="TELEFONO" name="TELEFONO"
									type="hidden" value="<?php echo $fila["TELEFONO"]; ?>"/>
								<input id="MEDICOFAMILIA" name="MEDICOFAMILIA"
									type="hidden" value="<?php echo $fila["MEDICOFAMILIA"]; ?>"/>
								<input id="CENTROSALUD" name="CENTROSALUD"
									type="hidden" value="<?php echo $fila["CENTROSALUD"]; ?>"/>

									<!-- mostrando título -->
									<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
									<div class="paciente_param"><em><?php echo $fila["NOMBRE"]; ?></em>, DNI: <em><?php echo $fila["NIF"]; ?></em></div>
									<div class="paciente_param">Número de seguridad social: <em><?php echo $fila["NSEGSOC"]; ?></em></div>
									<div class="paciente_param">Fecha de nacimiento: <em><?php echo $fila["FECHANAC"]; ?></em></div>
									<div class="paciente_param">Dirección: <em><?php echo $fila["DIRECCION"]."</em>, CP: <em>".$fila["CP"].", ".$fila["LOCALIDAD"]." (".$fila["PROVINCIA"].")"; ?></em></div>
									<div class="paciente_param">Teléfono: <em><?php echo $fila["TELEFONO"]; ?></em></div>
									<div class="paciente_param">Centro de salud: <em><?php echo $fila["CENTROSALUD"]; ?></em></div>
									<div class="paciente_param">Médico de familia: <em><?php echo $fila["MEDICOFAMILIA"]; ?></em></div>
							</div>
                            <?php } ?>

						</div>
					</form>
				</article>
			</div>
			<?php
			include_once ("footer.php");
			cerrarConexionBD($conexion);
			?>
		</div>
	</body>
</html>