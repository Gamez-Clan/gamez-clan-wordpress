<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	css-only
#	Template	:	members
#	Author		:	Simple:Press
#
#	The 'members' template is used to display the Members Listing
#
# --------------------------------------------------------------------------------------

	# == IN-LINE LOGIN FORM - OBJECT DEFINITION ====================
	$memberSearchForm = array(
		'labelFormTitle'	=> __sp('Search members by name'),
		'labelSearch'		=> __sp('Search string: '),
		'labelSearchSubmit'	=> __sp('Search Members'),
		'labelSearchAll'	=> __sp('All Members'),
		'labelWildcard'		=> __sp('Wildcard usage:'),
		'labelWildcardAny'	=> __sp('%  matches any number of characters'),
		'labelWildcardChar'	=> __sp('_  matches exactly one character'),
	);

	# Load the forum header template - normally first thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		# Start the 'memberList' section
		# ----------------------------------------------------------------------
		sp_SectionStart('tagClass=spListSection', 'memberList');
			sp_MemberListSearchForm($memberSearchForm);

			if (sp_has_member_groups('usergroup', 'id', 'asc', 15, true)) {
				# Start the 'pagelinks' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
                    if (function_exists('sp_MemberListUsergroupSelect')) sp_MemberListUsergroupSelect('tagClass=spUsergroupSelect spRight');
					sp_MemberListPageLinks('', __sp('Page: '), __sp('Jump to page %PAGE% of members list'));
				sp_SectionEnd('', 'pageLinks');

				# Start the Usergroup Loop
				# ----------------------------------------------------------------------
				while (sp_loop_member_groups()) {
					sp_the_member_group();

					# Start the 'memberGroup' section
					# ----------------------------------------------------------------------
					sp_SectionStart('tagClass=spMemberGroupsSection', 'memberGroup');
						sp_MembersUsergroupIcon('tagClass=spHeaderIcon spLeft');
						sp_MembersUsergroupName();
						sp_MembersUsergroupDescription();

						# Start the Member Loop
						# ----------------------------------------------------------------------
						if (sp_has_members()) : while (sp_loop_members()) : sp_the_member();
							# Start the 'member' section
							# ----------------------------------------------------------------------
							sp_SectionStart('tagClass=spMemberListSection', 'member');
								# Column 1 of the member row - member avatar
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spCenter spLeft&width=15%');
									sp_UserAvatar('tagClass=spImg spCenter&context=user', $spThisMember->user_id);
									sp_MembersListName('tagClass=spRowName');
								sp_ColumnEnd();

								# Column 7 of the member row - member action icons
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=15%');
									sp_MemberListActions('', __sp('Member Actions'), __sp('View topics member has started'), __sp('View topics member has posted in'));
								sp_ColumnEnd();

								# Column 6 of the member row - url
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=26%');
									sp_MemberListUrl('', __sp('Member URL'));
								sp_ColumnEnd();

								# Column 5 of the member row - member last visit
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=11%');
									sp_MemberListLastVisit('', __sp('Last Visit'));
								sp_ColumnEnd();

								# Column 4 of the member row - member registered
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=11%');
									sp_MemberListRegistered('', __sp('Registered'));
								sp_ColumnEnd();

								# Column 3 of the member row - member post count
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=8%');
									sp_MemberListPostCount('', __sp('Posts'));
								sp_ColumnEnd();

								# Column 2 of the member row - member rank and badge
								# ----------------------------------------------------------------------
								sp_ColumnStart('tagClass=spColumnSection spRight&width=14%');
									sp_MemberListRank('', __sp('Forum Ranks'));
								sp_ColumnEnd();

							sp_SectionEnd('tagClass=spClear', 'member');
						endwhile; else:
						endif;
					sp_SectionEnd('tagClass=spClear', 'memberGroup');
				}

				# Start the 'pageLinks' section
				# ----------------------------------------------------------------------
				sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
					sp_MemberListPageLinks('', __sp('Page: '), __sp('Jump to page %PAGE% of members list'));
				sp_SectionEnd();
			} else {
				sp_NoMembersListMessage('tagClass=spMessage', __sp('Access denied - you do not have permission to view this page'), __sp('There were no member lists found'));
			}
		sp_SectionEnd('', 'memberList');

	sp_SectionEnd('', 'body');

	# Load the forum footer template - normally last thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');
?>