<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	Default
#	Template	:	profile show
#	Author		:	Simple:Press
#
#	The 'profile-show' template is used to display a user profile
#
# --------------------------------------------------------------------------------------

	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		sp_SectionStart('tagClass=spProfileShowSection', 'profileShow');
			# output header displaying profile display name
			sp_SectionStart('tagClass=spProfileShowHeaderSection', 'profileHeader');
				sp_ProfileShowHeader('', __sp('Viewing Profile - %USER%'));
			sp_SectionEnd('', 'profileHeader');

			# output section for basic user info
			sp_SectionStart('tagClass=spProfileShowBasicSection', 'profileBasic');
				# show avatar and rank
				sp_ColumnStart('tagClass=spProfileShowAvatarSection spLeft&width=25%', 'profileAvatarRank');
					sp_SectionStart('tagClass=spPlainSection spCenter', '');
						sp_UserAvatar('context=user&link=', $spProfileUser);
						sp_UserForumRank($args='', $spProfileUser->rank);
						sp_UserSpecialRank($args='', $spProfileUser->special_rank);
					sp_SectionEnd();
				sp_ColumnEnd('', 'profileAvatarRank');

				# show profile info
				sp_ColumnStart('tagClass=spProfileShowInfoSection spRight&width=65%', 'profileInfo');
					sp_ProfileShowDisplayName('', __sp('Username'));
					sp_ProfileShowFirstName('', __sp('First Name'));
					sp_ProfileShowLastName('', __sp('Last Name'));
					sp_ProfileShowLocation('', __sp('Location'));
					sp_ProfileShowWebsite('', __sp('Website'));
					sp_ProfileShowBio('', __sp('Bio'));
				sp_ColumnEnd('', 'profileInfo');
			sp_SectionEnd('tagClass=spClear', 'profileBasic');

			# output section for detailed user info
			sp_SectionStart('tagClass=spProfileShowDetailsSection', 'profileDetails');
				# show user identities
				sp_ColumnStart('tagClass=spProfileShowIdentitiesSection spLeft&width=45%', 'profileIdentities');
					echo '<p>'.__sp('Contact').' '.$spProfileUser->display_name.'<br /><hr>';
					sp_ProfileShowAIM('', __sp('AOL IM ID'));
					sp_ProfileShowYIM('', __sp('Yahoo IM ID'));
					sp_ProfileShowMSN('', __sp('MSN ID'));
					sp_ProfileShowICQ('', __sp('ICQ ID'));
					sp_ProfileShowGoogleTalk('', __sp('Google Talk ID'));
					sp_ProfileShowSkype('', __sp('Skype ID'));
					sp_ProfileShowMySpace('', __sp('MySpace ID'));
					sp_ProfileShowFacebook('', __sp('Facebook ID'));
					sp_ProfileShowTwitter('', __sp('Twitter ID'));
					sp_ProfileShowLinkedIn('', __sp('LinkedIn ID'));
					sp_ProfileShowYouTube('', __sp('YouTube ID'));
					sp_ProfileShowEmail('', __sp('Email'));
					if (function_exists('sp_ProfileSendPm')) sp_ProfileSendPm('', __sp('Private Message'), __sp('Send PM'));
				sp_ColumnEnd('', 'profileIdentities');

				# show user stats
				sp_ColumnStart('tagClass=spProfileShowStatsSection spRight&width=45%', 'profileStats');
					echo '<p>'.$spProfileUser->display_name.' '.__sp('Statistics').'<br /><hr>';
					sp_ProfileShowMemberSince('', __sp('Member Since'));
					sp_ProfileShowLastVisit('', __sp('Last Visited'));
					sp_ProfileShowUserPosts('', __sp('Posts'));
					sp_ProfileShowSearchPosts('', __sp('Search User Posts'), __sp('Topics Started'), __sp('Topics Posted In'));
				sp_ColumnEnd('', 'profileStats');
			sp_SectionEnd('tagClass=spClear', 'profileDetails');

			# output user photos
			sp_SectionStart('tagClass=spProfileShowPhotosSection', 'profilePhotos');
				echo '<p>'.$spProfileUser->display_name.' '.__sp('Profile Photos').'<br /><hr>';
				sp_ProfileShowUserPhotos('photoClass=spCenter&imageClass=spImg&numCols=3');
			sp_SectionEnd('', 'profilePhotos');

			# output signature
			sp_SectionStart('tagClass=spProfileShowSignatureSection', 'profileSignature');
				echo '<p>'.$spProfileUser->display_name.' '.__sp('Signature').'<br /><hr>';
				sp_Signature('tagClass=spSignature', $spProfileUser->signature);
			sp_SectionEnd('', 'profileSignature');
		sp_SectionEnd('tagClass=spClear', 'profileShow');

	sp_SectionEnd('', 'body');

	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');
?>