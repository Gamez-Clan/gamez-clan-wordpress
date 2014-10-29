<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	list (simplified topic listing)
#	Author		:	Simple:Press
#
#	The 'list' template is used to display a simplified Topic Listing
#
# --------------------------------------------------------------------------------------

	# Start the 'listView' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spListSection spListViewSection', 'listView');
		sp_ListViewHead();

		# Start the List Loop
		# ----------------------------------------------------------------------
		if (sp_has_list()) : while (sp_loop_list()) : sp_the_list();
			# Start the 'list' section
			# ----------------------------------------------------------------------
			sp_SectionStart('tagClass=spTopicListSection spTextLeft', 'list');
				sp_ListForumName('', __sp('Browse topics in %NAME%'));
				sp_InsertBreak();

				sp_ListViewBodyStart();

					sp_ColumnStart('tagClass=spColumnSection spRight&width=15%&height=20px');
						sp_ListNewPostButton('tagClass=spButton spRight', __sp('New: %COUNT%'), __sp('View the first new post in this topic'));
					sp_ColumnEnd();
					sp_ColumnStart('tagClass=spColumnSection spLeft&width=7%&height=20px');
						sp_ListTopicIcon();
					sp_ColumnEnd();

					sp_ColumnStart('tagClass=spColumnSection spLeft&width=74%&height=20px');
						sp_ListTopicName('', __sp('Browse the thread %NAME%'));
						sp_ListLastPost('iconClass=spIcon spLeft&height=0px', __sp('Last Post'));
					sp_ColumnEnd();

				sp_ListViewBodyEnd();

				sp_InsertBreak();
			sp_SectionEnd('', 'list');
		endwhile; else:
			sp_NoTopicsInListMessage('tagClass=spMessage', __sp('There were no topics found'));
		endif;

		sp_ListViewFoot();
	sp_SectionEnd('', 'listView');
?>