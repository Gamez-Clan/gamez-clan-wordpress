<?php
header("Content-Type: text/css; charset: utf-8");
header("Expires: ".gmdate('D, d M Y H:i:s', (time()+900)) . " GMT");

# --------------------------------------------------------------------------------------
#
#	Simple:Press Template CSS
#	Theme		:	Default
#	Author		:	Simple:Press
#
#	This is the main CSS file for the SP Default theme.
#	This file requires a Color Overlay file to be included
#
#   ***********************************************************************************
#   WARNING: It is highly recommended that you do NOT edit this theme's files.  Since
#   it's one of the default themes supplied with Simple:Press, if you later update the
#   theme any changes you have made will be lost.  You should instead make a copy of the
#   theme to create your own theme and then make your edits and customizations there.
#   ***********************************************************************************
#
# --------------------------------------------------------------------------------------

# if available, load the selected color overlay stylesheet
if (!empty($_GET['color'])) include('overlays/'.$_GET['color'].'.php');

# load the reset css file
if (isset($_GET['rtl'])) {
	include('reset-rtl.css');
} else {
	include('reset.css');
}

?>

/* ----------------------
Some base, useful classes
-------------------------*/

#spMainContainer .spClear {
	clear: both;
}

#spMainContainer .spClearRight {
	clear: right;
}

#spMainContainer .spClearLeft {
	clear: left;
}

#spMainContainer .spLeft {
	float: left;
}

#spMainContainer .spRight {
	float: right;
}

#spMainContainer .spTextRight {
	text-align: right;
}

#spMainContainer .spTextLeft {
	text-align: left;
}

#spMainContainer .spCenter {
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}

#spMainContainer small {
    font-size: <?php echo($spMainContainerSmall); ?>;
	padding: 0;
}

/* ---------------
Main Section classes
------------------*/

#spMainContainer {
	color: <?php echo($mainBackGroundColor); ?>;
	background: <?php echo($mainBackGround); ?>;
	border: <?php echo($mainBackGroundBorder); ?>;
	font-family: <?php echo($mainFontFamily); ?>;
    font-size: <?php echo($mainFontSize); ?>;
	line-height: <?php echo($mainLineHeight); ?>;
	<?php echo($smallRadius); ?>
    padding: 1px;
}

#spMainContainer .spHiddenSection,
#spMainContainer .spInlineSection {
	color: <?php echo($plainSectionColor); ?>;
	background: <?php echo($plainSectionBackGround); ?>;
	border: <?php echo($plainSectionBorder); ?>;
	padding: 0;
	width: auto;
}

#spMainContainer .spInlineSection {
	display: none;
}

#spMainContainer .spPlainSection {
	color: <?php echo($plainSectionColor); ?>;
	background: <?php echo($plainSectionBackGround); ?>;
	border: <?php echo($plainSectionBorder); ?>;
	padding: 5px;
	width: auto;
}

#spMainContainer .spColumnSection {
	margin: 0;
	padding: 5px 0;
}

#spMainContainer .spListSection {
	color: <?php echo($listSectionColor); ?>;
	background: <?php echo($listSectionBackGround); ?>;
	border: <?php echo($listSectionBorder); ?>;
	padding: 5px 0;
	width: 100%;
}

#spMainContainer .spGroupViewSection,
#spMainContainer .spForumViewSection,
#spMainContainer .spTopicViewSection,
#spMainContainer .spTopicListSection,
#spMainContainer .spMemberGroupsSection {
	color: <?php echo($itemHeaderColor); ?>;
	background: <?php echo($itemHeaderBackGround); ?>;
	border: <?php echo($itemHeaderBorder); ?>;
	padding: 5px 0 1px 0;
	margin: 0 5px 20px 5px;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spGroupForumSection,
#spMainContainer .spForumTopicSection,
#spMainContainer .spTopicListSection,
#spMainContainer .spRecentPostSection .spTopicListSection,
#spMainContainer .spSearchSection .spTopicListSection,
#spMainContainer .spMemberListSection {
	color: <?php echo($itemListColor); ?>;
	background: <?php echo($itemListBackGround); ?>;
	border: <?php echo($itemListBorder); ?>;
	padding: 0;
	margin: 2px;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spGroupForumSection:hover,
#spMainContainer .spForumTopicSection:hover,
#spMainContainer .spTopicListSection:hover,
#spMainContainer .spMemberListSection:hover {
	color: <?php echo($itemListColorHover); ?>;
	background: <?php echo($itemListBackGroundHover); ?>;
	border: <?php echo($itemListBorderHover); ?>;
}

#spMainContainer .spGroupForumSection.spOdd,
#spMainContainer .spForumTopicSection.spOdd,
#spMainContainer .spTopicListSection.spOdd,
#spMainContainer .spMemberListSection.spOdd {
	color: <?php echo($itemListColorOdd); ?>;
	background: <?php echo($itemListBackGroundOdd); ?>;
	border: <?php echo($itemListBorderOdd); ?>;
	padding: 0;
	margin: 2px;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spGroupForumSection.spOdd:hover,
#spMainContainer .spForumTopicSection.spOdd:hover,
#spMainContainer .spTopicListSection.spOdd:hover,
#spMainContainer .spMemberListSection.spOdd:hover {
	color: <?php echo($itemListColorOddHover); ?>;
	background: <?php echo($itemListBackGroundOddHover); ?>;
	border: <?php echo($itemListBorderOddHover); ?>;
}

#spMainContainer .spGroupForumSection.spEven,
#spMainContainer .spForumTopicSection.spEven,
#spMainContainer .spTopicListSection.spEven,
#spMainContainer .spMemberListSection.spEven {
	color: <?php echo($itemListColorEven); ?>;
	background: <?php echo($itemListBackGroundEven); ?>;
	border: <?php echo($itemListBorderEven); ?>;
	padding: 0;
	margin: 2px;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spGroupForumSection.spEven:hover,
#spMainContainer .spForumTopicSection.spEven:hover,
#spMainContainer .spTopicListSection.spEven:hover,
#spMainContainer .spMemberListSection.spEven:hover {
	color: <?php echo($itemListColorEvenHover); ?>;
	background: <?php echo($itemListBackGroundEvenHover); ?>;
	border: <?php echo($itemListBorderEvenHover); ?>;
}

#spMainContainer .spTopicListSection.spOdd,
#spMainContainer .spTopicListSection.spEven {
	padding: 4px 15px 0 15px;
}

#spMainContainer .spTopicListSection .spListTopicRowName {
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer .spRecentPostSection .spTopicListSection,
#spMainContainer .spSearchSection .spTopicListSection,
#spMainContainer .spListViewSection .spTopicListSection {
	padding: 3px 9px 0 9px;
	margin: 0 5px;
}

#spMainContainer .spRecentPostSection .spTopicListSection .spListForumRowName,
#spMainContainer .spSearchSection .spTopicListSection .spListForumRowName {
    font-size:  <?php echo($spListForumRowName); ?>;
	padding: 0;
	margin: 0;
}

#spMainContainer .spRecentPostSection .spTopicListSection .spListTopicRowName,
#spMainContainer .spSearchSection .spTopicListSection .spListTopicRowName {
	font-size:  <?php echo($spListTopicRowName); ?>;
	padding: 0 0 3px 0;
}

#spMainContainer .spListViewSection .spTopicListSection .spListTopicRowName {
	padding: 0 0 3px 0;
}

#spMainContainer .spRecentPostSection .spTopicListSection .spIcon,
#spMainContainer .spSearchSection .spTopicListSection .spIcon,
#spMainContainer .spListViewSection .spTopicListSection .spIcon {
	padding: 0 5px 0 0;
}

#spMainContainer .spRecentPostSection .spTopicListSection .spListLabel,
#spMainContainer .spRecentPostSection .spTopicListSection .spListPostLink,
#spMainContainer .spSearchSection .spTopicListSection .spListLabel,
#spMainContainer .spSearchSection .spTopicListSection .spListPostLink {
    font-size: <?php echo($spListPostLink_spListLabel); ?>;
    clear: both;
}

#spMainContainer .spStatsSection {
	background: <?php echo($alt3BackGround); ?>;
	border:	<?php echo($alt3Border); ?>;
	color: <?php echo($alt3Color); ?>;
	padding: 5px;
	margin: 5px;
	width: auto;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spProfileShowSection,
#spMainContainer .spProfileShowHeaderSection {
	color: <?php echo($plainSectionColor); ?>;
	background: <?php echo($plainSectionBackGround); ?>;
	border: <?php echo($plainSectionBorder); ?>;
	padding: 5px;
	width: auto;
}

#spMainContainer .spProfileShowHeaderSection {
	margin: 10px 5px;
}

