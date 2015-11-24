	<!-- PERSONAL INFO TAB -->
	<div class="tab-pane active" id="tab_1_1">
		<form role="form" action="<?php echo user_url(true).'profile/edit'; ?>" method="post">
			<div class="form-group form-md-line-input form-md-floating-label">
				<div class="input-group left-addon">
					<span class="input-group-addon">
						<i class="fa fa-user"></i>
					</span>
					<input type="text" name="full_name" id="full_name"  class="form-control <?php echo isset($profile_data["full_name"]) ? "edited" : ""; ?>" value="<?php echo isset($profile_data["full_name"]) ? $profile_data["full_name"] : ""; ?>" data-rule-required="true"/> 
					<label for="full_name">Full Name</label>
				</div>
			</div>
			<div class="form-group form-md-line-input form-md-floating-label readonly">
				<div class="input-group left-addon">
					<span class="input-group-addon">
						<i class="fa fa-envelope-o"></i>
					</span>
					<input type="text" id="email" name="email" class="form-control edited" readonly value="<?php echo isset($profile_data["email"]) ? $profile_data["email"] : ""; ?>" /> 
					<label for="email">Email</label>
				</div>
			</div>
			<div class="form-group form-md-line-input form-md-floating-label">
				<div class="input-group left-addon">
					<span class="input-group-addon">
						<i class="fa fa-location-arrow"></i>
					</span>
					<input class="form-control <?php echo isset($profile_data["full_name"]) ? "edited" : ""; ?>" type="text" id="address" name="address" value="<?php echo isset($profile_data["address"]) ? $profile_data["address"] : ""; ?>">
					<label for="address">Address</label>
				</div>
			</div>
			<div class="form-group form-md-line-input form-md-floating-label">
				<div class="input-group left-addon">
					<span class="input-group-addon">
						<i class="fa fa-map-pin"></i>
					</span>
					<input type="text" id="city" name="city" class="form-control <?php echo isset($profile_data["city"]) ? "edited" : ""; ?>" value="<?php echo isset($profile_data["city"]) ? $profile_data["city"] : ""; ?>" /> 
					<label for="city">City</label>
				</div>
			</div>
			<div class="form-group form-md-line-input form-md-floating-label">
				<div class="input-group left-addon">
					<span class="input-group-addon">
						<i class="fa fa-map-pin"></i>
					</span>
					<input class="form-control" tabindex="6" type="text" id="state" name="state" value="<?php echo isset($profile_data["state"]) ? $profile_data["state"] : ""; ?>"/> 
					<label for="state">State</label>
				</div>
			</div>
			<div class="form-group form-md-line-input form-md-floating-label">
				<div class="input-group left-addon">
					<span class="input-group-addon">
						<i class="fa fa-globe"></i>
					</span>
					<select name="country" id="country" class="form-control edited">
						<option></option>	
						<?php if(!empty($country)){
							foreach ($country as $key => $value) {
								?>
								<option <?php if($profile_data["country"] == $value["id"]){ ?> selected="selected" <?php } ?> value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
								<?php				
							} 
						}?>
					</select>
					<label for="country">Country</label>
				</div>
			</div>
			<div class="margiv-top-10">
				<!-- <a href="javascript:;" class="btn green"> Save Changes </a> -->
				<button type="submit" class="btn green" value="" id="" name="">Save Changes</button>
			</div>
		</form>
	</div>
	<!-- END PERSONAL INFO TAB -->
