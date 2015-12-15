<h1>Historia Documentos</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<a href="<?php echo base_url()?>portafolio/obtener_portafolio/<?php echo $id_port ?>">Volver</a>
<br><br>

<?php
	if ($esCreadorPortafolio || $esCreadorDocumento || ($tienePermisos && ($tienePermisos->PER_ID == 2))) {
?>
  <a href="<?php echo base_url()?>documento/versionar_documento/<?php echo $id_port ?>/<?php echo $id_doc ?>">Nueva Version</a>
  <br>
<?php
	}
?>

<?php
	if ($esCreadorPortafolio || $esCreadorDocumento || $tienePermisos) {
?>

  <table>
  	<tr>
  		<th> # </th>
  		<th>USUARIO</th>
  		<th>FECHA</th>
  		<th>COMENTARIO</th>
  		<th>DESCARGAR</th>
  	</tr>
  <?php
  $enumerador =1;
  foreach ($versiones as $ver)
  {
  ?>
  	<tr>
  		<td><?php echo $ver->VER_NUMERO ?></td>
  		<td><?php echo $ver->ID_USUARIO ?></td>
  		<td><?php echo $ver->VER_FECHA ?></td>
  		<td><?php echo $ver->VER_COMENTARIO ?></td>
  		<td align="center"><a href="<?php echo base_url()?>documento/descargar_version/<?php echo $id_doc ?>/<?php echo $ver->VER_ID ?>"><i class="fa fa-file"></i></a></td>
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
	if ($esCreadorPortafolio || $esCreadorDocumento) {
?>
  <br><br>
  <h1>Permiso Documentos</h1>
  <a href="<?php echo base_url()?>documento/darpermiso_documento/<?php echo $id_port ?>/<?php echo $id_doc ?>">Permiso a Documento</a>
  <table>
  	<tr>
  		<th> # </th>
  		<th>USUARIO</th>
  		<th>DOCUMENTO</th>
  		<th>PERMISO</th>
  		<th>ACCION</th>
  	</tr>
  <?php
  $enumerador =1;
  foreach ($permisos as $per)
  {
  ?>
  	<tr>
  		<td align="center"><?php echo $enumerador ?></td>
  		<td><?php echo $per->USU_NOMBRES.' '.$per->USU_APELLIDO_PATERNO ?></td>
  		<td><?php echo $per->DOC_NOMBRE ?></td>
  		<td><?php echo $per->PER_DESCRIPCION ?></td>
  		<td>
				<a href="<?php echo base_url()?>documento/editar_permiso_usuario/<?php echo $per->DOC_ID ?>/<?php echo $id_port ?>/<?php echo $per->USU_ID ?>">Editar</a>
  			<a href="<?php echo base_url()?>documento/quitarpermiso_documento/<?php echo $per->DOC_ID ?>/<?php echo $per->USU_ID ?>/<?php echo $per->PER_ID ?>/<?php echo $id_port ?>">Eliminar</a>
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
