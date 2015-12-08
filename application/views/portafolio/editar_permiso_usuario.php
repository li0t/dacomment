
	<h1>Editar Permisos  Portafolio</h1>
	<a href="<?php echo base_url()?>portafolio">Volver</a>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<?php
$atributos = array('id'=>'editarpermiso','name'=>'editarpermiso');
echo form_open_multipart(null,$atributos);
?>
<p>Nombre</p><input type="text" id="usuarioid" name="usuarioid" value="<?php echo $usuario ?>" readonly/>
<br>
<select id="permisoid" name="permisoid">
	<?php
		foreach ($permisos as $per) {
	?>
	<option value="<?php echo $per->PER_ID ?>"><?php echo $per->PER_DESCRIPCION ?></option>
	<?php
		}
	?>
</select>
<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
<br>
<input type="submit" value="Editar Permiso"/>
<?php
echo form_close();
?>
