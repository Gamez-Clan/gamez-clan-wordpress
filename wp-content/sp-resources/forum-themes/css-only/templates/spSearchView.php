<?php
# --------------------------------------------------------------------------------------
#
#	Simple:Press Template
#	Theme		:	css-only
#	Template	:	Search
#	Author		:	Simple:Press
#
#	The 'search' template is used to display a simplified Search Listing
#
# --------------------------------------------------------------------------------------


	# Load the forum header template - normally first thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spHeadContainer', 'head');
		sp_load_template('spHead.php');
	sp_SectionEnd('', 'head');

	sp_SectionStart('tagClass=spBodyContainer', 'body');

		# Start the 'searchView' section
		# ----------------------------------------------------------------------
		sp_SectionStart('tagClass=spListSection', 'searchView');

			sp_Search();

			sp_SearchHeaderName('', __sp('Search results for %TERM%'), __sp('Topics posted to by %NAME%'), __sp('Topics started by %NAME%'));

			sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
    			sp_SearchPageLinks('', 'Page: ', 'Jump to page %PAGE% of results');
			sp_SectionEnd('tagClass=spClear', 'pageLinks');

			sp_SearchResults();

			sp_SectionStart('tagClass=spPlainSection', 'pageLinks');
    			sp_SearchPageLinks('', 'Page: ', 'Jump to page %PAGE% of results');
			sp_SectionEnd('tagClass=spClear', 'pageLinks');
		sp_SectionEnd('', 'searchView');

	sp_SectionEnd('', 'body');

	# Load the forum footer template - normally last thing
	# ----------------------------------------------------------------------
	sp_SectionStart('tagClass=spFootContainer', 'foot');
		sp_load_template('spFoot.php');
	sp_SectionEnd('', 'foot');

?>