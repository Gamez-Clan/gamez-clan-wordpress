<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	group
#	Author		:	Simple:Press
#
#	The 'group' template is used to display the Group/Forum Index Listing
#
# --------------------------------------------------------------------------------------

	# Load the forum header template - normally first thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		# Start the 'groupView' section
		# ----------------------------------------------------------------------
		sp_SectionStart('tagClass=spListSection', 'groupView');

			# Start the Group Loop
			# ----------------------------------------------------------------------
			if (sp_has_groups()) : while (sp_loop_groups()) : sp_the_group();

				# Start the 'groupHeader' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spGroupViewSection', 'group');
					sp_GroupHeaderRSSButton('tagClass=spButton spRight', __sp('Group RSS'), __sp('Subscribe to the RSS feed for this forum group'));
					sp_GroupHeaderIcon('tagClass=spHeaderIcon spLeft');
					sp_GroupHeaderName('tagClass=spHeaderName');
					sp_InsertBreak('direction=right');
					sp_GroupOpenClose('tagClass=spIcon spRight&default=open', 'Open forum listing', 'Close forum listing');
                    if (function_exists('sp_ShareThisTag')) sp_ShareThisTag('tagClass=ShareThisTag spRight');
					sp_GroupHeaderDescription('tagClass=spHeaderDescription');
					sp_GroupHeaderMessage('tagClass=spHeaderMessage');

					sp_InsertBreak();

					sp_SectionStart('tagClass=spGroupForumContainer', 'forumlist');

						# Start the Forum Loop
						# ----------------------------------------------------------------------
						if (sp_has_forums()) : while (sp_loop_forums()) : sp_the_forum();

							# Start the 'forum' section
							# ----------------------------------------------------------------------
							sp_SectionStart('tagClass=spGroupForumSection', 'forum');

								# Column 1 of the forum row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spLeft&width=6%&height=55px');
									sp_ForumIndexIcon('tagClass=spRowIcon spLeft');
								sp_ColumnEnd();

								# Column 2 of the forum row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spLeft&width=48%&height=55px');
									sp_ForumIndexName('tagClass=spRowName', __sp('Browse topics in %NAME%'));
									sp_ForumIndexDescription('tagClass=spRowDescription');
									sp_ForumIndexPageLinks('tagClass=spInRowPageLinks spLeft', __sp('Jump to page %PAGE% of topics'));
								sp_ColumnEnd();

								# Column 4 of the forum row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=32%&height=55px');
									sp_ForumIndexLastPost('tagClass=spInRowPostLink&nicedate=1&date=0&time=0&stackdate=0', __sp('Last Post'), __sp('No Topics'));
								sp_ColumnEnd();

								# Column 3 of the forum row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=14%&height=55px');
									sp_ForumIndexTopicCount('tagClass=spInRowCount', __sp('Topics'), __sp('Topic'));
									sp_ForumIndexPostCount('tagClass=spInRowCount', __sp('Posts'), __sp('Post'));
									sp_ForumIndexStatusIcons('tagClass=spStatusIcon spCenter', __sp('This forum is locked'), __sp('This forum has unread posts in %COUNT% topic(s)'), __sp('Add new topic in this forum'), __sp('No permission to start topics'));
								sp_ColumnEnd();

								sp_InsertBreak();

								sp_ForumIndexSubForums('unreadIcon=sp_SubForumUnreadIcon.png', __sp('Sub-Forums'), __sp('Browse topics in %NAME%'));
							sp_SectionEnd('', 'forum');

						endwhile; else:
							sp_NoForumsInGroupMessage('tagClass=spMessage', __sp('There are no forums in this group'));
						endif;

					sp_SectionEnd('', 'forumlist');

				sp_SectionEnd('', 'group');

			endwhile; else:
				sp_NoGroupMessage('tagClass=spMessage', __sp('The requested group does not exist or you do not have permission to view it'), __sp('No groups have been created yet'));
			endif;

		sp_SectionEnd('', 'groupView');

		sp_RecentPostList('show=10', __sp('Unread and recently updated topics'));

	sp_SectionEnd('', 'body');

	# Load the forum footer template - normally last thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');

?>