#spMainContainer .spProfileShowSignatureSection,
#spMainContainer .spProfileShowBasicSection,
#spMainContainer .spProfileShowDetailsSection,
#spMainContainer .spProfileShowPhotosSection,
#spMainContainer .spProfileShowLinkSection {
	background: <?php echo($alt5BackGround); ?>;
	border:	<?php echo($alt5Border); ?>;
	color: <?php echo($alt5Color); ?>;
	padding: 10px;
	margin: 10px 5px 20px;
	width: auto;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spProfileShowPhotosSection table.spProfileShowUserPhotos {
    width: 100%;
}

#spMainContainer .spProfileShowPhotosSection table.spProfileShowUserPhotos td {
    background: inherit;
    padding: 10px 0;
}

#spMainContainer .spProfileShowAvatarSection,
#spMainContainer .spProfileShowInfoSection,
#spMainContainer .spProfileShowIdentitiesSection,
#spMainContainer .spProfileShowStatsSection {
	color: <?php echo($plainSectionColor); ?>;
	background: transparent;
	border: <?php echo($plainSectionBorder); ?>;
	margin: 10px 5px;
	width: auto;
}

/* --------------------------
Post Sections - User and Post
-----------------------------*/

#spMainContainer .spTopicPostSection {
	color: <?php echo($userColor); ?>;
	background: <?php echo($userBackGround); ?>;
	border: <?php echo($userBorder); ?>;
	margin: <?php echo($postMargin); ?>;
	overflow: hidden;
	padding: <?php echo($postPadding); ?>;
	<?php echo($smallRadius); ?>
    position: relative;
}

#spMainContainer .spTopicPostSection.spOdd {
	color: <?php echo($userColorOdd); ?>;
	background: <?php echo($userBackGroundOdd); ?>;
	border: <?php echo($userBorderOdd); ?>;
}

#spMainContainer .spTopicPostSection.spEven {
	color: <?php echo($userColorEven); ?>;
	background: <?php echo($userBackGroundEven); ?>;
	border: <?php echo($userBorderEven); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection {
	padding: 4px 2px 200px 4px;
	margin-bottom: -200px;
	background: <?php echo($postBackGround); ?>;
	<?php echo($postBackRadius); ?>
}

#spMainContainer .spTopicPostSection.spOdd .spPostSection {
	padding: 4px 2px 200px 4px;
	margin-bottom: -200px;
	background: <?php echo($postBackGroundOdd); ?>;
	<?php echo($postBackRadius); ?>
}

#spMainContainer .spTopicPostSection.spEven .spPostSection {
	padding: 4px 2px 200px 4px;
	margin-bottom: -200px;
	background: <?php echo($postBackGroundEven); ?>;
	<?php echo($postBackRadius); ?>
}

#spMainContainer .spTopicPostSection .spPostUserDate,
#spMainContainer .spTopicPostSection .spPostUserName,
#spMainContainer .spTopicPostSection .spPostUserLocation,
#spMainContainer .spTopicPostSection .spPostUserPosts,
#spMainContainer .spTopicPostSection .spPostUserRegistered,
#spMainContainer .spTopicPostSection .spPostUserRank,
#spMainContainer .spTopicPostSection .spPostUserStatus,
#spMainContainer .spTopicPostSection .spPostUserSpecialRank,
#spMainContainer .spTopicPostSection .spPostUserMemberships {
    font-size: <?php echo($UserInfo); ?>;
	margin: 0;
	padding: 5px;
	line-height: 1em;
}

#spMainContainer .spTopicPostSection .spPostUserName {
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer .spTopicPostSection .spPostUserRank img,
#spMainContainer .spTopicPostSection .spPostUserSpecialRank img {
	margin: auto;
}


#spMainContainer .spTopicPostSection .spPostUserAvatar img {
	margin: auto;
}

#spMainContainer .spTopicPostSection .spPostUserSignature {
    font-size: <?php echo($spPostUserSignature); ?>;
	padding: 20px 0;
	margin: 0;
    border-top: <?php echo($postBorder); ?>;
}

#spMainContainer .spTopicPostSection .spPostUserSignature a {
	text-decoration: <?php echo($alt6LinkDecoration); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent {
    border-top: <?php echo($postBorder); ?>;
    color: <?php echo($postColor); ?>;
    margin: 5px 0;
    padding: 10px;
    font-size: <?php echo($PostContentFontSize); ?>;
    line-height: 1.2em;
}

#spMainContainer .spTopicPostSection.spEven .spPostContentSection .spPostUserPosts {
    border-top: <?php echo($postBorderEven); ?>;
    color: <?php echo($postColorEven); ?>;
    margin: 5px 0;
    padding: 10px;
    font-size: <?php echo($spEven_spPostUserPosts); ?>;
}

