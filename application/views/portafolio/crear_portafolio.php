
	<h1>Nuevo Portafolio</h1>
	<a href="<?php echo base_url()?>portafolio">Volver</a>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php	
	}
?>

<?php
$atributos = array('id'=>'nuevoportafolio','name'=>'nuevoportafolio');
echo form_open_multipart(null,$atributos);
?>
<p>Nombre</p><input type="text" id="nomportafolio" name="nomportafolio" value="<?php echo set_value("PRO_NOMBRE")?>"/>
<hr>
<input type="submit" value="Crear Portafolio"/>
<?php
echo form_close();
?>