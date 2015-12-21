<h1>Subir Nuevo Documento</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<a href="<?php echo base_url()?>portafolio/obtener_portafolio/<?php echo $id_port ?>">Volver</a>

<?php echo form_open_multipart('documento/do_upload');?>
<h4>Los archivos debe ser de formato: .gif, .jpg, .png, .doc, .docx, .pdf, .txt</4><br><br>
<input type="file" name="userfile" size="20" required/><br />
<input name="nombreDocumento" placeholder="Nombra tu documento..." required/><br />
<input size="50" name="descripcionDocumento" placeholder="Comentarios del Documento" required/><br />
<input type="hidden" name="id_port" value="<?php echo $id_port?>"/>
<br />
<br />

<input type="submit" value="Subir Archivo" />
</form>
