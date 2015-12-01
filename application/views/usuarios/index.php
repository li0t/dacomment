<h1>Gestion de Usuarios</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<table border="1">
	<tr>
		<th>ID</th>
    <th>RUT</th>
		<th>NOMBRES</th>
		<th>APELLIDO PATERNO</th>
    <th>APELLIDO MATERNO</th>
	</tr>
	<?php
		foreach ($usuarios as $usu) {
	?>
		<tr>
			<td><?php echo $usu->USU_ID ?></td>
      <td><?php echo $usu->USU_RUT ?></td>
			<td><?php echo $usu->USU_NOMBRES ?></td>
			<td><?php echo $usu->USU_APELLIDO_PATERNO ?></td>
      <td><?php echo $usu->USU_APELLIDO_MATERNO ?></td>
		</tr>
	<?php
		}
	?>
</table>
