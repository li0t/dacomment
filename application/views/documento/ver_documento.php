<h1>Hitoria Documentos</h1>


<a href="<?php echo base_url()?>portafolio/obtener_portafolio/<?php echo $id ?>">Volver</a>


<table border="1">
	<tr>
		<th> # </th>
		<th>USUARIO</th>
		<th>VERSION</th>
		<th>FECHA</th>
		<th>COMENTARIO</th>
	</tr>
<?php
$enumerador =1;
foreach ($versiones as $ver) 
{	
?>
	<tr>
		<td align="center"><?php echo $enumerador ?></td>
		<td><?php echo $ver->ID_USUARIO ?></td>
		<td><?php echo $ver->VER_NUMERO ?></td>
		<td><?php echo $ver->VER_FECHA ?></td>
		<td><?php echo $ver->VER_COMENTARIO ?></td>
	</tr>
<?php
	$enumerador++;
}
?>
</table>