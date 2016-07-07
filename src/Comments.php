<?php
namespace comments {

	add_filter('comment_form_defaults', ['comment_form_defaults']);

	function comment_form_defaults($defaults) {
		$defaults['fields']['author'] = '
			<div class="form-group">
				<label class="col-md-12 control-label required" for="author">' . __('Name', THEME) . '</label>
				<div class="col-md-12">
					<input id="author" name="author" type="text" value="" required="required" class="form-control"/></p>
				</div>
			</div>
			';

		$defaults['fields']['email'] = '
			<div class="form-group">
				<label class="col-md-12 control-label required" for="email">' . __('E-mail', THEME) . '</label>
				<div class="col-md-12">
					<input id="email" name="email" type="text" value="" required="required" class="form-control"/></p>
				</div>
			</div>
			';

		unset($defaults['fields']['url']);
		unset($defaults['comment_notes_before']);
		//unset($defaults['logged_in_as']);
		unset($defaults['comment_notes_after']);

		$defaults['comment_field'] = '
			<div class="form-group">
				<label class="col-md-12 control-label required" for="email">' . __('Comment', THEME) . '</label>
				<div class="col-md-12">
					<textarea id="comment" name="comment" required="required" class="form-control"></textarea>
				</div>
			</div>
			';

		$defaults['cancel_reply_link'] = '✕';
		return $defaults;
	}

}