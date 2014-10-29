<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	default
#	Author		:	Simple:Press
#
#	The 'default' template is used to display generic or unknown pages
#
# --------------------------------------------------------------------------------------

	# Load the forum header template - normally first thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		# lets see if we can figure out why we got here and output some useful info
		# ----------------------------------------------------------------------
		sp_SectionStart('tagClass=spMessage');
			if ($spVars['profile'] == 'show') {
				if (!sp_get_auth('view_profiles')) {
					echo __sp('Access denied - you do not have permission to view this page');
				} else {
					echo __sp('The requested member does not exist');
				}
			} else {
				echo __sp('The requested page does not exist');
			}
		sp_SectionEnd();

	sp_SectionEnd('', 'body');

	# Load the forum footer template - normally last thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');
?>