#spMainContainer .spTopicPostSection.spOdd .spPostContentSection .spPostUserPosts {
    border-top: <?php echo($postBorderOdd); ?>;
    color: <?php echo($postColorOdd); ?>;
    margin: 5px 0;
    padding: 10px;
    font-size: <?php echo($spOdd_spPostUserPosts); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent p {
	padding-bottom: 1em;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h1,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h2,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h3,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h4,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h5,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h6 {
	margin: 0;
	padding: 5px 0px;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
	letter-spacing: 0;
	text-transform: none;
    line-height: 1em;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h1 {
    font-size:  <?php echo($spPostContent_h1); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h2 {
    font-size:  <?php echo($spPostContent_h2); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h3 {
    font-size:  <?php echo($spPostContent_h3); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h4 {
    font-size:  <?php echo($spPostContent_h4); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h5 {
    font-size:  <?php echo($spPostContent_h5); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent h6 {
    font-size:  <?php echo($spPostContent_h6); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent pre {
	margin: 0;
	padding: 5px 0px;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent blockquote {
    overflow: hidden;
	background: <?php echo($alt4BackGround); ?>;
	color: <?php echo($alt4Color); ?>;
	border: <?php echo($alt4Border); ?>;
	margin: 0 0 1em;
	padding: 1em 1em 0 1em;
	<?php echo($smallRadius); ?>
	font-weight: <?php echo($mainFontWeight); ?>;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent cite {
    overflow: hidden;
	background: <?php echo($alt1BackGround); ?>;
	border: <?php echo($alt1Border); ?>;
	color: <?php echo($alt1Color); ?>;
	padding: 2px 5px;
	font-style: italic;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent img {
    overflow: hidden;
	margin: 5px;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimageright {
	float: right;
	margin: 0;
	padding: 5px 0 5px 20px;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimageleft {
	float: left;
	margin: 0;
	padding: 5px 20px 5px 0;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimagecenter {
	display: block;
	margin: 0 auto;
	padding: 5px 20px;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimagebaseline {
	margin: 0;
	padding: 10px
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimagetop {
	vertical-align: top;
	margin: 0;
	padding: 10px
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimagemiddle {
	vertical-align: middle;
	margin: 0;
	padding: 10px
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimagebottom {
	vertical-align: bottom;
	margin: 0;
	padding: 10px
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimagetexttop {
	vertical-align: text-top;
	margin: 0;
	padding: 10px
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfimagetextbottom {
	vertical-align: text-bottom;
	margin: 0;
	padding: 10px
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfmouseright {
	float: right;
	margin-right: -39px;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfmouseleft {
	float: left;
	margin-left: -39px;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .sfmouseother {
	margin: 0 0 0 -34px;
	padding: 20px 0;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent a {
    overflow: hidden;
	text-decoration: <?php echo($alt6LinkDecoration); ?>;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent ul,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent ol {
	padding: 0 0 1em 2em;
	list-style-position: inside;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent ul li,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent ol li {
	padding-bottom: 0.5em;
	word-wrap: break-word;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent hr {
	border: <?php echo($postBorder); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent table {
	width: 100%;
	margin: 1em 0;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent table td {
	padding: 0.5em;
	border: <?php echo($postBorder); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .spSpoiler {
	margin: 10px 0;
	padding: 0;
	border: <?php echo($alt5Border); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .spSpoilerContent {
	padding: 10px 10px 0;
	margin: 0 10px 10px;
	background: <?php echo($alt5BackGround); ?>;
	color: <?php echo($alt5Color); ?>;
	display: none;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent .spSpoiler .spReveal {
	padding: 10px 0;
	text-align: center;
    font-size: <?php echo($spSpoiler); ?>;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent span.sfcode,
#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent div.sfcode {
    overflow: hidden;
	background: <?php echo($alt3BackGround); ?>;
	color: <?php echo($alt3Color); ?>;
	border: <?php echo($alt3Border); ?>;
	font-family: monospace, Courier;
    font-size: <?php echo($divsfcode); ?>;
	<?php echo($smallRadius); ?>
	display: block;
	margin: 2em;
	padding: 0.5em;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent div.sfcode table.syntax {
    width: 99%;
    padding: 0;
    margin: 0;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent div.sfcode table.syntax td {
	padding: 0;
}

#spMainContainer .spTopicPostSection .spPostSection .spPostContentSection .spPostContent input.sfcodeselect {
	margin: 5px !important;
	padding: 2px !important;
	font-size: <?php echo($inputsfcodeselect); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spPostContent iframe {
    max-width:100%;
}

/* --------------------------
Posting form
-----------------------------*/
#spMainContainer #spPostForm {
	padding: 0 0 10px;
	margin: 10px 5px;
	background: <?php echo($postBackGround); ?>;
	color: <?php echo($postColor); ?>;
    font-size: <?php echo($spPostForm); ?>;
	width: auto;
}

#spMainContainer #spPostForm .spEditorFieldset {
	<?php echo($smallRadius); ?>
	margin: 0;
	padding: 10px;
}

#spMainContainer #spPostForm .spEditorSection {
	background: <?php echo($userBackGround); ?>;
	border: <?php echo($postBorder); ?>;
	padding: 7px 10px;
	margin: 10px 0 0;
	<?php echo($smallRadius); ?>
	width: auto;
}

#spMainContainer #spPostForm .spEditorSectionLeft {
	float: left;
	width: 45%;
}

#spMainContainer #spPostForm .spEditorSectionRight {
	float: right;
	width: 45%;
}

#spMainContainer #spPostForm .spEditorHeading {
	border-bottom: <?php echo($postBorder); ?>;
	padding: 0 0 3px;
	margin: 0 0 7px;
	text-align: center;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer #spPostForm .spEditorSection .spEditorMessage {
	background: <?php echo($postBackGround); ?>;
	border: <?php echo($postBorder); ?>;
	<?php echo($smallRadius); ?>
    font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
    margin: 5px 5px 15px;
    padding: 10px;
    text-align: center;
}

#spMainContainer #spPostForm .spEditor .spEditorTitle {
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
    font-size: <?php echo($spEditorTitle); ?>;
	padding: 5px;
}

#spMainContainer #spPostForm .spEditor .spEditorTitle input {
	width: 75%;
	margin: 5px 0;
}

#spMainContainer #spPostForm .spEditor p.spLabelSmall {
	padding: 10px 5px;
	text-align: center;
}

#spMainContainer #spPostForm #spEditorContent {
	clear: both;
	margin: 0 -2px;
	padding: 0 0 0 3px;
}

#spMainContainer #spPostForm #spEditorContent td.mceIframeContainer,
#spMainContainer #spPostForm #spEditorContent td.mceStatusbar {
	border: <?php echo($postBorder); ?>;
}

#spMainContainer #spPostForm .spEditorSmileys {
	padding: 0 10px;
}

#spMainContainer #spPostForm .spEditorSmileys img.spSmiley {
	padding: 3px 1px;
	cursor: pointer;
}

#spMainContainer #spPostForm .spEditorSmileys img.spSmiley:active {
border: 1px solid transparent;
}

#spMainContainer #spPostForm .spEditorSubmit {
	text-align: center;
	padding: 15px 0 5px;
	clear: both;
}

#spMainContainer #spPostForm .spEditorSubmit .spEditorTitle {
	text-align: center;
	padding-top: 0;
}

#spMainContainer #spPostForm .spEditor .spEditorSubmit .spEditorSpam {
	padding: 0 0 5px;
}

#spMainContainer #spPostForm .spEditor .spEditorSubmit .spEditorSpam input {
	text-align: center;
}

#spMainContainer #spPostForm .spEditorSubmit .spEditorSubmitButton {
	padding-top: 5px;
}

#spMainContainer .spEditor .spPtEditor {
	width: 98%;
}

/* --------------------------
General multi-purpose classes
-----------------------------*/

#spMainContainer a:link,
#spMainContainer a:active,
#spMainContainer a:visited,
#spMainContainer .spLink:link,
#spMainContainer .spLink:active,
#spMainContainer .spLink:visited {
    color: <?php echo($linkColor); ?>;
    text-decoration: <?php echo($linkDecoration); ?>;
}

#spMainContainer a:hover,
#spMainContainer .spLink:hover {
    color: <?php echo($linkHover); ?>;
}

#spMainContainer .spImg {
	vertical-align: middle;
	padding: 2px;
	border: none;
}

#spMainContainer .spIcon {
	vertical-align: middle;
	margin: 0;
	padding: 5px;
	border: none;
}

#spMainContainer .spIconSmall {
	vertical-align: middle;
	padding: 0 5px 0 5px;
	border: none;
}

#spMainContainer .spInRowPageLinks img.spIconSmall {
	margin-top: -1px;
}

#spMainContainer .spLabel,
#spMainContainer .spLabelBordered {
    font-size: <?php echo($spLabelBordered); ?>;
	font-weight: <?php echo($mainFontWeight); ?>;
	margin: 0 10px 0 0;
	padding: 0;
}

#spMainContainer .spLabelBordered {
	width: auto;
	height: <?php echo($linkButtonHeight); ?>;
	text-align: center;
	line-height: <?php echo($controlLineHeight); ?>;
	padding: 1px 7px;
	margin: 2px 2px;
    font-size: <?php echo($spLabelBorderedButton); ?>;
	font-family: <?php echo($buttonFontFamily); ?>;
	outline-style: none;
	color: <?php echo($alt1SectionColor); ?>;
	border: <?php echo($alt1SectionBorder); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spLabelSmall {
    font-size: <?php echo($spLabelSmall); ?>;
	margin: 0;
	padding: 5px;
	line-height: 1em;
}

#spMainContainer .spMessage {
	text-align: center;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
	margin: 5px;
	padding: 10px;
	color: <?php echo($alt2SectionColor); ?>;
	background: <?php echo($alt2SectionBackGround); ?>;
	border: <?php echo($alt2SectionBorder); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer #spUserNotices {
	color: <?php echo($noticeColor); ?>;
	background: <?php echo($noticeBackGround); ?>;
	border: <?php echo($noticeBorder); ?>;
	font-family: <?php echo($mainFontFamily); ?>;
	font-weight: <?php echo($mainFontWeight); ?>;
	font-size: <?php echo($spMessageSuccessFailure); ?>;
}

#spMainContainer a.spButton{
	width: auto;
	height: <?php echo($linkButtonHeight); ?>;
	text-align: center;
	line-height: <?php echo($controlLineHeight); ?>;
	padding: 1px 7px;
	margin: 2px 2px;
    font-size: <?php echo($spButtonAsLabel); ?>;
	font-family: <?php echo($buttonFontFamily); ?>;
	outline-style: none;
	color: <?php echo($alt4LinkColor); ?>;
	text-decoration: <?php echo($alt4LinkDecoration); ?>;
	cursor: pointer;
	background: <?php echo($alt1SectionBackGround); ?>;
	border: <?php echo($alt1SectionBorder); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer a.spButton:hover {
	border: <?php echo($alt4LinkHover); ?>;
}

#spMainContainer a.spButton img {
	vertical-align: middle;
	margin: 0 3px 2px 0;
	padding: 0;
}

#spMainContainer .spButtonAsLabel {
	cursor: default;
	background: <?php echo($alt2SectionBackGround); ?>;
	width: auto;
	height: <?php echo($linkButtonHeight); ?>;
	text-align: center;
	line-height: <?php echo($controlLineHeight); ?>;
	padding: 1px 7px;
	margin: 2px 2px;
    font-size: <?php echo($spButtonAsLabel); ?>;
	font-family: <?php echo($buttonFontFamily); ?>;
	outline-style: none;
	color: <?php echo($alt4LinkColor); ?>;
	text-decoration: <?php echo($alt4LinkDecoration); ?>;
	border: <?php echo($alt1SectionBorder); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spButton, #spMainContainer .spSubmit {
	white-space: normal;
}

/* -------------
Specific classes
----------------*/

#spMainContainer.spForumToolsPopup {
	padding: 5px;
}

#spMainContainer .spForumToolsHeader {
	padding: 5px;
	border-bottom: <?php echo($itemHeaderBorder); ?>;
	margin-bottom: 5px;
}

#spMainContainer .spForumToolsHeader .spForumToolsHeaderTitle {
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
	padding: 0;
	text-align: center;
}

#spMainContainer .spPopupTable {
	width: 100%;
}

#spMainContainer.spForumToolsPopup input.spControl,
#spMainContainer.spForumToolsPopup textarea.spControl {
	width: 85%;
}

#spMainContainer .spPopupTable td {
	padding: 8px 10px;
}

#spMainContainer .spProfileShowPhotosSection .spImg {
	border:	<?php echo($alt5Border); ?>;
	padding: 4px;
}

#spMainContainer .spProfileShowHeader {
    font-size: <?php echo($spProfileShowHeader); ?>;
}

#spMainContainer .spProfileShowHeaderEdit {
    font-size: <?php echo($spProfileShowHeaderEdit); ?>;
}

#spMainContainer img.spOnlineStatus {
	padding-left: 5px;
}

#spMainContainer .spProfileShowSection hr {
    background: <?php echo($alt5Color); ?>;
    color: <?php echo($alt5Color); ?>;
    border: none;
    height: 1px;
}

