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
<a href="<?php echo base_url()?>documento/versionar_documento/<?php echo $id_port ?>/<?php echo $id_doc ?>">Nueva Version</a>
<br>

<table border="1">
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
