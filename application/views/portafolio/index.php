<h1>Gestion de Portafolios</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<a href="<?php echo base_url()?>portafolio/crear_portafolio">Crear Portafolio</a>
<br><br>

<h3>MIS PORTAFOLIOS</h3>

<table border="1">
	<tr>
		<th>#</th>
		<th>NOMBRE</th>
		<th>USUARIO</th>
		<th>FECHA</th>
		<th>ACCION</th>
	</tr>
	<?php
	$enumerar = 1;
		foreach ($portafolios as $por) {
	?>
		<tr>
			<td align="center"><?php echo $enumerar ?></td>
			<td><?php echo $por->PRO_NOMBRE ?></td>
			<td><?php echo $por->USU_ID ?></td>
			<td><?php echo $por->PRO_FECHA ?></td>
			<td>
				<a href="<?php echo base_url()?>portafolio/obtener_portafolio/<?php echo $por->PRO_ID ?>">Ver</a>
				<a href="<?php echo base_url()?>portafolio/editar_portafolio/<?php echo $por->PRO_ID ?>">Editar</a>
				<a href="<?php echo base_url()?>portafolio/eliminar_portafolio/<?php echo $por->PRO_ID ?>">Eliminar</a>
			</td>
		</tr>
	<?php
		$enumerar ++;
		}
	?>
</table>

<br>

<h3>COMPARTIDOS CONMIGO</h3>

<table border="1">
	<tr>
		<th>#</th>
		<th>NOMBRE</th>
		<th>USUARIO</th>
		<th>FECHA</th>
		<th>ACCION</th>
	</tr>
	<?php
	$enumerar = 1;
		foreach ($compartidos as $por) {
	?>
		<tr>
			<td align="center"><?php echo $enumerar ?></td>
			<td><?php echo $por->PRO_NOMBRE ?></td>
			<td><?php echo $por->USU_ID ?></td>
			<td><?php echo $por->PRO_FECHA ?></td>
			<td>
				<a href="<?php echo base_url()?>portafolio/obtener_portafolio/<?php echo $por->PRO_ID ?>">Ver</a>
			</td>
		</tr>
	<?php
		$enumerar ++;
		}
	?>
</table>