#spMainContainer #spForumTop,
#spMainContainer #spForumBottom {
	line-height: 1px;
}

#spMainContainer #spLoggedInOutLabel p {
	line-height: 1.2em;
	margin: 0;
	padding: 0;
}

#spMainContainer #spBreadCrumbs {
    font-size: <?php echo($spBreadCrumbs); ?>;
	min-width: 75%;
	line-height: 1.2em;
}

#spMainContainer #spBreadCrumbs span.spBreadCrumbs {
    margin-left:20px;
    min-height:2px;
}

#spMainContainer #spBreadCrumbs a {
	color: <?php echo($alt3LinkColor); ?>;
	text-decoration: <?php echo($alt3LinkDecoration); ?>;
}

#spMainContainer #spBreadCrumbs a:hover {
	color: <?php echo($alt3LinkHover); ?>;
}

#spMainContainer #spAck img.spIcon,
#spMainContainer #spBreadCrumbs img.spIcon {
	padding: 0 5px;
}

#spMainContainer .spHeaderIcon {
	margin: 5px 15px 5px 5px;
}

#spMainContainer .spRowIcon {
	margin: 5px 2px 5px 5px;
}

#spMainContainer .spStatusIcon {
	margin: 5px 5px 0 0;
}

#spMainContainer .spHeaderName {
    font-size: <?php echo($spHeaderName); ?>;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
	padding: 5px 0 4px 0;
}

#spMainContainer .spHeaderDescription {
    font-size: <?php echo($spHeaderDescription); ?>;
	padding-bottom: 10px;
	margin-left: 10px;
}

#spMainContainer .spInHeaderLabel {
    font-size: <?php echo($spInHeaderLabel); ?>;
	padding: 0 5px 0 10px;
}

#spMainContainer .spInHeaderSubForums {
    font-size: <?php echo($spInHeaderSubForums); ?>;
	border-top: <?php echo($itemListBorderOdd); ?>;
	padding: 5px;
}

#spMainContainer .spInHeaderSubForums .spInHeaderSubForumlink {
	color: <?php echo($itemHeaderColor); ?>;
}

#spMainContainer .spInHeaderSubForums .spInHeaderSubForumlink:hover {
}

#spMainContainer .spInHeaderSubForums .spInHeaderLabel ul,
#spMainContainer .spInHeaderSubForums .spInHeaderLabel {
	list-style-type: none;
}

#spMainContainer .spHeaderMessage {
	margin: 5px;
	padding: 8px;
	color: <?php echo($headerMessageColor); ?>;
	border: <?php echo($mainBackGroundBorder); ?>;
	background: <?php echo($mainBackGround); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer a.spRowName {
    font-size: <?php echo($aspRowName); ?>;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
	margin: 2px 10px 2px 0;
	display: block;
}

#spMainContainer .spMemberListSection .spRowName {
    font-size: <?php echo($MemberListSectionspRowName); ?>;
}

#spMainContainer .spRowDescription {
    font-size: <?php echo($spRowDescription); ?>;
	line-height: 1.1em;
}

#spMainContainer .spInRowPageLinks {
	padding: 5px 0 0 0;
}

#spMainContainer a.spInRowForumPageLink {
    font-size: <?php echo($spInRowForumPageLink); ?>;
	text-decoration: <?php echo($alt2LinkDecoration); ?>;
	color: <?php echo($alt2LinkColor); ?>;
	margin: 0;
	padding: 0 3px 0 0;
}

#spMainContainer a.spInRowForumPageLink:hover {
	color: <?php echo($alt2LinkHover); ?>;
}

#spMainContainer .spInRowCount {
	vertical-align: middle;
	text-align: center;
	line-height: 1em;
	margin: 0;
	padding: 0;
}

#spMainContainer .spInRowPostLink {
	vertical-align: middle;
	text-align: center;
	line-height: 1em;
	margin: 0;
	padding: 0;
}

#spMainContainer a.spRowName,
#spMainContainer a.spInRowLastPostLink {
	color: <?php echo($alt1LinkColor); ?>;
	text-decoration: <?php echo($alt1LinkDecoration); ?>;
}

#spMainContainer a.spRowName:hover,
#spMainContainer a.spInRowLastPostLink:hover {
	color: <?php echo($alt1LinkHover); ?>;
}

#spMainContainer a.spInRowSubForumlink {
	color: <?php echo($alt5LinkColor); ?>;
	text-decoration: <?php echo($alt5LinkDecoration); ?>;
}

#spMainContainer a.spInRowSubForumlink:hover {
	color: <?php echo($alt5LinkHover); ?>;
}

#spMainContainer .spInRowLabel {
    font-size: <?php echo($spInRowLabel); ?>;
	color: <?php echo($alt2Color); ?>;
	padding: 0;
	margin: 0;
}

#spMainContainer .spInRowSubForums .spInRowLabel ul,
#spMainContainer .spInRowSubForums .spInRowLabel {
	list-style-type: none;
}

#spMainContainer .spInRowRank,
#spMainContainer .spInRowDate,
#spMainContainer .spInRowNumber,
#spMainContainer .spForumModeratorList {
    font-size: <?php echo($spInRowRankDateNumber); ?>;
}

#spMainContainer .spMemberListSection .spInRowText,
#spMainContainer .spMemberListSection .spInRowRank,
#spMainContainer .spMemberListSection .spInRowDate,
#spMainContainer .spMemberListSection .spInRowNumber {
    font-size: <?php echo($spListSectionInRowRankDateNumber); ?>;
}

#spMainContainer a.spInRowLastPostLink {
    font-size: <?php echo($spInRowLastPostLink); ?>;
}

#spMainContainer .spInRowLabel a.spInRowLastPostLink img {
    padding-bottom: 30px;
}

#spMainContainer .spOdd .spInRowSubForums {
    font-size: <?php echo($spOddspInRowSubForums); ?>;
	border-top: <?php echo($itemListBorderOdd); ?>;
	padding: 5px;
}

#spMainContainer .spOdd:hover .spInRowSubForums {
    font-size: <?php echo($spOddhoverspInRowSubForums); ?>;
	border-top: <?php echo($itemListBorderOddHover); ?>;
	padding: 5px;
}

#spMainContainer .spEven .spInRowSubForums {
    font-size: <?php echo($spEvenspInRowSubForums); ?>;
	border-top: <?php echo($itemListBorderEven); ?>;
	padding: 5px;
}

#spMainContainer .spEven:hover .spInRowSubForums {
    font-size: <?php echo($spEvenhoverspInRowSubForums); ?>;
	border-top: <?php echo($itemListBorderEvenHover); ?>;
	padding: 5px;
}

#spMainContainer #spAck {
	padding: 0 75px;
    font-size: <?php echo($spAck); ?>;
    display: inline;
}

#spMainContainer #sfAbout {
	text-align: center;
}

#spMainContainer div.spGoToBottom {
	padding: 0 0 0 10px;
}

#spMainContainer #spUnreadPostsInfo {
    font-size: <?php echo($spUnreadPostsInfo); ?>;
}

#spMainContainer #spUnreadPostsInfo > span {
	padding-right: 5px;
	line-height: 1em;
}

#spAbout {
	text-align: center;
}

/* --------------------
Page Links
-----------------------*/
#spMainContainer .spPageLinks {
	margin: 0 0 5px 5px;
}

#spMainContainer .spPageLinks a.spPageLinks {
    font-size: <?php echo($aspPageLinks); ?>;
	border: <?php echo($itemHeaderBorder); ?>;
	color: <?php echo($alt1LinkColor); ?>;
	margin: 0 0.2em;
	padding: 0.25em 0.5em;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spPageLinks a.spPageLinks:hover {
	background: <?php echo($itemHeaderBackGround); ?>;
	color: <?php echo($itemHeaderColor); ?>;
}

#spMainContainer .spPageLinks a.spPageLinks.spCurrent {
	background: <?php echo($itemHeaderBackGround); ?>;
	color: <?php echo($itemHeaderColor); ?>;
}

#spMainContainer .spPageLinks a.spPageLinks.spIcon {
	border: none;
}

#spMainContainer .spPageLinks img.spIcon {
	padding: 0;
}

/* --------------------
Stats
-----------------------*/
#spMainContainer .spStatsSection p {
	margin: 0;
	padding: 0;
}

#spMainContainer .spForumTimeZone,
#spMainContainer .spUserTimeZone {
	width: 100%;
	padding: 0 0 5px 0;
	margin-bottom: 5px;
    font-size: <?php echo($spForumTimeZone); ?>;
}

#spMainContainer .spForumTimeZone {
	border-bottom: <?php echo($alt3Border); ?>;
	text-align: right;
}

#spMainContainer .spUserTimeZone {
    margin-top: -26px;
	text-align: left;
}

#spMainContainer .spUserTimeZone span,
#spMainContainer .spForumTimeZone span {
	padding: 0 0 5px 0;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer .spForumStatsTitle,
