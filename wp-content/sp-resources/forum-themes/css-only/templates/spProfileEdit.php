<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	css-only
#	Template	:	profile edit
#	Author		:	Simple:Press
#
#	The 'profile-edit' template is used to display user profile form
#
# --------------------------------------------------------------------------------------

	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		sp_SectionStart('tagClass=spPlainSection', 'profileEdit');
			sp_SectionStart('tagClass=spPlainSection');
				sp_ProfileEdit();
			sp_SectionEnd();
		sp_SectionEnd('', 'profileEdit');

	sp_SectionEnd('', 'body');

	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');
?>