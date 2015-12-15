
	<h1>Entregar Permisos Portafolio</h1>
	<a href="<?php echo base_url()?>portafolio">Volver</a>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<?php
$atributos = array('id'=>'nuevopermiso','name'=>'nuevopermiso');
echo form_open_multipart(null,$atributos);
?>
<p>Nombre</p>
<select id="usuarioid" name="usuarioid" required>
	<option value="" disabled selected>Seleccione usuario</option>
<?php
	foreach ($listusu as $usu)
	{
?>
		<option value="<?php echo $usu->USU_ID ?>"><?php echo $usu->USU_NOMBRES.' '.$usu->USU_APELLIDO_PATERNO ?></option>
<?php
	}
?>
</select>
<!-- Esto debería recibir un nombre -->
<br>
<select id="permisoid" name="permisoid">
	<?php
		foreach ($permisos as $per)
		{
	?>
			<option value="<?php echo $per->PER_ID ?>"><?php echo $per->PER_DESCRIPCION ?></option>
	<?php
		}
	?>
</select>
<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
<br>
<input type="submit" value="Agregar Permiso"/>
<?php
echo form_close();
?>
