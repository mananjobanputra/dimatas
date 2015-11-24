<?php 
echo "\n";

echo $inline_stripped_scripting;
foreach ($js as $js => $file) {
  if($file['external']==true){
    echo "\n\t";
    echo '<script src="'.$file['file'].'"></script>';
  }
  else{
    $this->minify->add_js($file['file']);
  }
}
echo "\n\t";
echo $this->minify->deploy_js();
echo "\n";
?>
<script type="text/javascript">
  $(function(){
    <?php echo $inline_unstripped_scripting;?>
  })
</script>