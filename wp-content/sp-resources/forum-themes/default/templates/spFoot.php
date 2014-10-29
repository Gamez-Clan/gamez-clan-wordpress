<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	foot
#	Author		:	Simple:Press
#
#	The 'foot' template can be used for all forum content that is to be
#	displayed at the bottom of every forum view page
#
# --------------------------------------------------------------------------------------

	# Mandatory call to sp_FooterBegin() - available to custom code
	# ----------------------------------------------------------------------
	sp_FooterBegin();

	# Start the 'pageBottomStatus' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spPlainSection', 'pageBottomStatus');
		sp_AllRSSButton('tagClass=spButton spLeft spAllRSSButton', __sp('All RSS'), __sp('Subscribe to the all forums RSS feed'));
		if (function_exists('sp_SubscriptionsSubscribeButton')) sp_SubscriptionsSubscribeButton('tagClass=spButton spLeft', __sp('Subscribe'), __sp('Unsubscribe'), __sp('Subscribe to this topic'), __sp('Unsubscribe from this topic'));
		if (function_exists('sp_WatchesWatchButton')) sp_WatchesWatchButton('tagClass=spButton spLeft', __sp('Watch'), __sp('Stop Watching'), __sp('Watch this topic'), __sp('Stop watching this topic'));
		sp_GoToTop('tagClass=spRight spGoToTop&iconClass=spIcon', '', __sp('Go to top'));
	sp_SectionEnd('tagClass=spClear', 'pageBottomStatus');

	# Start the 'stats' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spStatsSection', 'stats');
		sp_ForumTimeZone('tagClass=spForumTimeZone', __sp('Forum Timezone: '));
		sp_UserTimeZone('tagClass=spUserTimeZone', __sp('Your Timezone: '));

		sp_InsertBreak();

		sp_ColumnStart('tagClass=spColumnSection spLeft spOnlineStats&width=40%&height=0');
			sp_OnlineStats('tagClass=spLeft', __sp('Most Users Ever Online: '), __sp('Currently Online: '), __sp('Currently Browsing this Page: '), __sp('Guest(s)'));
			if (function_exists('sp_OnlinePageLink')) sp_OnlinePageLink('', __sp('See All Online Activity'));
			if (function_exists('sp_ListBirthdays')) sp_ListBirthdays('tagClass=spCustomTag&spLeft', __sp('Members Birthdays'), __sp('Today'), __sp('Upcoming'));
		sp_ColumnEnd();

		sp_ColumnStart('tagClass=spColumnSection spRight spTopPosterStats&width=15%&height=0');
			sp_TopPostersStats('tagClass=spRight', __sp('Top Posters: '));
		sp_ColumnEnd();

		sp_ColumnStart('tagClass=spColumnSection spRight spMembershipStats&width=20%&height=0');
			sp_MembershipStats('tagClass=spRight', __sp('Member Stats: '), __sp('Members: %COUNT%'), __sp('Guest Posters: %COUNT%'), __sp('Moderators: %COUNT%'), __sp('Admins: %COUNT%'));
		sp_ColumnEnd();

		sp_ColumnStart('tagClass=spColumnSection spRight spForumStats&width=17%&height=0');
			sp_ForumStats('tagClass=spRight', __sp('Forum Stats: '), __sp('Groups: '), __sp('Forums: '), __sp('Topics: '), __sp('Posts: '));
		sp_ColumnEnd();

		sp_InsertBreak();

		sp_NewMembers('tagClass=spLeft spNewMembers', __sp('Newest Members: '));

		sp_InsertBreak();

		sp_ModsList('tagClass=spLeft spModerators', __sp('Moderators: '));

		sp_InsertBreak();

		sp_AdminsList('tagClass=spLeft spAdministrators', __sp('Administrators: '));
	sp_SectionEnd('tagClass=spClear', 'stats');

    if (function_exists('sp_UserSelectOptions')) sp_UserSelectOptions('tagClass=spCenter spLabelSmall', __sp('Theme:'), __sp('Language:'));

	sp_InsertBreak();

	# Start the 'about' section
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spPlainSection spCenter', 'about');
		if (function_exists('sp_PolicyDocPolicyLink')) sp_PolicyDocPolicyLink('', __sp('Usage Policy'), __sp('View site usage policy'));
		sp_Acknowledgements('', '', __sp('About Simple:Press'), __sp('Visit Simple:Press'));
		if (function_exists('sp_PolicyDocPrivacyLink')) sp_PolicyDocPrivacyLink('', __sp('Privacy Policy'), __sp('View site privacy policy'));
	sp_SectionEnd('', 'about');

	# Mandatory call to sp_FooterEnd() - available to custom code
	# ----------------------------------------------------------------------
	sp_FooterEnd();
?>