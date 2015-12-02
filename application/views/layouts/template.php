<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>
    <?php echo $this->layout->getTitle(); ?>
  </title>
  <link href="<?php echo base_url()?>../public/css/template.css" rel='stylesheet' type='text/css' media='all' />
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
      <li><a href="<?php echo base_url()?>usuarios">USUARIOS</a></li>
      <li><a href="<?php echo base_url()?>portafolio">PORTAFOLIO</a></li>
      <li><a href="<?php echo base_url()?>usuarios/autenticar_usuario">INICIAR SESIÓN</a></li>
    </ul>
  </div>

  <div id="content">
    <?php echo $content_for_layout; ?>
  </div>
</body>

</html>
