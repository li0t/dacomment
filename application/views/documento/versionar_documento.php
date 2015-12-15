<h1>Subir Nueva Versión Documento</h1>

<?php
	if ($this->session->flashdata('ControllerMessage')!='') {
?>
	<p style="color:red;"><?php echo $this->session->flashdata('ControllerMessage'); ?></p>
<?php
	}
?>

<a href="<?php echo base_url()?>documento/historia_documento/<?php echo $id_doc ?>/<?php echo $id_port ?>">volver</a>

<?php echo form_open_multipart('documento/do_upload');?>

<input type="file" name="userfile" size="20" required/><br />
<input name="nombreDocumento" value="<?php echo $doc->DOC_NOMBRE ?>" readonly/><br />
<input size="50" name="descripcionDocumento" placeholder="Comenta los cambios en la versión" required/><br />

<input type="hidden" name="id_port" value="<?php echo $id_port ?>"/>
<input type="hidden" name="id_doc" value="<?php echo $doc->DOC_ID ?>"/>
<br />
<br />

<input type="submit" value="Subir Archivo" />
</form>
