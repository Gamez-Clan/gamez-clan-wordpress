<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	head
#	Author		:	Simple:Press
#
#	The 'head' template can be used for all forum content that is to be
#	displayed at the top of every forum view page
#
# --------------------------------------------------------------------------------------

	# == IN-LINE LOGIN FORM - OBJECT DEFINITION ====================
	$loginForm = array(
		'tagClass'			=> 'spForm',
		'controlFieldset'	=> 'spControl',
		'controlInput'		=> 'spControl',
		'controlSubmit'		=> 'spSubmit',
		'controlIcon'		=> 'spIcon',
		'controlLink'		=> 'spLink',
		'iconName'			=> 'sp_LogInOut.png',
		'labelUserName'		=> __sp('Login name'),
		'labelPassword'		=> __sp('Password'),
		'labelRemember'		=> __sp('Remember me'),
		'labelRegister'		=> __sp('Register'),
		'labelLostPass'		=> __sp('Lost password?'),
		'labelSubmit'		=> __sp('Log In'),
		'showRegister'		=> 1,
		'showLostPass'		=> 1
	);
	# ==============================================================

	# == Search FORM - OBJECT DEFINITION ====================
	$searchForm = array(
		'tagClass'			    => 'spLeft spSearchForm',
		'icon'	                => 'sp_Search.png',
		'inputClass'		    => 'spControl',
		'inputWidth'			=> 20,
		'submitClass'		    => 'spButton spRight',
		'advSearchLinkClass'	=> 'spLink',
		'advSearchLink'			=> '',
		'advSearchId'	    	=> 'spSearchFormAdvanced',
		'advSearchClass'		=> 'spSearchFormAdvanced',
        'submitLabel'           => __sp('Search'),
        'advancedLabel'         => __sp('Advanced Search'),
        'lastSearchLabel'		=> __sp('Last Search Results'),
        'toolTip'               => __sp('Search the forums'),
        'labelLegend'           => __sp('Advanced Search'),
        'labelScope'            => __sp('Forum Scope'),
        'labelCurrent'          => __sp('Current forum'),
        'labelAll'              => __sp('All forums'),
		'labelMatch'			=> __sp('Match'),
        'labelMatchAny'         => __sp('Match any word'),
        'labelMatchAll'         => __sp('Match all words'),
        'labelMatchPhrase'      => __sp('Match phrase'),
        'labelOptions'          => __sp('Forum Options'),
        'labelPostTitles'       => __sp('Posts and topic titles'),
        'labelPostsOnly'        => __sp('Posts only'),
        'labelTitlesOnly'       => __sp('Topic titles only'),
        'labelMinLength'        => __sp('Minimum search word length is %1$s characters - maximum search word length is %2$s characters'),
        'labelMemberSearch'     => __sp('Member Search (Current or All Forums)'),
        'labelTopicsPosted'     => __sp('List Topics You Have Posted To'),
        'labelTopicsStarted'    => __sp('List Topics You Started'),
		'searchIncludeDef'		=> 1,  # 1 = content, 2 = titles, 3 = content and title (warning #3 is a resource hog)
		'searchScope' 	   	    => 1,  # 1 = Current Forum, 2 = All Forums
	);
	# ==============================================================

	# Start Template

	# Mandatory call to sp_HeaderBegin() - available to custom code
	# ----------------------------------------------------------------------
	sp_InsertBreak();
	sp_HeaderBegin();

	# Output the admin queue and links if the admin bar plugin is activated
	if (function_exists('sp_AdminQueue')) {
		sp_SectionStart('tagClass=spPlainSection', 'adminBar');
			sp_AdminLinks('tagClass=spRight spButton', __sp('Admin Links'), __sp('Select an admin page'));
   			sp_AdminQueue('tagClass=spLeft&buttonClass=spLeft spButton&countClass=spLeft spButtonAsLabel', __sp('View New Posts'), __sp('Unread: '), __sp('Need Moderation: '), __sp('Spam: '), __sp('Open/Close the Admin Postbag'));
		sp_SectionEnd('tagClass=spClear', 'adminBar');
	}

	# Start the 'userInfo' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spPlainSection', 'userInfo');
		sp_UserAvatar('tagClass=spImg spLeft');

		sp_SectionStart('tagClass=spPlainSection');
			sp_LoggedInOutLabel('tagClass=spLabelSmall spLeft', __sp('Logged in as<br /><b>%USERNAME%</b>'), __sp('Please consider registering<br /><b>guest</b>'), __sp('Welcome back <b>%USERNAME%</b><br />Please log in to post'));
			sp_LogInOutButton('tagClass=spButton spRight', __sp('Log In'), __sp('Log Out'), __sp('Log in and log out'));
			sp_RegisterButton('tagClass=spButton spRight', __sp('Register'), __sp('Register'));
			sp_ProfileEditButton('tagClass=spButton spRight', __sp('Profile'), __sp('Edit your profile'));
			if (function_exists('sp_PmInboxButton')) sp_PmInboxButton('tagClass=spButton spRight', __sp('Inbox:'), __sp('Go to PM inbox'));
			if (function_exists('sp_SubscriptionsReviewButton')) sp_SubscriptionsReviewButton('tagClass=spButton spRight', __sp('Subscribed:'), __sp('Review subscribed topics'));
			if (function_exists('sp_WatchesReviewButton')) sp_WatchesReviewButton('tagClass=spButton spRight', __sp('Watching:'), __sp('Review watched topics'));
			sp_MemberButton('tagClass=spButton spRight', __sp('Members'), __sp('View the members list'));

			sp_InsertBreak('direction=right');

			sp_LastVisitLabel('tagClass=spLabelSmall spRight', __sp('Last visited %LASTVISIT%'));

		sp_SectionEnd('tagClass=spClear');

		sp_LoginForm($loginForm);
		sp_UserNotices('', __sp('(Remove Notice)'));

	sp_SectionEnd('', 'userInfo');

	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spPlainSection', 'search');
		sp_QuickLinksForum('tagClass=spControl spSelect spRight', __sp('Select Forum'));
		sp_QuickLinksTopic('tagClass=spControl spSelect spRight', __sp('New/Recently Updated Topics'));
		sp_SearchForm($searchForm);
	sp_SectionEnd('', 'search');

	sp_InsertBreak();

	# Start the 'breadCrumbs' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spPlainSection spLeft', 'breadCrumbs');
		sp_BreadCrumbs('tagClass=spLeft spBreadCrumbs&tree=1', __sp('Home'));
	sp_SectionEnd('', 'breadCrumbs');

	# Start the 'pageTopStatus' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spPlainSection spRight', 'pageTopStatus');
		sp_GoToBottom('tagClass=spGoToBottom spRight&iconClass=spIcon', '', __sp('Go to Bottom'));
		sp_UnreadPostsInfo('tagClass=spRight spUnreadPostsInfo&spanClass=spLeft&iconClass=spLeft spIcon', __sp('%COUNT% topics with<br />unread posts'), __sp('Most recent topics with unread posts'), __sp('Mark all topics as read'));
        if (function_exists('sp_RankInfo')) sp_RankInfo('tagClass=spButton spRight', '', __sp('Display Forum Ranks Information'));
	sp_SectionEnd('', 'pageTopStatus');

	sp_InsertBreak();

	sp_SectionStart('tagClass=spPlainSection');
		sp_ForumLockdown('tagClass=spMessage', __sp('The forums are currently locked and only available for read only access'));
	sp_SectionEnd();

	sp_InsertBreak();

	# Mandatory call to sp_HeaderEnd() - available to custom code
	# ----------------------------------------------------------------------
	sp_HeaderEnd();
?>