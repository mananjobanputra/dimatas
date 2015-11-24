<h3 class="page-title"><?php echo  $this->page_name?></h3>
<div class="page-bar">
 <ul class="page-breadcrumb">
  <li>
   <i class="icon-home"></i>
   <a href="index.html">Home</a>
   <i class="fa fa-angle-right"></i>
</li>
<li>
   <span>Form Stuff</span>
</li>
</ul>
</div>
<!-- END PAGE HEADER-->
<div class="portlet light portlet-fit ">
 <div class="portlet-title">
  <div class="caption">
   <i class="icon-settings font-dark"></i>
   <span class="caption-subject font-dark sbold uppercase">Editable Form</span>
</div>
      <!-- <div class="actions">
         <div class="btn-group btn-group-devided" data-toggle="buttons">
            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
         </div>
     </div> -->
 </div>
 <div class="portlet-body">
  <div class="row">
   <div class="col-md-12">
    <table id="user" class="table table-bordered table-striped">
     <tbody>
        <?php 
        extract($this->setting_data);
        /* echo $facebook;*/
     if(!empty($this->array_fields)){
            foreach($this->array_fields as $fields){
                $var1=$fields[0];
                $var2=$fields[1];
                ?>
                <tr>
                    <td><?php print ucwords($fields[0]);?> <span class="tooltips" data-container="body" data-placement="right" data-original-title="Select <?php print ucwords($fields[0]);?> Panel Visibility and Give link of <?php print ucwords($fields[0]);?>"><i class=" icon-question-sign"></i></span></td>
                    <td><a href="#" id="<?php print $fields[0];?>" data-type="select" data-pk="1" data-value="<?php print $$var1;?>" data-original-title="Select Status" class="operation"></a></td>
                    <td><a href="#" id="<?php print $fields[1];?>" <?php print ($fields[0]!="phone" && $fields[0]!='email')?'class="link_text"':"";?> data-type="text" data-pk="1" data-placement="right" data-original-title="Enter <?php print ucwords($fields[0]);?> detail" data-value="<?php print $$var2;?>"></a></td>
                </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>
</div>

</div>
</div>