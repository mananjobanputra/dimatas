<?php 
$notification = NULL;
if($this->message_text != ""){ 
   if($this->message_type == "alert")
    { ?>
<div class="alert alert-<?php echo  $this->message_class; ?> alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <?php /*?><strong><?php echo $this->message_title; ?></strong> <?php */?>
    <?php echo  $this->message_text; ?> 
</div>
<?php 
} 
else 
{
    $notification = $this->message_text;  
}
} ?>
