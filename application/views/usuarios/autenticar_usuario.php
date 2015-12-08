
	<h1>Login</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<?php
$atributos = array('id'=>'autenticarusuario','name'=>'autenticarusuario');
echo form_open_multipart(null,$atributos);
?>
<div>
<h4>Rut</h4><input type="text" id="rutusuario" name="rutusuario" value="<?php echo set_value("USU_RUT")?>" placeholder="Ingresa tu rut"/>
<h4>Password</h4><input type="text" id="passusuario" name="passusuario" value="<?php echo set_value("USU_PASSWORD")?>" placeholder="Ingresa tu password"/>
</div>
<br>
<div>
<input type="submit" value="Enviar"/>
</div>
<?php
echo form_close();
?>