#spMainContainer .spMembershipStatsTitle,
#spMainContainer .spTopPosterStatsTitle,
#spMainContainer .spMostOnline span,
#spMainContainer .spCurrentBrowsing span,
#spMainContainer .spNewMembersTitle {
	padding: 0 0 5px 0;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer .spCurrentOnline span {
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer .spCurrentOnline span.spOnlineUser {
	font-weight: <?php echo($mainFontWeight); ?>;
}

#spMainContainer .spCurrentOnline span.spOnlineUser {
	font-weight: normal;
}

/*#spMainContainer span.spNewMembersTitle, */
#spMainContainer span.spModeratorsTitle,
#spMainContainer span.spAdministratorsTitle,
#spMainContainer span.spUserGroupListTitle {
	padding: 8px 0 5px;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
}

#spMainContainer .spOnlineStats,
#spMainContainer .spForumStats,
#spMainContainer .spMembershipStats,
#spMainContainer .spTopPosterStats,
#spMainContainer .spNewMembers,
#spMainContainer .spModerators,
#spMainContainer .spAdministrators,
#spMainContainer .spUserGroupList {
	margin: 0;
    font-size: <?php echo($spFooterStats); ?>;
	padding: 0 10px 0 0;
}

#spMainContainer .spAdministrators,
#spMainContainer .spUserGroupList {
	padding-top: 5px;
}

#spMainContainer .spNewMembers,
#spMainContainer .spModerators,
#spMainContainer .spUserGroupList {
	width: 100%;
	border-top: <?php echo($alt3Border); ?>;
	padding: 5px 0;
}

#spMainContainer .spOnlineStats p,
#spMainContainer .spForumStats p,
#spMainContainer .spMembershipStats p,
#spMainContainer .spTopPosterStats p,
#spMainContainer .spNewMembers p,
#spMainContainer .spModerators p,
#spMainContainer .spAdministrators p
#spMainContainer .spUserGroupList p {
	margin: 0;
	padding: 0 0 3px;
}

#spMainContainer .spOnlineStats p {
	margin-bottom: 5px;
}

#spMainContainer .spNewMembers .spNewMembersList {
	font-weight: normal;
}

/* --------------------
Profile
-----------------------*/

#spMainContainer a.spProfilePopupLink.spLink,
#spMainContainer a.spWebLink.spLink,
#spMainContainer a.spProfilePage.spLink,
#spMainContainer a.spBPProfile.spLink,
#spMainContainer a.spWPProfile.spLink,
#spMainContainer a.spUserDefinedProfile.spLink {
	color: <?php echo($alt6LinkColor); ?>;
	text-decoration: <?php echo($alt5LinkDecoration); ?>;
}

#spMainContainer a.spProfilePopupLink.spLink:hover,
#spMainContainer a.spWebLink.spLink:hover,
#spMainContainer a.spProfilePage.spLink:hover,
#spMainContainer a.spBPProfile.spLink:hover,
#spMainContainer a.spWPProfile.spLink:hover,
#spMainContainer a.spUserDefinedProfile.spLink:hover {
	color: <?php echo($alt6LinkHover); ?>;
}

/* --------------------
Forms
-----------------------*/

#spMainContainer #spLoginForm,
#spMainContainer #spSearchFormAdvanced,
#spMainContainer #spHiddenTimestamp {
	display: none;
	margin: 3px auto;
	padding: 0;
	text-align: center;
    font-size: <?php echo($spLoginSearchAdvancedForms); ?>;
    line-height: 23px;
}

#spMainContainer #spHiddenTimestamp select.spControl  {
    margin-left: 30px;
}

#spMainContainer #spHiddenTimestamp .spControl  {
    margin: 0 5px;
}

#spMainContainer #spLoginForm h2,
#spMainContainer #spSearchFormAdvanced h2 {
	margin: 0;
	padding: 0;
	clear: none;
}

#spMainContainer #spLoginForm fieldset.spControl {
	vertical-align: top;
	height: 220px;
	margin-top: 0px;
}

#spMainContainer #loginform input {
	margin: 2px 0;
}

#spMainContainer #spLoginForm form.spForm {
	margin: 0 auto;
    width: 250px;
    text-align: left;
}

#spMainContainer #spLoginForm form.spForm input {
    width: 235px;
}

#spMainContainer #spLoginForm form.spForm input.spSubmit {
    width: auto;
}

#spMainContainer #spLoginForm form.spForm p {
    padding: 5px 0;
    clear: both;
}

#spMainContainer #spLoginForm form.spForm p.spForm {
    text-align: center;
    padding: 10px 0;
}

#spMainContainer .spSearchForm a {
    font-size: <?php echo($spSearchForm); ?>;
    margin: 0 5px;
}

#spMainContainer .spSearchSection {
	float: left;
	padding: 0;
	width: 100%;
    margin-bottom: 5px;
}

#spMainContainer .spSearchFormSubmit {
	float: left;
	padding: 0;
	width: 100%;
    margin-top: 10px;
    margin-bottom: 5px;
}

#spMainContainer .spSearchFormSubmit a {
    padding: 5px;
}

#spMainContainer .spSearchMember .spSearchSection,
#spMainContainer .spSearchTopicStatus .spSearchSection {
	text-align: left;
}

#spMainContainer .spSearchSection .spRadioSection {
	padding: 0 5% 0 0;
	text-align: left;
	width: 25%;
}

#spMainContainer p.spSearchForumScope,
#spMainContainer p.spSearchSiteScope,
#spMainContainer p.spSearchMatch,
#spMainContainer p.spSearchOptions {
	text-align: center;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
	margin: 0 0 5px 0;
	padding: 0;
}

#spMainContainer p.spSearchSiteScope {
	margin-top: 20px;
}

#spMainContainer p.spSearchDetails {
	margin: 10px 0 0 0;
	width: 100%;
	border-top: <?php echo($mainBackGroundBorder); ?>;
	padding: 10px 0 0 0;
	text-align: left;
    font-size: <?php echo($pspSearchDetails); ?>;
}

#spMainContainer .spSearchMember input.spControl {
	height: <?php echo($controlHeight); ?>;
	line-height: <?php echo($controlLineHeight); ?>;
	margin-right: 10px;
}

#spMainContainer label.spRadio,
#spMainContainer label.spCheckbox,
#spMainContainer label.spSelect {
	margin: 0;
	padding: 4px 5px 4px 0px;
	background: transparent;
	line-height: 14px;
}

/* --------------------
Form Controls
-----------------------*/

#spMainContainer textarea.spControl,
#spMainContainer select.spControl,
#spMainContainer input.spControl {
	height: <?php echo($controlHeight); ?>;
	border: <?php echo($controlBorder); ?>;
	background: <?php echo($controlBackGround); ?>;
	color: <?php echo($controlColor); ?>;
	font-family: <?php echo($controlFontFamily); ?>;
    font-size: <?php echo($spControl); ?>;
	line-height: <?php echo($controlLineHeight); ?>;
	padding: 0 5px;
	margin: 0;
	width: auto;
	<?php echo($smallRadius); ?>
}

#spMainContainer textarea.spControl {
	height: auto;
	resize: vertical;
}

#spMainContainer select.spSelect {
	width: auto;
	border: <?php echo($controlBorder); ?>;
	background: <?php echo($controlBackGround); ?>;
	color: <?php echo($controlColor); ?>;
}

#spMainContainer input.spSubmit {
	width: auto;
	min-height: <?php echo($controlHeight); ?>;
	height: auto;
	text-align: center;
	padding: 1px 7px 4px;
	margin: 0 4px 3px 4px;
    font-size: <?php echo($spSubmit); ?>;
	font-family: <?php echo($controlFontFamily); ?>;
	line-height: <?php echo($controlLineHeight); ?>;
	text-decoration: none;
	outline-style: none;
	color: <?php echo($alt1SectionColor); ?>;
	background: <?php echo($alt1SectionBackGround); ?>;
	border: <?php echo($alt1SectionBorder); ?>;
    cursor: pointer;
	<?php echo($smallRadius); ?>
	font-weight: <?php echo($mainFontWeight); ?>;
}

#spMainContainer .spSearchForm input.spControl {
    font-size: <?php echo($spSubmit); ?>;
}

#spMainContainer .spSubmit:hover {
	border: <?php echo($alt1SectionHover); ?>;
	font-weight: <?php echo($mainFontWeight); ?>;
}

#spMainContainer .spControl:hover {
	border: <?php echo($controlBorderHover); ?>;
	background: <?php echo($controlBackGroundHover); ?>;
	box-shadow: <?php echo($controlBoxShadowHover); ?>;
}

#spMainContainer .spControl:focus {
	background: <?php echo($controlBackGroundHover); ?>;
	box-shadow: <?php echo($controlBoxShadowHover); ?>;
}

#spMainContainer .spButton[disabled],
#spMainContainer .spSubmit[disabled],
#spMainContainer .spControl[disabled] {
    background: #f0f0f0 !important;
    color: #cccccc;
    border: 1px solid #cccccc;
}

