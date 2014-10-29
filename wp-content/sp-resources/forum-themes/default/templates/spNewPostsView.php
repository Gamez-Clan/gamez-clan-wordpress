<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	New Posts View
#	Author		:	Simple:Press
#
#	The 'new posts view' template is used to display a list of unread posts
#
# --------------------------------------------------------------------------------------

	# Load the forum header template - normally first thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');
        sp_SectionStart('tagId=spRecentPostList&tagClass=spRecentPostSection');
    		echo '<div class="spMessage">'.__sp('Most recent topics with unread posts').'</div>';

    		# Start the 'searchView' section
    		# ----------------------------------------------------------------------
    		global $spThisUser, $spListView, $spThisListTopic;
            $first = sp_esc_int($_GET['first']);
            $group = sp_esc_int($_GET['group']);
            $count = sp_esc_int($_GET['count']);
    		$spListView = new spTopicList($spThisUser->newposts['topics'], $count, $group, '', $first);
    		sp_load_template('spListView.php');

    	sp_SectionEnd();
	sp_SectionEnd('', 'body');

	# Load the forum footer template - normally last thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');
?>