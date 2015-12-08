<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<?php
	$usuario = $this->session->userdata('usuario');

	if ($usuario) {
?>
	<p style="color:red;">
	<?php echo $usuario->USU_ID ?>
  </p>
<?php
	}
?>

<div id="container">
	<h1>Bienvenido a Dacomment</h1>
	<p>Gestión documental diseñada para ti</p>
</div>
