<div class="tab-pane active" id="tab_1_3">
	<form action="<?php echo user_url(true)."profile/change_password" ?>" class="validate_form" method="post">
		<div class="form-group form-md-line-input form-md-floating-label">
			<div class="input-group left-addon">
				<span class="input-group-addon">
					<i class="fa fa-lock"></i>
				</span>
				<input type="password" id="curr_pass" name="old" class="preview-password form-control" tabindex="1" data-rule-required="true" /> 
				<label for="curr_pass">Current Password</label>
			</div>
		</div>
		<div class="form-group form-md-line-input form-md-floating-label">
			<div class="input-group left-addon">
				<span class="input-group-addon">
					<i class="fa fa-key"></i>
				</span>			
				<input type="password" id="new_pass" name="new" class="preview-password form-control" tabindex="2" data-rule-required="true" /> 
				<label for="new_pass">New Password</label>
			</div>
		</div>
		<div class="form-group form-md-line-input form-md-floating-label">
			<div class="input-group left-addon">
				<span class="input-group-addon">
					<i class="fa fa-key"></i>
				</span>
				<input type="password" id="cfm_pass" name="new_confirm" class="preview-password form-control" tabindex="3" data-rule-required="true" data-rule-equalto="#new_pass" /> 
				<label for="cfm_pass">Re-type New Password</label>
			</div>
		</div>
		<div class="margin-top-10">
			<button type="submit" name="submit_change_password" tabindex="4" class="btn green" value="">Change Password</button>
			
		</div>
	</form>
</div>