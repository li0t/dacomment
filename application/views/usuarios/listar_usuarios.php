<ul>
<?php 	foreach($usuarios as $usu){ ?>
	    <li>
	      Nombre: 
		<?php echo $usu->USU_NOMBRES ?> <br>
	      Apellidos: 
		<?php echo $usu->USU_APELLIDO_PATERNO ?> <br>
	      Rut: 
		<?php echo $usu->USU_RUT ?>
	    </li>
<?php
	}
?>
</ul>