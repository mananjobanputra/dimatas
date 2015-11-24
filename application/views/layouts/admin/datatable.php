 <h3 class="page-title"><?php echo  $this->page_name?>
 	
 </h3>
 <div class="page-bar">
 	<ul class="page-breadcrumb">
 		<li>
 			<i class="icon-home"></i>
 			<a href="index.html">Home</a>
 			<i class="fa fa-angle-right"></i>
 		</li>
 		<li>
 			<span><a href="<?php echo $this->page_url?>"><?php echo $this->page_name; ?></a></span>
 		</li>
 		
 	</ul>
 </div>
 <div class="row">
 	<div class="col-md-12">
 		<!-- BEGIN EXAMPLE TABLE PORTLET-->
 		<div class="portlet light ">
 			<div class="portlet-title">
 				<div class="caption font-dark">
 					<i class="icon-settings font-dark"></i>
 					<span class="caption-subject bold uppercase"> 			<?php echo $this->page_name; ?>
 					</span>
 				</div>
 				<div class="actions">
 					<div class="btn-group btn-group-devided" data-toggle="buttons">
 						<label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
 							<input type="radio" name="options" class="toggle" id="option1">Actions
 						</label>
 						<label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
 							<input type="radio" name="options" class="toggle" id="option2">Settings
 						</label>
 					</div>
 				</div>
 			</div>
 			<div class="portlet-body">
 				<div class="table-container">
 					<div class="table-actions-wrapper">
 						<span> </span>
 						<?php if(isset($add_button)){ ?>	
 						<div class="btn-group">
 							<a href="<?php echo $add_button_href; ?>" id="sample_editable_1_new" class="btn sbold green"> Add New
 								<i class="fa fa-plus"></i>
 							</a>
 						</div>
 						<?php } ?>	
 					</div>
 				<table class="table table-striped table-bordered table-hover table-checkable" <?php if(isset($datatable_url)){ ?> data-datatableurl="<?php echo $datatable_url; ?>" <?php } ?> id="<?php echo $tbl_id;?>">
 					<thead>
 						<tr role="row">
 							<?php $i=0;foreach ($columns as $key => $value) {
 								if($i == -1){
 									?>
 									<th>#</th>
 									<?php	
 								}else{
 									?>
 									<th><?php echo strtoupper(lang($value)); ?></th>
 									<?php
 								}							
 								$i++;} ?>
 							</tr>
 							<tr class="filter_thead">
 								<?php foreach ($columns as $key => $value) {
 									?>
 									<th><div id="filter_<?php print $value;?>"></div></th>
 									<?php } ?>
 								</tr>

 							</thead>
 							<tbody>

 							</tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 			<!-- END EXAMPLE TABLE PORTLET-->
 		</div>
 	</div>