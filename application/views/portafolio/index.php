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

<table border="1">
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>FECHA</th>
		<th>ACCION</th>
	</tr>
	<?php
		foreach ($portafolios as $por) {
	?>
		<tr>
			<td><?php echo $por->PRO_ID ?></td>
			<td><?php echo $por->PRO_NOMBRE ?></td>
			<td><?php echo $por->PRO_FECHA ?></td>
			<td>
				<a href="<?php echo base_url()?>portafolio/editar_portafolio/<?php echo $por->PRO_ID ?>">Editar</a>
				<a href="<?php echo base_url()?>portafolio/eliminar_portafolio/<?php echo $por->PRO_ID ?>">Eliminar</a>
			</td>
		</tr>
	<?php
		}
	?>
</table>
