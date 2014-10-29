<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	forum
#	Author		:	Simple:Press
#
#	The 'forum' template is used to display the Forum/Topic Index Listing
#
# --------------------------------------------------------------------------------------

	# == ADD TOPIC FORM - OBJECT DEFINITION ========================
	$addTopicForm = array(
		'tagClass'				=> 'spForm',
		'hide'					=> 1,
		'controlFieldset'		=> 'spEditorFieldset',
		'controlInput'			=> 'spControl',
		'controlSubmit'			=> 'spSubmit',
		'controlOrder'			=> 'cancel|save',
		'labelHeading'			=> __sp('Add Topic'),
		'labelGuestName'		=> __sp('Guest name (Required)'),
		'labelGuestEmail'		=> __sp('Guest email (Required)'),
		'labelModerateAll'		=> __sp('NOTE: new posts are subject to administrator approval before being displayed'),
		'labelModerateOnce'		=> __sp('NOTE: first posts are subject to administrator approval before being displayed'),
		'labelTopicName'		=> __sp('Topic name'),
		'labelSmileys'			=> __sp('Smileys'),
		'labelOptions'			=> __sp('Options'),
		'labelOptionLock'		=> __sp('Lock this topic'),
		'labelOptionPin'		=> __sp('Pin this topic'),
		'labelOptionTime'		=> __sp('Edit topic timestamp'),
		'labelMath'				=> __sp('Math Required'),
		'labelMathSum'			=> __sp('What is the sum of'),
		'labelPostButtonReady'	=> __sp('Submit Topic'),
		'labelPostButtonMath'	=> __sp('Do Math To Save'),
		'labelPostCancel'		=> __sp('Cancel'),
		'tipSmileysButton'		=> __sp('Open/Close to Add a Smiley'),
		'tipOptionsButton'		=> __sp('Open/Close to select Posting Options'),
		'tipSubmitButton'		=> __sp('Save the New Topic'),
		'tipCancelButton'		=> __sp('Cancel the New Topic')
	);
	# ==============================================================


	# Load the forum header template - normally first thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		# Start the 'groupView' section
		# ----------------------------------------------------------------------
		sp_SectionStart('tagClass=spListSection', 'forumView');

			# Set the Forum
			# ----------------------------------------------------------------------
			if (sp_this_forum()):

				# Are there sub forums to display
				if (sp_has_subforums()) :

					# Start the 'SubForumHeader' section
					# ----------------------------------------------------------------------
					sp_SectionStart('tagClass=spForumViewSection', 'subforum');
						sp_ForumHeaderIcon('tagId=spSubForumHeaderIcon&tagClass=spHeaderIcon spLeft');
						sp_ForumHeaderName('tagId=spSubForumHeaderName&tagClass=spHeaderName');
						sp_SubForumHeaderDescription('', __sp('Sub Forums'));

						sp_InsertBreak();

						sp_SectionStart('tagClass=spForumSubforumContainer', 'subforumlist');

							while (sp_loop_subforums()) : sp_the_subforum() ; if(sp_is_child_subforum()) :

								# Start the 'subforum' section - note the special subform call above
								# ----------------------------------------------------------------------
								sp_SectionStart('tagClass=spGroupForumSection', 'subForum');

									# Column 1 of the forum row
									# ----------------------------------------------------------------------
									sp_ColumnStart('tagClass=spColumnSection spLeft&width=6%&height=55px');
										sp_SubForumIndexIcon('tagClass=spRowIcon spLeft');
									sp_ColumnEnd();

									# Column 2 of the forum row
									# ----------------------------------------------------------------------
									sp_ColumnStart('tagClass=spColumnSection spLeft&width=48%&height=55px');
										sp_SubForumIndexName('tagClass=spRowName', __sp('Browse topics in %NAME%'));
										sp_SubForumIndexDescription('tagClass=spRowDescription');
										sp_SubForumIndexPageLinks('tagClass=spInRowPageLinks spLeft', __sp('Jump to page %PAGE% of topics'));
									sp_ColumnEnd();

									# Column 4 of the forum row
									# ----------------------------------------------------------------------
									sp_ColumnStart('tagClass=spColumnSection spRight&width=32%&height=55px');
										sp_SubForumIndexLastPost('tagClass=spInRowPostLink', __sp('Last Post'));
									sp_ColumnEnd();

									# Column 3 of the forum row
									# ----------------------------------------------------------------------
									sp_ColumnStart('tagClass=spColumnSection spRight&width=14%&height=55px');
										sp_SubForumIndexTopicCount('tagClass=spInRowCount', __sp('Topics'));
										sp_SubForumIndexPostCount('tagClass=spInRowCount', __sp('Posts'));
										sp_SubForumIndexStatusIcons('tagClass=spStatusIcon spCenter', __sp('This forum is locked'), __sp('This forum has unread posts in %COUNT% topic(s)'), __sp('Add new topic in this forum'));
									sp_ColumnEnd();

									sp_InsertBreak();

									sp_ForumHeaderSubForums('unreadIcon=sp_SubForumUnreadIcon.png', __sp('Sub-Forums'), __sp('Browse topics in %NAME%'));

								sp_SectionEnd('', 'subForum');

							endif ; endwhile;

						sp_SectionEnd('', 'subforumlist');

					sp_SectionEnd('', 'forum');

				endif;
				# End of subforum section

				# Start the 'pagelinks' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagId=spTopicNewButtonTop&tagClass=spPlainSection', 'pageLinks');
					sp_TopicNewButton('tagClass=spButton spRight', __sp('Add Topic'), __sp('Start a new topic'), __sp('This forum is locked'), __sp('No permission to start topics'));
					sp_TopicIndexPageLinks('', __sp('Page: '), __sp('Jump to page %PAGE% of topics'), __sp('Jump to page'));
				sp_SectionEnd('tagClass=spClear', 'pageLinks');

				# Start the 'forumHeader' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spForumViewSection', 'forum');
					sp_ForumHeaderRSSButton('tagClass=spButton spRight', __sp('Forum RSS'), __sp('Subscribe to the RSS feed for this forum'));
					sp_ForumHeaderIcon('tagClass=spHeaderIcon spLeft');
					sp_ForumHeaderName('tagClass=spHeaderName');
					sp_ForumHeaderDescription('tagClass=spHeaderDescription');
					sp_ForumHeaderSubForums('', __sp('Sub-Forums'), __sp('Browse topics in %NAME%'));
                    if (function_exists('sp_ShareThisForumTag')) sp_ShareThisForumTag('tagClass=spRight ShareThisForum');

					sp_InsertBreak();

					sp_ForumHeaderMessage('tagClass=spHeaderMessage');

					sp_SectionStart('tagClass=spForumTopicContainer', 'topiclist');

						# Start the Topic Loop
						# ----------------------------------------------------------------------
						if (sp_has_topics()) : while (sp_loop_topics()) : sp_the_topic();

							# Start the 'topic' section
							# ----------------------------------------------------------------------
							sp_SectionStart('tagClass=spForumTopicSection', 'topic');

								sp_TopicForumToolButton('', '', __sp('Open the forum toolset'));

								# Column 1 of the topic row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spLeft&width=6%&height=50px');
									sp_TopicIndexIcon('tagClass=spRowIcon spLeft');
								sp_ColumnEnd();

								# Column 2 of the topic row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spLeft&width=48%&height=50px');
									sp_TopicIndexName('tagClass=spRowName', __sp('Browse the thread %NAME%'));
                                    if (function_exists('sp_TopicDescription')) sp_TopicDescription();
									sp_TopicIndexPostPageLinks('tagClass=spInRowPageLinks spLeft', __sp('Jump to page %PAGE% of posts'));
									if (function_exists('sp_TopicIndexTagsList')) sp_TopicIndexTagsList('tagClass=spTopicTagsList spButton spLeft', __sp('Tags'), __sp('Show the tags for this topic'));
									if (function_exists('sp_TopicIndexTopicStatus')) sp_TopicIndexTopicStatus('tagClass=spTopicIndexStatus spButton spLeft', __sp('Search for other topics with this status'));
								sp_ColumnEnd();

								# Column 5 of the forum row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=16%&height=50px');
									sp_TopicIndexLastPost('iconClass=spIcon spRight&nicedate=1&date=0&time=0&stackdate=0', __sp('Last Post'));
								sp_ColumnEnd();

								# Column 4 of the forum row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=16%&height=50px');
									sp_TopicIndexFirstPost('iconClass=spIcon spRight&nicedate=1&date=0&time=0&stackdate=0', __sp('First Post'));
								sp_ColumnEnd();

								# Column 3 of the forum row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=14%&height=50px');
									sp_TopicIndexPostCount('tagClass=spInRowCount', __sp('Posts'), __sp('Post'));
									sp_TopicIndexViewCount('tagClass=spInRowCount', __sp('Views'), __sp('View'));
									sp_TopicIndexStatusIcons('tagClass=spStatusIcon spCenter', __sp('This topic is locked'), __sp('This topic is pinned'), __sp('This topic has unread posts'), __sp('No permission to create posts'));
									if (function_exists('sp_TopicIndexRating')) sp_TopicIndexRating('tagClass=spTopicRating spCenter');
								sp_ColumnEnd();

								sp_InsertBreak();

							sp_SectionEnd('', 'topic');

						endwhile; else:
							sp_NoTopicsInForumMessage('tagClass=spMessage', __sp('There are no topics in this forum'));
						endif;

					sp_SectionEnd('', 'topiclist');

				sp_SectionEnd('', 'forum');

				# Start the 'pagelinks' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
					sp_TopicNewButton('tagId=spTopicNewButtonBottom&tagClass=spButton spRight', __sp('Add Topic'), __sp('Start a new topic'), __sp('This forum is locked'), __sp('No permission to start topics'));
					sp_TopicIndexPageLinks('', __sp('Page: '), __sp('Jump to page %PAGE% of topics'), __sp('Jump to page'));
					sp_InsertBreak();
				sp_SectionEnd('', 'pageLinks');

				# Start the 'editor' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spHiddenSection', 'editor');
					sp_TopicEditorWindow($addTopicForm);
				sp_SectionEnd('', 'editor');
			else:
				sp_NoForumMessage('tagClass=spMessage', __sp('Access denied - you do not have permission to view this page'), __sp('The requested forum does not exist'));
			endif;

		sp_SectionEnd('', 'forumView');

	sp_SectionEnd('', 'body');

	# Load the forum footer template - normally last thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');
?>