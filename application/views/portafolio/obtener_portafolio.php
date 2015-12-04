<h1>Detalle de Portafolio</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<h4>Nombre:</h4>
<?php echo $portafolio->PRO_NOMBRE ?> <br>

<h4>Documentos:</h4>

<table border="1">
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>USUARIO</th>
	</tr>
	<?php
		foreach ($documentos as $doc) {
	?>
		<tr>
			<td><a href="<?php echo base_url()?>documentos/<?php echo $doc->DOC_ID ?>"><?php echo $doc->DOC_ID ?></a> ?></td>
			<td><?php echo $doc->DOC_NOMBRE ?></td>
			<td><?php echo $doc->ID_USUARIO ?></td>
		</tr>
	<?php
		}
	?>
</table>

<h4><a href="<?php echo base_url()?>portafolio/entregar_nuevo_permiso/<?php echo $portafolio->PRO_ID ?>">Entregar Permisos</a> </h4>

<table border="1">
	<tr>
		<th>USUARIO</th>
		<th>PERMISO</th>
		<th>ACCIONES</th>
	</tr>
	<?php
		foreach ($permisos as $per) {
	?>
		<tr>
			<td><?php echo $per->USU_ID ?></td>
			<td><?php echo $per->PER_ID ?></td>
			<td>
				<a href="<?php echo base_url()?>portafolio/editar_permiso_usuario/<?php echo $per->PRO_ID ?>/<?php echo $per->USU_ID ?>">Editar</a>
				<a href="<?php echo base_url()?>portafolio/eliminar_permiso_usuario/<?php echo $per->PRO_ID ?>/<?php echo $per->USU_ID ?>">Eliminar</a>
			</td>
		</tr>
	<?php
		}
	?>
</table>