#spMainContainer .spButton:hover[disabled],
#spMainContainer .spSubmit:hover[disabled],
#spMainContainer .spControl:hover[disabled] {
	background: #e0e0f0;
    color: #aaaaaa;
    border: 1px solid #aaaaaa;
}

#spMainContainer fieldset {
	border: <?php echo($mainBackGroundBorder); ?>;
	background: <?php echo($mainBackGround); ?>;
	color: <?php echo($mainBackGroundColor); ?>;
	padding: 10px;
	margin: 10px;
}

#spMainContainer fieldset legend {
	text-align: left;
    padding: 0 5px;
	font-weight: <?php echo($legendFontWeight); ?>;
}

#spMainContainer .spUsergroupSelect select {
    font-size: 80%;
    vertical-align: top;
}

/* Checkbox/Radio Buttons
----------------------------------*/
#spMainContainer label.checkbox span.holder,
#spMainContainer label.radio span.holder {
	height:61px;
	background: <?php echo($OnOff); ?>;
}

#spMainContainer label.checked span.holder {
	top: -42px !important;
}

#spMainContainer label.list {
	clear: both;
	float: left;
	background: transparent;
	width: 100%;
    font-size: <?php echo($labellist); ?>;
	color: <?php echo($itemListColor); ?>;
}

#spMainContainer label.inline {
	float: left;
	margin:0 10px 0 0;
}

#spMainContainer input.hiddenCheckbox {
	position: absolute;
	left: -10000px;
}

#spMainContainer label.prettyCheckbox span.holderWrap {
	display: block;
	float: left;
	position: relative;
	margin-right: 12px;
	overflow: hidden;
}

#spMainContainer label.prettyCheckbox span.holder {
	display: block;
	position: absolute;
	top: 0;
	right: 0;
	cursor: pointer;
}

#spMainContainer .spProfileForm label.list,
#spMainContainer .spProfileForm label.prettyCheckbox span.holderWrap {
	float: left;
	margin-top: 1px;
    padding-top: 2px
}

/* Tooltips
----------------------------------*/
p#vtip {
	display: none;
	color: <?php echo($alt1Color); ?>;
	font-family: <?php echo($toolTipFontFamily); ?>;
	position: absolute;
	padding: 10px;
	left: 5px;
    font-size: <?php echo($pvtip); ?>;
	line-height: 1.2em;
	background: <?php echo($alt1BackGround); ?>;
	border: <?php echo($alt1Border); ?>;
	<?php echo($largeRadius); ?>
    z-index: 999999;
}
p#vtip a {
	color: <?php echo($alt1Color); ?>;
}

/* UI Dialog
----------------------------------*/
.ui-dialog {
	position: fixed !important;
	padding: .2em;
	width: 300px;
	background: <?php echo($alt4BackGround); ?>;
	border: <?php echo($alt4Border); ?>;
	color: <?php echo($alt4Color); ?>;
	<?php echo($largeRadius); ?>
	font-family: <?php echo($dialogFontFamily); ?>;
    z-index: 10;
}

.ui-dialog .ui-dialog-titlebar {
	padding: .2em 1em .2em;
	position: relative;
	<?php echo($smallRadius); ?>
}

.ui-dialog .ui-dialog-title {
	float: left;
	margin: .1em 16px 0 0;
	line-height: 18px;
	font-size: 16px;
}

.ui-dialog .ui-dialog-titlebar-close {
	position: absolute;
	right: 12px;
	top: 17px;
	width: 18px;
	margin: -10px 0 0 0;
	padding: 0;
	height: 18px;
	background-image: <?php echo($ImageClose); ?> !important;
}

.ui-dialog .ui-dialog-titlebar-close:before {
	content: " ";
}

.ui-dialog .ui-dialog-titlebar-close span {
	display: block;
	margin: 1px;
}

.ui-dialog .ui-dialog-titlebar-close:hover,
#spMainContainer .ui-dialog .ui-dialog-titlebar-close:focus {
	padding: 0;
}

.ui-dialog-content a {
    color: <?php echo($alt1LinkColor); ?>;
    text-decoration: <?php echo($alt1LinkDecoration); ?>;
}

.ui-dialog-content a:hover {
    color: <?php echo($alt1LinkHover); ?>;
}

.ui-dialog .ui-dialog-content,
.ui-dialog .ui-dialog-content p {
	border: 0;
	padding: 2px !important;
	background: <?php echo($plainSectionBackGround); ?>;
	overflow: auto;
	zoom: 1;
    margin: 0;
    clear: both;
}

.ui-dialog .ui-dialog-buttonpane {
	text-align: left;
	border-width: 1px 0 0 0;
	background: <?php echo($plainSectionBackGround); ?>;
	margin: .5em 0 0 0;
	padding: .3em 1em .5em .4em;
}

.ui-dialog .ui-dialog-buttonpane button {
	float: right;
	margin: .5em .4em .5em 0;
	cursor: pointer;
	padding: .2em .6em .3em .6em;
	line-height: 1.4em;
	width: auto;
	overflow: visible;
}

.ui-dialog .ui-resizable-se {
	width: 11px;
	height: 11px;
	right: 3px !important;
	bottom: 3px;
	float: right;
	background-image: <?php echo($ImageResize); ?>;
}

.ui-draggable .ui-dialog-titlebar {
	cursor: move;
}

.ui-widget-header {
	background: <?php echo($itemHeaderBackGround); ?>;
	color: <?php echo($itemHeaderColor); ?>;
	border: <?php echo($itemHeaderBorder); ?>;
    height: 26px;
}

.ui-widget-overlay {
	background: <?php echo($Imagesp_ImageOverlay); ?> !important;
	opacity: .50 !important;
	filter: Alpha(Opacity=50) !important;
    z-index: 10 !important;
}

.ui-dialog .ui-dialog-content img.spPopupImg {
    width: 100%;
    height: 100%;
}

/* ---------------------
Success/Failure Messages
------------------------*/
#spMainContainer .spMessageSuccess,
#spMainContainer .spMessageFailure,
.spMessageSuccess,
.spMessageFailure {
	display: none;
	z-index: 9999999;
	margin: 1em auto 0 auto;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
    font-size: <?php echo($spMessageSuccessFailure); ?>;
	vertical-align: middle;
	padding: 10px 20px;
	height: auto;
	width: auto;
	position: fixed;
	top: 20px;
    text-align: center;
	<?php echo($largeRadius); ?>
}

#spMainContainer .spMessageSuccess,
.spMessageSuccess {
	border: <?php echo($successBorder); ?>;
	background: <?php echo($successBackGround); ?>;
	color: <?php echo($successColor); ?>;
}

#spMainContainer .spMessageFailure,
.spMessageFailure {
	border: <?php echo($failBorder); ?>;
	background: <?php echo($failBackGround); ?>;
	color: <?php echo($failColor); ?>;
}

#spMainContainer .spMessageSuccess img,
#spMainContainer .spMessageFailure img,
.spMessageSuccess img,
.spMessageFailure img {
	vertical-align: middle !important;
	padding: 2px 10px 2px 5px !important;
}

#spMainContainer #spPostNotifications {
	display: none;
	font-family: <?php echo($headingFontFamily); ?>;
	font-weight: <?php echo($headingFontWeight); ?>;
    font-size: <?php echo($spMessageSuccessFailure); ?>;
	border: <?php echo($failBorder); ?>;
	background: <?php echo($failBackGround); ?>;
	color: <?php echo($failColor); ?>;
	vertical-align: middle;
	padding: 2px 4px;
	height: auto;
	width: auto;
	<?php echo($smallRadius); ?>
}

/* ---------------------
Profile Tabs
------------------------*/
#spMainContainer ul#spProfileTabs {
	margin: 0;
	padding: 0 0 1px 5px;
	height: <?php echo($profileHeight); ?>;
}

#spMainContainer ul#spProfileTabs li {
	float: left;
	padding: 0;
	margin: 0;
	list-style: none;
}

#spMainContainer ul#spProfileTabs a {
	float: left;
    font-size: <?php echo($ulspProfileTabs); ?>;
	display: block;
	padding: 4px 5px;
	text-decoration: none;
	border: <?php echo($profileBorder); ?>;
	background: <?php echo($profileBackGround); ?>;
	color: <?php echo($profileColor); ?>;
	margin-right: 2px;
	position: relative;
	outline: 0;
	<?php echo($profileTabsRadius); ?>
}

#spMainContainer ul#spProfileTabs a:hover {
	background: <?php echo($profileBackGroundHover); ?>;
	color: <?php echo($profileColorHover); ?>;
	border: <?php echo($profileBorderHover); ?>;
}

#spMainContainer ul#spProfileTabs a.current {
	background: <?php echo($profileBackGroundCur); ?>;
	border: <?php echo($profileBorderCur); ?>;
	color: <?php echo($profileColorCur); ?>;
}

