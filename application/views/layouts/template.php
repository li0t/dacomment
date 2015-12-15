<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>
    <?php echo $this->layout->getTitle(); ?>
  </title>
  <link href="<?php echo base_url()?>../public/css/template.css" rel='stylesheet' type='text/css' media='all' />
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
  <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
  <!--*************auxiliares*****************-->

  <?php echo $this->layout->css; ?>

    <?php echo $this->layout->js; ?>

      <!--**********fin auxiliares*****************-->
</head>

<body>
  <div id="navbar">
    <ul>
      <li><a href="<?php echo base_url()?>">DACOMMENT</a></li>
      <?php
      	if ($this->session->userdata('usuario')) {
      ?>
      <li><a href="<?php echo base_url()?>portafolio">PORTAFOLIOS</a></li>
      <li><a href="<?php echo base_url()?>usuarios/cerrar_sesion">CERRAR SESIÓN</a></li>
      <?php
      } else  {
      ?>
      <li><a href="<?php echo base_url()?>usuarios/autenticar_usuario">INICIAR SESIÓN</a></li>
      <?php
      	}
      ?>
    </ul>
  </div>

  <div id="content">
    <?php echo $content_for_layout; ?>
  </div>
</body>

</html>
