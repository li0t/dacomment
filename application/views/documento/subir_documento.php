<h1>Subir Nuevo Documento</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<a href="<?php echo base_url()?>portafolio/obtener_portafolio/<?php echo $id ?>">Volver</a>

<?php echo form_open_multipart('documento/do_upload', 'nombreDocumento="nombreDocumento"');?>

<input type="file" name="userfile" size="20" required/><br />
<input name="nombreDocumento" placeholder="Nombra tu documento..." required/><br />
<input size="50" name="descripcionDocumento" placeholder="Comentarios del Documento" required/><br />


<br />
<br />

<input type="submit" value="Subir Archivo" />
</form>