/* ---------------------
Profile Content
------------------------*/
#spMainContainer #spProfileContent {
	color: <?php echo($alt5Color); ?>;
	border: <?php echo($alt5Border); ?>;
	padding: 5px 10px;
	background: <?php echo($alt5BackGround); ?>;
	<?php echo($smallRadius); ?>
}

/* ---------------------
Profile Header
------------------------*/
#spMainContainer #spProfileHeader {
	padding-left: 20%;
    font-size: <?php echo($spProfileHeader); ?>;
	margin: 10px;
	float: left;
}

/* ---------------------
Profile Menu
------------------------*/
#spMainContainer #spProfileMenu {
	float: left;
	padding: 15px 0 0 0;
	margin: 0;
	width: 20%;
	clear: both;
}

#spMainContainer ul.spProfileMenuGroup {
	list-style: none;
	margin: 0;
	padding: 0;
}

#spMainContainer li.spProfileMenuItem {
	width: 98%;
	background:<?php echo($profileBackGroundAlt); ?>;
    font-size: <?php echo($lispProfileMenuItem); ?>;
	margin: 5px 0;
	padding: 5px 0;
	<?php echo($smallRadius); ?>
	border: <?php echo($profileBorder); ?>;
	color: <?php echo($profileColor); ?>;
    list-style: none;
}


#spMainContainer li.spProfileMenuItem.current {
	background: <?php echo($profileBackGroundCur); ?>;
}
#spMainContainer li.spProfileMenuItem.current a {
	color: <?php echo($profileColorCur); ?>;
}
#spMainContainer li.spProfileMenuItem.current:hover {
	background: <?php echo($profileBackGroundCur); ?>;
	border: <?php echo($profileBorder); ?>;
}

#spMainContainer li.spProfileMenuItem:hover {
	background: <?php echo($profileBackGroundHover); ?>;
	color: <?php echo($profileColorHover); ?>;
	border: <?php echo($profileBorderHover); ?>;
}

#spMainContainer li.spProfileMenuItem a {
	padding: 5px;
	margin: 1px 0;
	color: <?php echo($profileColor); ?>;
}
/* ---------------------
Profile Form Panel
------------------------*/
#spMainContainer #spProfileData {
	float: left;
	margin: 1px 0 0 0;
	padding: 0;
	background: <?php echo($profileBackGroundHover); ?>;
	width: 80%;
	<?php echo($largeRadius); ?>
}

#spMainContainer #spProfileFormPanel {
	padding: 10px;
    font-size: <?php echo($spProfileFormPane); ?>;
}

/* ---------------------
Profile Form
------------------------*/
#spMainContainer .spProfileFormSubmit {
	clear: both;
	padding-top: 15px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}

/* ---------------------
Profile Elements
------------------------*/

#spMainContainer p.spProfileLabel {
	margin: 5px 0 0 0;
	padding: 0;
	line-height: 1.6em;
}

#spMainContainer span.spProfileRadioLabel {
	line-height: 22px;
}

#spMainContainer .spProfileForm textarea {
	width: 90%;
    resize: vertical;
}

#spMainContainer .spProfileForm input {
	width: 90%;
	vertical-align: top;
}

#spMainContainer .spProfileForm input.spSubmit {
	width: auto;
}

#spMainContainer .spProfileForm input#spAvatarInput{
	width: 100%;
}

#spMainContainer .spProfileUsergroupsMemberships,
#spMainContainer .spProfileUsergroupsNonMemberships {
	color: <?php echo($itemHeaderColor); ?>;
	background: <?php echo($itemHeaderBackGround); ?>;
	border: <?php echo($itemHeaderBorder); ?>;
	padding: 5px;
	<?php echo($smallRadius); ?>
	margin-top: 20px;
}

#spMainContainer .spProfileUsergroupsNonMemberships {
	margin-top: 30px;
}

#spMainContainer .spProfileUsergroup {
	margin: 10px 0;
	padding: 5px;
	color: <?php echo($itemListColor); ?>;
	background: <?php echo($itemListBackGround); ?>;
	border: <?php echo($itemListBorder); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spProfileUsergroup:hover {
	color: <?php echo($itemListColorHover); ?>;
	background: <?php echo($itemListBackGroundHover); ?>;
	border: <?php echo($itemListBorderHover); ?>;
}

#spMainContainer .spProfileUsergroup.spOdd {
	margin: 10px 0;
	padding: 5px;
	color: <?php echo($itemListColorOdd); ?>;
	background: <?php echo($itemListBackGroundOdd); ?>;
	border: <?php echo($itemListBorderOdd); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spProfileUsergroup.spOdd:hover {
	color: <?php echo($itemListColorOddHover); ?>;
	background: <?php echo($itemListBackGroundOddHover); ?>;
	border: <?php echo($itemListBorderOddHover); ?>;
}

#spMainContainer .spProfileUsergroup.spEven {
	margin: 10px 0;
	padding: 5px;
	color: <?php echo($itemListColorEven); ?>;
	background: <?php echo($itemListBackGroundEven); ?>;
	border: <?php echo($itemListBorderEven); ?>;
	<?php echo($smallRadius); ?>
}

#spMainContainer .spProfileUsergroup.spEven:hover {
	color: <?php echo($itemListColorEvenHover); ?>;
	background: <?php echo($itemListBackGroundEvenHover); ?>;
	border: <?php echo($itemListBorderEvenHover); ?>;
}

#spMainContainer .spProfileUsergroup .spColumnSection {
	float: left;
	width: 70%;
}

#spMainContainer .spProfileUsergroup .spProfileMembershipsLeave,
#spMainContainer .spProfileUsergroup .spProfileMembershipsJoin {
	padding-top: 20px;
	float: right;
	width: 30%;
}

#spMainContainer .spProfileMembershipsLeave .spInRowLabel,
#spMainContainer .spProfileMembershipsJoin .spInRowLabel {
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}

#spMainContainer .spProfileSpacerCol {
	float: left;
	text-align: left;
	width: 5%;
}

#spMainContainer .spProfileRightCol {
	float: left;
	text-align: left;
	width: 60%;
}

#spMainContainer .spProfileLeftCol {
	clear: both;
	float: left;
	text-align: right;
	width: 35%;
}

#spMainContainer .spProfileRightHalf {
	float: left;
	text-align: left;
	width: 47%;
}

#spMainContainer .spProfileLeftHalf {
	float: left;
	text-align: left;
	width: 47%;
}

#spMainContainer .spProfileOverview .spButton {
	float: left;
}

#spMainContainer .spProfileUserPermissions .spProfilePermission {
	color: <?php echo($itemListColorHover); ?>;
	background: <?php echo($itemListBackGroundHover); ?>;
	border-left: <?php echo($itemHeaderBorder); ?>;
	border-right: <?php echo($itemHeaderBorder); ?>;
}

#spMainContainer .spProfileUserPermissions .spColumnSection.spProfilePermissionIcon {
    width: 9%;
    float: left;
}

#spMainContainer .spProfileUserPermissions .spColumnSection.spProfilePermissionForum {
    width: 75%;
    float: left;
}

#spMainContainer .spProfileUserPermissions .spColumnSection.spProfilePermissionButton {
    width: 15%;
    float: right;
}

#spMainContainer .spProfileUserPermissions .spProfilePermission .spAuthCat {
    clear: both;
    font-weight: bold;
    padding: 10px 0 5px 10px;
    text-decoration: underline;
}

#spMainContainer .spProfileUserPermissions .spProfilePermission .spColumnSection {
    width: 45%;
    float: left;
    padding-left:10px;
    font-size: 0.9em;
    height: auto;
}

#spMainContainer .spProfileUserPermissions .spProfilePermission p {
    clear: both;
    text-align: center;
}

#spMainContainer .spProfileAccount #pass-strength-result {
    background-color: #EEEEEE;
    border: 1px solid #DDDDDD;
    margin: 13px 5px 5px 1px;
    padding: 3px 5px;
    text-align: center;
    width: 200px;
}

#spMainContainer .spProfileAccount #pass-strength-result.short {
    background-color: #FFA0A0;
    border-color: #F04040;
}

#spMainContainer .spProfileAccount #pass-strength-result.bad {
    background-color: #FFB78C;
    border-color: #FF853C;
}

#spMainContainer .spProfileAccount #pass-strength-result.good {
    background-color: #FFEC8B;
    border-color: #FFCC00;
}

#spMainContainer .spProfileAccount #pass-strength-result.strong {
    background-color: #C3FF88;
    border-color: #8DFF1C;
}

#spMainContainer .spProfileAccount .indicator-hint {
    font-size: 90%;
    padding-top: 5px;
}

/* ---------------------
Editor Elements
------------------------*/

#spMainContainer .spEditor table,
#spMainContainer .spEditor tr,
#spMainContainer .spEditor td {
	margin: 0;
	padding: 0;
	text-align: left;
	line-height: 1em;
	width: auto;
	border: 0;
}

/* ---------------------
Admin Tools Icon
------------------------*/

