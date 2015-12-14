<h1>Permiso a documentos</h1>


<a href="<?php echo base_url()?>portafolio/obtener_portafolio/<?php echo $id_port ?>">Volver</a>
<br><br>


<?php
$atributos = array('id'=>'nuevopermisodoc','name'=>'nuevopermisodoc');
echo form_open_multipart(null,$atributos);
?>
Seleccione Usuario que se dará el permiso
<br>
<select id="userper" name="userper" required>
	<option value="" disabled selected>Seleccione usuario</option>
<?php
	foreach ($usuariosp as $usu)
	{
?>
		<option value="<?php echo $usu->USU_ID ?>"><?php echo $usu->USU_NOMBRES.' '.$usu->USU_APELLIDO_PATERNO ?></option>
<?php
	}
?>
</select>
<br>


Seleccione Tipo Permiso
<br>
<select id="permiso" name="permiso" required>
		<option value="" disabled selected>Seleccione Permiso</option>
<?php
	foreach ($permisos as $per) 
	{
?>
		<option value="<?php echo $per->PER_ID ?>"><?php echo $per->PER_DESCRIPCION ?></option>
<?php
	}
?>
</select>
<input type="hidden" id="id_doc" name="id_doc" value="<?php echo $id_doc ?>">
<input type="hidden" id="id_port" name="id_port" value="<?php echo $id_port ?>">
<br><br>
<input type="submit" value="Dar Permiso a Documento"/>

<?php
echo form_close();
?>