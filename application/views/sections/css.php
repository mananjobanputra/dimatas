<?php /*print_r($css);*/
foreach ($css as $css => $file) {
    if($file['external']==true)
    {
        echo "\n\t";
        echo '<link rel="stylesheet" href="'.$file['file'].'" type="text/css" />';
    }
    else{
        $this->minify->add_css($file['file']);
    }
}
echo "\n\t";
echo $this->minify->deploy_css();

?>