#spMainContainer a.spToolsButton {
	width: auto;
	height: <?php echo($linkButtonHeight); ?>;
	text-align: center;
	line-height: <?php echo($controlLineHeight); ?>;
	padding: 2px;
	margin: 2px 0 0 5px;
    font-size: <?php echo($aspToolsButton); ?>;
	font-family: <?php echo($buttonFontFamily); ?>;
	outline-style: none;
	color: <?php echo($alt1SectionColor); ?>;
	background: <?php echo($alt1SectionBackGround); ?>;
	border: <?php echo($alt1SectionBorder); ?>;
	<?php echo($smallRadius); ?>
	position: absolute;
	cursor: pointer;
}

#spMainContainer .spToolsButton img {
	vertical-align: middle;
	margin: 0;
	padding: 0;
}

#spMainContainer a.spToolsButton:hover {
	background: <?php echo($alt1SectionBackGround); ?>;
	border: <?php echo($alt4LinkHover); ?>;
}
/* Quicklinks
----------------------------------*/

#spMainContainer #spQuickLinksTopic,
#spMainContainer #spQuickLinksForum {
	display: none;
	height: <?php echo($controlHeight); ?>;
	width: <?php echo($quickLinksSelectWidth); ?>;
	border: <?php echo($controlBorder); ?>;
	background: <?php echo($controlBackGround); ?>;
	color: <?php echo($controlColor); ?>;
	font-family: <?php echo($controlFontFamily); ?>;
    font-size: <?php echo($FontspQuickLinks); ?>;
	line-height: <?php echo($controlLineHeight); ?>;
	padding: 0 5px;
	margin: 0;
	<?php echo($smallRadius); ?>
	text-decoration: none;
	text-align:left;
    position: relative;
}

#spMainContainer #spQuickLinksTopic:hover,
#spMainContainer #spQuickLinksForum:hover {
	border: <?php echo($controlBorderHover); ?>;
	background: <?php echo($controlBackGroundHover); ?>;
}

#spMainContainer #spQuickLinksTopic .dd .ddTitle,
#spMainContainer #spQuickLinksForum .dd .ddTitle {
	padding:3px;
	margin-top: 2px;
	text-indent:0;
	cursor:default;
	overflow:hidden;
}

#spMainContainer #spQuickLinksTopic .dd .ddTitle span.arrow,
#spMainContainer #spQuickLinksForum .dd .ddTitle span.arrow {
	background: <?php echo($Imagedd_arrow); ?>;
	float:right;
	display:inline-block;
	width:16px;
	height:16px;
	cursor:pointer;
    position: inherit;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild,
#spMainContainer #spQuickLinksForum .dd .ddChild {
	position:absolute;
	display:none;
	height: auto !important;
	width:	<?php echo($quickLinksListWidth); ?>;
	overflow:auto;
	overflow-x:hidden !important;
	border: <?php echo($alt2SectionBorder); ?>;
	background: <?php echo($alt2SectionBackGround); ?>;
	color: <?php echo($alt2SectionColor); ?>;
	padding: 10px;
	margin: 0 10px;
	z-index: 100 !important;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild .opta,
#spMainContainer #spQuickLinksForum .dd .ddChild .opta {
	border-top: <?php echo($alt2SectionBorder); ?>;
	padding-top: 4px;
	margin-top: 3px;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild .opta a,
#spMainContainer #spQuickLinksForum .dd .ddChild .opta a,
#spMainContainer #spQuickLinksTopic .dd .ddChild .opta a:visited,
#spMainContainer #spQuickLinksForum .dd .ddChild .opta a:visited {
	padding-left:10px
}

#spMainContainer #spQuickLinksTopic .dd .ddChild a,
#spMainContainer #spQuickLinksForum .dd .ddChild a {
	display:block;
	padding:2px 0 2px 3px;
	text-decoration:none;
	color: <?php echo($spQuickLinksTopicColor); ?>;
	overflow:hidden;
	white-space:nowrap;
	cursor:pointer;
}

#spMainContainer #spQuickLinksForum .dd .ddChild a {
	margin-left: 16px;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild a:hover,
#spMainContainer #spQuickLinksForum .dd .ddChild a:hover {
	background: <?php echo($alt1SectionGradient); ?>;
	color: <?php echo($spQuickLinksTopichover); ?>;
	border-radius: <?php echo($smallRadius); ?>;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild a img {
	border:0;
	padding:0 2px 0 0;
	vertical-align:middle;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild a.selected,
#spMainContainer #spQuickLinksForum .dd .ddChild a.selected {
	background: <?php echo($alt1SectionGradient); ?>;
	color: <?php echo($spQuickLinksTopichover); ?>;
	border-radius: <?php echo($smallRadius); ?>;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild .ddTopTitle,
#spMainContainer #spQuickLinksForum .dd .ddChild .ddTopTitle {
	color: <?php echo($spQuickLinksTopicColor); ?>;
	background: <?php echo($itemHeaderBackGround); ?>;
	border: <?php echo($itemHeaderBorder); ?>;
	margin-left: 0;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild .spPostNew {
	color: <?php echo($pQuickLinksTopicspPostNew); ?>;
}

#spMainContainer #spQuickLinksTopic .dd .ddChild .spPostMod {
	color: <?php echo($pQuickLinksTopicspPostMod); ?>;
}
/* Center Forum Page Title Graphic Replacement
----------------------------------*/
img#sfbanner {
    display: block;
    margin-left: auto;
    margin-right: auto;
}

/* core autocomplete styles
----------------------------------*/
.ui-autocomplete {
	position: absolute;
	cursor: default;
	background: <?php echo($controlBackGround); ?>;
	border: <?php echo($controlBorder); ?>;
	color: <?php echo($controlColor); ?>;
}

.ui-front.ui-autocomplete {
    z-index: 101;
}

* html .ui-autocomplete {
	width: 1px;
}

.ui-menu {
	list-style: none;
	padding: 2px;
	margin: 0;
	display: block;
	float: left;
}

.ui-menu .ui-menu {
	margin-top: -3px;
}

.ui-menu .ui-menu-item {
	margin: 0;
	padding: 0;
	zoom: 1;
	float: left;
	clear: left;
	width: 100%;
}

.ui-menu .ui-menu-item a {
	text-decoration: none;
	display: block;
	padding: .1em .4em;
	line-height: 1.0;
	zoom: 1;
	color: <?php echo($controlColor); ?>;
}

.ui-menu .ui-menu-item a:hover,
.ui-menu .ui-menu-item a:active {
	background: <?php echo($alt1SectionGradient); ?>;
}

.ui-helper-hidden-accessible {
    display: none;
}

/* wp media embeds */

#spMainContainer .mejs-container {
    background: #464646;
    vertical-align: top;
    font-family: Helvetica,Arial;
}

#spMainContainer .mejs-container * {
    float: left;
    font-size: 11px;
}

#spMainContainer .mejs-controls .mejs-time {
    padding: 8px 3px 0;
    line-height: 12px;
    color: #FFFFFF;
}

#spMainContainer .mejs-controls .mejs-time-rail {
    padding-top: 5px;
}

#spMainContainer .mejs-controls .mejs-time-rail span {
    border-radius: 2px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
}

#spMainContainer .mejs-controls .mejs-time-rail .mejs-time-loaded {
    background: #21759B;
}

#spMainContainer .mejs-controls .mejs-time-rail .mejs-time-current {
    background: #D54E21;
}

#spMainContainer .mejs-controls .mejs-time-rail .mejs-time-total {
    margin: 5px;
}

#spMainContainer .mejs-controls .mejs-time-rail .mejs-time-handle {
    background: #ffffff;
    border: 2px solid #333333;
}

#spMainContainer .mejs-controls .mejs-time-rail .mejs-time-float {
    background: #eeeeee;
    border: 1px solid #333333;
    margin-left: -18px;
}

#spMainContainer .mejs-controls .mejs-time-rail .mejs-time-float-current {
    margin: 2px;
}

#spMainContainer .mejs-controls .mejs-time-rail .mejs-time-float-corner {
	line-height: 0;
	border: solid 5px #eee;
	border-color: #eee transparent transparent transparent;
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
}

#spMainContainer .mejs-controls .mejs-volume-button .mejs-volume-slider {
    background: rgba(50, 50, 50, 0.7);
}

#spMainContainer .mejs-controls .mejs-volume-button .mejs-volume-total {
	background: #ddd;
    background: rgba(255, 255, 255, 0.5);
}

#spMainContainer .mejs-controls .mejs-volume-button .mejs-volume-current {
	background: #ddd;
    background: rgba(255, 255, 255, 0.9);
}

#spMainContainer .mejs-controls .mejs-volume-button .mejs-volume-handle {
	background: #ddd;
    background: rgba(255, 255, 255, 0.9);
}

<?php

# load the rtl css file if needed
if (isset($_GET['rtl'])) {
	include('default-rtl.css');
}

?>