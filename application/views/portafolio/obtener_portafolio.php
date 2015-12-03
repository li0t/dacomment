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
		<th>USUARIO</th>>
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
