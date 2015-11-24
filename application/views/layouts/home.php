<!DOCTYPE html>

<html lang="en">

<head>

  <title><?php echo $title;?></title>

  <?php 

  /*  -- Copy from here -- */

  if(!empty($meta))
    foreach($meta as $name=>$content){
      echo "\n\t";
      ?>
      <meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
    }
    if(!empty($canonical))
    {
      echo "\n\t";
      ?>
      <link rel="canonical" href="<?php echo $canonical?>" />
      <?php 
    }
    if($this->load->get_section('section_css') != '') 
      echo $this->load->get_section('section_css');

    ?>

<!--[if lt IE 9]>

<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

</head>

<body class="no-hidden <?php print $this->body_class;?>  notransition loading">





  <div class="loading-spinner">

    <div class="spinner">

      <span class="fa fa-spin fa-spinner fa-3x "></span>

    </div>

  </div>

  <div id="hero-container">

    Header

  </div>

  <?php echo $output;
  ?>
</body>
</html>