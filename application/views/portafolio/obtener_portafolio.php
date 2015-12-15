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

<br>

<?php
	if ($esCreador || ($tienePermisos && ($tienePermisos->PER_ID == 2))) {
?>
	<a href="<?php echo base_url()?>documento/subir_documento/<?php echo $portafolio->PRO_ID ?>">Nuevo Documento</a>
<?php
	}
?>

<?php
	if ($esCreador || $tienePermisos) {
?>

  <h4>Documentos:</h4>

  <table>
  	<tr align="center">
  		<th>#</th>
  		<th>NOMBRE</th>
  		<th>DUEÑO</th>
  		<th>DESCRIPCION</th>
  		<th>ACCIONES</th>
  	</tr>
  	<?php
  	$enumerador =1;
  		foreach ($documentos as $doc) {

  	?>
  		<tr>
  			<td align="center"><?php echo $enumerador ?></td>
  			<td><?php echo $doc->DOC_NOMBRE ?></td>
  			<td><?php echo $doc->ID_USUARIO ?></td>
  			<td><?php echo $doc->DOC_DESCRIPCION ?></td>
  			<td colspan = 3 >
  				<a href="<?php echo base_url()?>documento/historia_documento/<?php echo $doc->DOC_ID ?>/<?php echo $portafolio->PRO_ID ?>">VER</a>
  			</td>
  		</tr>
  	<?php
  		$enumerador++;
  		}
  	?>
  </table>
<?php
	}
?>

<?php
	if ($esCreador) {
?>
  <h4><a href="<?php echo base_url()?>portafolio/entregar_nuevo_permiso/<?php echo $portafolio->PRO_ID ?>">Entregar Permisos</a> </h4>

  <table>
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
<?php
	}
?>
