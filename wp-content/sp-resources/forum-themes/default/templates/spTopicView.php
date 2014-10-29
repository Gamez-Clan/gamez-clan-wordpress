<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	topic
#	Author		:	Simple:Press
#
#	The 'topic' template is used to display the Topic/Post Index Listing
#
# --------------------------------------------------------------------------------------


	# == ADD POST FORM - OBJECT DEFINITION ========================
	$addPostForm = array(
		'tagClass'				=> 'spForm',
		'hide'					=> 1,
		'controlFieldset'		=> 'spEditorFieldset',
		'controlInput'			=> 'spControl',
		'controlSubmit'			=> 'spSubmit',
		'controlOrder'			=> 'cancel|save',
		'labelHeading'			=> __sp('Add Reply'),
		'labelGuestName'		=> __sp('Guest name (required)'),
		'labelGuestEmail'		=> __sp('Guest email (required)'),
		'labelModerateAll'		=> __sp('NOTE: new posts are subject to administrator approval before being displayed'),
		'labelModerateOnce'		=> __sp('NOTE: first posts are subject to administrator approval before being displayed'),
		'labelSmileys'			=> __sp('Smileys'),
		'labelOptions'			=> __sp('Options'),
		'labelOptionLock'		=> __sp('Lock this topic'),
		'labelOptionPin'		=> __sp('Pin this post'),
		'labelOptionTime'		=> __sp('Edit post timestamp'),
		'labelMath'				=> __sp('Math Required'),
		'labelMathSum'			=> __sp('What is the sum of'),
		'labelPostButtonReady'	=> __sp('Submit Reply'),
		'labelPostButtonMath'	=> __sp('Do Math To Save'),
		'labelPostCancel'		=> __sp('Cancel'),
		'tipSmileysButton'		=> __sp('Open/Close to Add a Smiley'),
		'tipOptionsButton'		=> __sp('Open/Close to select Posting Options'),
		'tipSubmitButton'		=> __sp('Save the New Post'),
		'tipCancelButton'		=> __sp('Cancel the New Post')
	);

	# == EDIT POST FORM - OBJECT DEFINITION ========================
	$editPostForm = array(
		'tagClass'				=> 'spForm',
		'controlFieldset'		=> 'spEditorFieldset',
		'controlInput'			=> 'spControl',
		'controlSubmit'			=> 'spSubmit',
		'controlOrder'			=> 'cancel|save',
		'labelHeading'			=> __sp('Edit Post'),
		'labelSmileys'			=> __sp('Smileys'),
		'labelPostButton'		=> __sp('Save Edited Post'),
		'labelPostCancel'		=> __sp('Cancel'),
		'tipSmileysButton'		=> __sp('Open/Close to Add a Smiley'),
		'tipSubmitButton'		=> __sp('Save the Edited Post'),
		'tipCancelButton'		=> __sp('Cancel the Post Edits')
	);
	# ==============================================================


	# Load the forum header template - normally first thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		# Start the 'topicView' section
		# ----------------------------------------------------------------------
		sp_SectionStart('tagClass=spListSection', 'topicView');

			# Set the Topic
			# ----------------------------------------------------------------------
			if (sp_this_topic()):
				# Start the 'pagelinks' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
					sp_PostNewButton('tagId=spPostNewButtonTop&tagClass=spButton spRight', __sp('Add Reply'), __sp('Add a new post in this topic'), __sp('This topic is locked'), __sp('No permission to create posts'));
					sp_PostNewTopicButton('tagId=spPostNewTopicButtonTop&tagClass=spButton spRight', __sp('Add Topic'), __sp('Start a new topic'), __sp('This forum is locked'));
					sp_PostIndexPageLinks('', __sp('Page: '), __sp('Jump to page %PAGE% of this topic'), __sp('Jump to page'));
				sp_SectionEnd('tagClass=spClear', 'pageLinks');

				# Start the 'topicHeader' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spTopicViewSection', 'topic');
					sp_TopicHeaderRSSButton('tagClass=spButton spRight', __sp('Topic RSS'), __sp('Subscribe to the RSS feed for this topic'));
					if (function_exists('sp_RelatedTopicsButton')) sp_RelatedTopicsButton('tagClass=spButton spRight', __sp('Related Topics'), __sp('Get a list of related topics based on tags for this topic'));
					sp_TopicHeaderIcon('tagClass=spHeaderIcon spLeft');
					sp_TopicHeaderName('tagClass=spHeaderName');
					if (function_exists('sp_TopicHeaderShowBlogLink')) sp_TopicHeaderShowBlogLink('', __sp('Read the original blog post'), __sp('Click to goto original blog post'));
					sp_InsertBreak();
                    if (function_exists('sp_ShareThisTopicTag')) sp_ShareThisTopicTag('tagClass=ShareThisTopic spRight');
					sp_InsertBreak();

					if (function_exists('sp_TopicIndexRating') || function_exists('sp_TopicTagsList') || function_exists('sp_TopicStatus')) {
                        if (function_exists('sp_TopicIndexRating')) sp_TopicIndexRating('tagClass=spTopicRating spRight', __sp('Topic Rating:'));
						if (function_exists('sp_TopicTagsList')) sp_TopicTagsList('tagClass=spTopicTagsList spLeft', __sp('Tags: '));
						if (function_exists('sp_TopicStatus')) sp_TopicStatus('tagClass=spTopicViewStatus spButton spLeft', __sp('Search for other topics with this status'), __sp('Status: '));
						sp_InsertBreak();
					}

					sp_SectionStart('tagClass=spTopicPostContainer', 'postlist');

						# Start the Post Loop
						# ----------------------------------------------------------------------
						if (sp_has_posts()) : while (sp_loop_posts()) : sp_the_post();

							# Start the 'post' section
							# ----------------------------------------------------------------------
							sp_SectionStart('tagClass=spTopicPostSection', 'post');

								sp_PostIndexAnchor();

								sp_PostForumToolButton('', '', __sp('Open the forum toolset'));

								# Column 1 of the post row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spUserSection spLeft&width=15%&height=50px');
									sp_PostIndexUserDate('tagClass=spPostUserDate spCenter');
									sp_UserAvatar('tagClass=spPostUserAvatar spCenter&context=user', $spThisPostUser);
									sp_PostIndexUserName('tagClass=spPostUserName spCenter');
									sp_PostIndexUserLocation('tagClass=spPostUserLocation spCenter');
									sp_PostIndexUserRank('tagClass=spPostUserRank spCenter');
									sp_PostIndexUserSpecialRank('tagClass=spPostUserSpecialRank spCenter');
									sp_PostIndexUserPosts('tagClass=spPostUserPosts spCenter', __sp('Forum Posts: %COUNT%'));
									if (function_exists('sp_PostIndexCubePoints')) sp_PostIndexCubePoints('tagClass=spPostUserCubePoints spCenter', __sp('CubePoints'));
									if (function_exists('sp_PostIndexMyCred')) sp_PostIndexMyCred('tagClass=spPostUserMyCred spCenter', __sp('MyCred '), __sp('MyCred'));
									sp_PostIndexUserRegistered('tagClass=spPostUserRegistered spCenter', __sp('Member Since:<br /> %DATE%'));
									sp_PostIndexUserStatus('tagClass=spCenter spPostUserStatus', __sp('Online'), __sp('Offline'));
									sp_SectionStart('tagClass=spCenter', 'user-identities');
										sp_PostIndexUserWebsite('', __sp('Visit my website'));
										sp_PostIndexUserTwitter('', __sp('Follow me on Twitter'));
										sp_PostIndexUserFacebook('', __sp('Connect with me on Facebook'));
										sp_PostIndexUserMySpace('', __sp('See MySpace'));
										sp_PostIndexUserLinkedIn('', __sp('My LinkedIn network'));
										sp_PostIndexUserYouTube('', __sp('View my YouTube channel'));
										sp_PostIndexUserGooglePlus('', __sp('Interact with me on Google Plus'));
									sp_SectionEnd('', 'user-identities');
								sp_ColumnEnd();

								# Column 2 of the post row
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spPostSection spRight&width=84%');

									# Start the 'post' section
									# ----------------------------------------------------------------------
									sp_SectionStart('tagClass=spPostActionSection', 'action');
										sp_GoToTop('tagClass=spRight spGoToTop&iconClass=spIcon', '', __sp('Go to Top'));
										sp_PostIndexPinned('tagClass=spStatusIcon spLeft', __sp('This post is pinned'));
										if (function_exists('sp_PostIndexPostByEmail')) sp_PostIndexPostByEmail('tagClass=spStatusIcon spLeft', 'This post was sent by email');
										sp_PostIndexNumber('tagClass=spLabelBordered spLeft');
										sp_PostIndexEditHistory('tagClass=spButton spLeft', '', __sp('Edited by %USER% on %DATE%'), __sp('View edit history'));
										sp_PostIndexPermalink('tagClass=spButton spLeft', '', __sp('The post permalink'));
										sp_PostIndexPrint('tagClass=spButton spLeft', '', __sp('Print this post'));
										sp_PostIndexNewPost('tagClass=spLabelBordered spLeft', __sp('New'));
										if (function_exists('sp_PostIndexRatePost')) sp_PostIndexRatePost('tagClass=spLabelBordered spPostRating spRight');
										if (function_exists('sp_PostIndexReportPost')) sp_PostIndexReportPost('tagClass=spButton spRight', __sp('Report'), __sp('Report this post to admin'));
										sp_PostIndexQuote('tagClass=spButton spRight', __sp('Quote'), __sp('Quote this post and reply'));
										sp_PostIndexEdit('tagClass=spButton spRight', __sp('Edit'), __sp('Edit this post'));
										sp_PostIndexDelete('tagClass=spButton spRight', __sp('Delete'), __sp('Delete this post'));
										if (function_exists('sp_PostIndexSendPm')) sp_PostIndexSendPm('tagClass=spButton spRight', __sp('PM'), __sp('Send PM to this user'));
                                        if (function_exists('sp_thanks_thank_the_post')) sp_thanks_thank_the_post('tagClass=spButton spRight', __sp('Thank'), __sp('Thanked'), __sp('Add thanks to this post'), __sp('You have already thanked this post'));
									sp_SectionEnd('', 'action');
									sp_InsertBreak();

									sp_SectionStart('tagClass=spPostContentSection', 'content');
										sp_PostIndexContent('', __sp('Awaiting Moderation'));
									sp_SectionEnd('', 'content');
									sp_InsertBreak();

                                    # Add Share This and/or Answers Topic to bottom of post content
                                    # ----------------------------------------------------------------------
                                    if (function_exists('sp_ShareThisTopicIndexTag') || function_exists('sp_AnswersTopicAnswer') || function_exists('sp_thanks_thanks_for_post')){
                                        sp_ColumnStart('tagClass=spPluginSection spCenter&width=100%&height=40px');
                                        if (function_exists('sp_ShareThisTopicIndexTag')) sp_ShareThisTopicIndexTag('tagClass=ShareThisTopicIndex spLeft');
                                        if (function_exists('sp_AnswersTopicAnswer')) {
                                            if ($spThisPost->post_index == 1) sp_AnswersTopicSeeAnswer('tagClass=spAnswersTopicSeeAnswer spButton spRight', __sp('See Answer'), __sp('Go to the post marked as the answer'));
                                            sp_AnswersTopicAnswer('tagClass=spRight', __sp('Answers Post'), __sp('This post answers the topic'));
                                            sp_AnswersTopicPostIndexAnswer('tagClass=spButton spRight', __sp('Mark as Answer'), __sp('Mark this post as topic answer'), __sp('Unmark as Answer'), __sp('Unmark this post as topic answer'));
                                        }
                                        sp_ColumnEnd();
                                        if (function_exists('sp_thanks_thanks_for_post')) {
                                            sp_InsertBreak();
                                            sp_thanks_thanks_for_post();
                                        }
                                        sp_InsertBreak();
                                    }
                                    # End Share This and/or Answers Topic addition
                                    # ----------------------------------------------------------------------

									sp_PostIndexUserSignature('tagClass=spPostUserSignature spCenter&maxHeightBottom=55');
									sp_InsertBreak();
								sp_ColumnEnd();

								sp_InsertBreak();

							sp_SectionEnd('', 'post');

						endwhile; else:
							sp_NoPostsInTopicMessage('tagClass=spMessage', __sp('There are no posts in this topic'));
						endif;

					sp_SectionEnd('', 'postlist');

				sp_SectionEnd('', 'topic');

				# Start the 'pagelinks' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
					sp_PostNewButton('tagId=spPostNewButtonBottom&tagClass=spButton spRight', __sp('Add Reply'), __sp('Make a new post in this topic'), __sp('This topic is locked'), __sp('No permission to create posts'));
					sp_PostNewTopicButton('tagId=spPostNewTopicButtonBottom&tagClass=spButton spRight', __sp('Add Topic'), __sp('Start a new topic'), __sp('This forum is locked'));
					sp_PostIndexPageLinks('', __sp('Page: '), __sp('Jump to page %PAGE% of this topic'), __sp('Jump to page'));
					sp_InsertBreak();
				sp_SectionEnd('', 'pageLinks');

				# Start the 'editor' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spHiddenSection', 'editor');
					sp_PostEditorWindow($addPostForm, $editPostForm);
				sp_SectionEnd('', 'editor');
			else:
				sp_NoTopicMessage('tagClass=spMessage', __sp('Access denied - you do not have permission to view this page'), __sp('The requested topic does not exist'));
			endif;

		sp_SectionEnd('', 'topicView');

	sp_SectionEnd('', 'body');

	# Load the forum footer template - normally last thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');
?>