<?php

# --------------------------------------------------------------------------------------
#
#	Simple:Press Template Color Attribute File
#	Theme		:	default
#	Color		:	Easter Eggs
#	Author		:	Simple:Press
#
# --------------------------------------------------------------------------------------

# ------------------------------------------------------------------
# The overall SP forum container
# ------------------------------------------------------------------
$mainBackGroundBase		= '#f6f8f9';
$mainBackGroundFrom		= '#f6f8f9';
$mainBackGroundTo		= '#f6f8f9';
$mainBackGroundBorder	= '5px solid #c6cee4';
$mainBackGroundColor	= '#4c5d77';
$mainBackGroundHover	= '5px solid #c3a0e5';
$mainBackGroundGradient	= "-moz-linear-gradient(100% 100% 90deg, $mainBackGroundTo, $mainBackGroundFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($mainBackGroundFrom), to($mainBackGroundTo)); background: -ms-linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: -o-linear-gradient(top,  $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background-color: $mainBackGroundBase;";
$mainBackGroundSolid	= '#DDE5FE';
$mainBackGroundImage	= 'url("images/image.gif")';
$mainBackGround			= $mainBackGroundSolid; # pick background from: $mainBackGroundSolid, $mainBackGroundImage or $mainBackGroundGradient
$mainFontSize			= '100%';
$mainLineHeight			= '1.2em';

# ------------------------------------------------------------------
# font families and Weights
# ------------------------------------------------------------------
$mainFontFamily			= 'inherit';
$altFontFamily			= 'inherit';
$headingFontFamily		= 'inherit';
$buttonFontFamily		= 'inherit';
$controlFontFamily		= 'inherit';
$toolTipFontFamily		= 'inherit';
$dialogFontFamily		= 'inherit';
$mainFontWeight			= 'normal';
$headingFontWeight		= 'bold';
$legendFontWeight       = 'bold';

# ------------------------------------------------------------------
# Plain section - the main building block of non-forum areas
# ------------------------------------------------------------------
$plainSectionBase		= 'inherit';
$plainSectionFrom		= 'inherit';
$plainSectionTo			= 'inherit';
$plainSectionBorder		= 'none';
$plainSectionColor		= 'inherit';
$plainSectionHover		= 'none';
$plainSectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $plainSectionTo, $plainSectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($plainSectionFrom), to($plainSectionTo)); background: -ms-linear-gradient(top, $plainSectionFrom 0%,$plainSectionTo 100%); background: -o-linear-gradient(top,  $plainSectionFrom 0%,$plainSectionTo 100%); background: linear-gradient(top, $plainSectionFrom 0%,$plainSectionTo 100%); background-color: $plainSectionBase;";
$plainSectionSolid		= 'inherit';
$plainSectionImage		= 'url("images/image.gif")';
$plainSectionBackGround	= $plainSectionSolid; # pick background from: $plainSectionSolid, $plainSectionImage or $plainSectionGradient

# ------------------------------------------------------------------
# The overall container of forum lists
# ------------------------------------------------------------------
$listSectionBase		= '#f6f8f9';
$listSectionFrom		= '#f6f8f9';
$listSectionTo			= '#f6f8f9';
$listSectionBorder		= 'none';
$listSectionColor		= '#4c5d77';
$listSectionHover		= 'none';
$listSectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $listSectionTo, $listSectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($listSectionFrom), to($listSectionTo)); background: -ms-linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background: -o-linear-gradient(top,  $listSectionFrom 0%,$listSectionTo 100%); background: linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background-color: $listSectionBase;";
$listSectionSolid		= '#DDE5FE';
$listSectionImage		= 'url("images/image.gif")';
$listSectionBackGround	= $listSectionSolid; # pick background from: $listSectionSolid, $listSectionImage or $listSectionGradient

# ------------------------------------------------------------------
# Header sections within lists
# ------------------------------------------------------------------
$itemHeaderBase			= '#410B08';
$itemHeaderFrom			= '#964141';
$itemHeaderTo			= '#410B08';
$itemHeaderBorder		= '5px solid #c3a0e5';
$itemHeaderColor		= '#4c5d77';
$itemHeaderHover		= '5px solid #c3a0e5';
$itemHeaderGradient		= "-moz-linear-gradient(100% 100% 90deg, $itemHeaderTo, $itemHeaderFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemHeaderFrom), to($itemHeaderTo)); background: -ms-linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background: -o-linear-gradient(top,  $itemHeaderFrom 0%,$itemHeaderTo 100%); background: linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background-color: $itemHeaderBase;";
$itemHeaderSolid		= '#D9B2FF';
$itemHeaderImage		= 'url("images/image.gif")';
$itemHeaderBackGround	= $itemHeaderSolid; # pick background from: $itemHeaderSolid, $itemHeaderImage or $itemHeaderGradient
$headerMessageColor     ='#000000';

# ------------------------------------------------------------------
# Item sections within list
# ------------------------------------------------------------------
$itemListBase					= '#964141';
$itemListFrom					= '#410B08';
$itemListTo						= '#964141';
$itemListBorder					= '5px solid #a7daaf';
$itemListColor					= '#4C5D77';
$itemListGradient				= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolid					= '#BAF3C3';
$itemListImage					= 'url("images/image.gif")';
$itemListBackGround				= $itemListSolid; # pick background from: $itemListSolid, $itemListImage or $itemListGradient
$itemListColorHover				= '#4C5D77';
$itemListBorderHover			= '5px solid #e5b6ba';
$itemListGradientHover			= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidHover				= '#FFCBCF';
$itemListImageHover				= 'url("images/image.gif")';
$itemListBackGroundHover		= $itemListSolidHover; # pick background from: $itemListSolidHover, $itemListImageHover or $itemListGradientHover

$itemListBaseOdd				= '#964141';
$itemListFromOdd				= '#410B08';
$itemListToOdd					= '#964141';
$itemListBorderOdd				= '5px solid #a7daaf';
$itemListColorOdd				= '#4C5D77';
$itemListGradientOdd			= "-moz-linear-gradient(100% 100% 90deg, $itemListToOdd, $itemListFromOdd); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromOdd), to($itemListToOdd)); background: -ms-linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background: -o-linear-gradient(top,  $itemListFromOdd 0%,$itemListToOdd 100%); background: linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background-color: $itemListBaseOdd;";
$itemListSolidOdd				= '#BAF3C3';
$itemListImageOdd				= 'url("images/image.gif")';
$itemListBackGroundOdd			= $itemListSolidOdd; # pick background from: $itemListSolidOdd, $itemListImageOdd or $itemListGradientOdd
$itemListColorOddHover			= '#4C5D77';
$itemListBorderOddHover			= '5px solid #e5b6ba';
$itemListGradientOddHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidOddHover			= '#FFCBCF';
$itemListImageOddHover			= 'url("images/image.gif")';
$itemListBackGroundOddHover		= $itemListSolidOddHover; # pick background from: $itemListSolidOddHover, $itemListImageOddHover or $itemListGradientOddHover

$itemListBaseEven				= '#964141';
$itemListFromEven				= '#410B08';
$itemListToEven					= '#964141';
$itemListBorderEven				= '5px solid #e0e28d';
$itemListColorEven				= '#4C5D77';
$itemListGradientEven			= "-moz-linear-gradient(100% 100% 90deg, $itemListToEven, $itemListFromEven); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromEven), to($itemListToEven)); background: -ms-linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background: -o-linear-gradient(top,  $itemListFromEven 0%,$itemListToEven 100%); background: linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background-color: $itemListBaseEven;";
$itemListSolidEven				= '#F9FC9D';
$itemListImageEven				= 'url("images/image.gif")';
$itemListBackGroundEven			= $itemListSolidEven; # pick background from: $itemListSolidEven, $itemListImageEven or $itemListGradientEven
$itemListColorEvenHover			= '#4C5D77';
$itemListBorderEvenHover		= '5px solid #e5b6ba';
$itemListGradientEvenHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidEvenHover			= '#FFCBCF';
$itemListImageEvenHover			= 'url("images/image.gif")';
$itemListBackGroundEvenHover	= $itemListSolidEvenHover; # pick background from: $itemListSolidEvenHover, $itemListImageEvenHover or $itemListGradientEvenHover

# ------------------------------------------------------------------
# Success / Fail
# ------------------------------------------------------------------
$successBackGround	= '#c6f5c7';
$successBorder		= '1px solid #888888';
$successColor		= '#4c5d77';

$failBackGround		= '#f7a3a3';
$failBorder			= '1px solid #888888';
$failColor			= '#4c5d77';

$noticeBackGround	= '#ffffdd';
$noticeBorder		= '1px solid #c6cee4';
$noticeColor		= '#4c5d77';

# ------------------------------------------------------------------
# Alternate Backgrounds
# ------------------------------------------------------------------
$alt1SectionBase		= '#ffcbcf';
$alt1SectionFrom		= '#e5b6ba';
$alt1SectionTo			= '#ffcbcf';
$alt1SectionBorder		= '1px solid #e5b6ba';
$alt1SectionColor		= '#000000';
$alt1SectionHover		= '1px solid #ffcbcf';
$alt1SectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $alt1SectionTo, $alt1SectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($alt1SectionFrom), to($alt1SectionTo));background: -ms-linear-gradient(top, $alt1SectionFrom 0%,$alt1SectionTo 100%); background: -o-linear-gradient(top,  $alt1SectionFrom 0%,$alt1SectionTo 100%); background: linear-gradient(top, $alt1SectionFrom 0%,$alt1SectionTo 100%); background-color: $alt1SectionBase;";
$alt1SectionSolid		= '#f9fbfc';
$alt1SectionImage		= 'url("images/image.gif")';
$alt1SectionBackGround	= $alt1SectionGradient; # pick background from: $alt1SectionSolid, $alt1SectionImage or $alt1SectionGradient

$alt2SectionBase		= '#fbfbfb';
$alt2SectionFrom		= '#fbfbfb';
$alt2SectionTo			= '#c3c3c3';
$alt2SectionBorder		= '1px solid #e5b6ba';
$alt2SectionColor		= '#4c5d77';
$alt2SectionHover		= '#DDE5FE';
$alt2SectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $alt2SectionTo, $alt2SectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($alt2SectionFrom), to($alt2SectionTo)); background: -ms-linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background: -o-linear-gradient(top,  $alt2SectionFrom 0%,$alt2SectionTo 100%); background: linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background-color: $alt2SectionBase;";
$alt2SectionSolid		= '#ffcbcf';
$alt2SectionImage		= 'url("images/image.gif")';
$alt2SectionBackGround	= $alt2SectionSolid; # pick background from: $alt2SectionSolid, $alt2SectionImage or $alt2SectionGradient

# ------------------------------------------------------------------
# Alternate color variations
# ------------------------------------------------------------------
$alt1BackGround		= '#ffcbcf';
$alt1Border			= '1px solid #e5b6ba';
$alt1Color			= '#4c5d77';

$alt2BackGround		= '#e8f0f0';
$alt2Border			= 'none';
$alt2Color			= '#7788aa';

$alt3BackGround		= '#FFCBCF';
$alt3Border			= '5px solid #e5b6ba';
$alt3Color			= '#4c5d77';

$alt4BackGround		= '#BAF3C3';
$alt4Border			= '1px solid #a7daaf';
$alt4Color			= '#4c5d77';

$alt5BackGround		= $itemHeaderBackGround;
$alt5Border			= '1px solid #c3a0e5';
$alt5Color			= '#4c5d77';

$alt6BackGround		= '#e8f0f0';
$alt6Border			= 'none';
$alt6Color			= '#7788aa';

# ------------------------------------------------------------------
# form control element backgrounds
# ------------------------------------------------------------------
$controlBackGround		= '#f2f3f3';
$controlBorder			= '1px solid #baf3c3';
$controlColor			= '#333333';
$controlHeight			= '25px';
$linkButtonHeight		= '21px';
$controlLineHeight		= '1.6em';

$controlBackGroundHover	= '#e8eef8';
$controlBoxShadowHover  = '0 1px 3px rgba(0, 0, 0, 0.1) inset, 0 0 3px #a7daaf';
$controlBorderHover		= '1px solid #a7daaf';
$controlColorHover		= '#333333';

# ------------------------------------------------------------------
# profile tab/menu element backgrounds
# ------------------------------------------------------------------
$profileBackGround		= $alt1SectionBackGround;
$profileBorder			= '1px solid #c3a0e5';
$profileColor			= '#4C5D77';
$profileHeight			= '23px';

$profileBackGroundHover	= '#BAF3C3';
$profileBorderHover		= '1px solid #c3a0e5';
$profileColorHover		= '#4C5D77';

$profileBackGroundCur	= '#F9FC9D';
$profileBorderCur		= '1px solid #c3a0e5';
$profileColorCur		= '#4C5D77';

$profileBackGroundAlt	= $alt1SectionBackGround;

$profileTabsRadius      ='-webkit-border-radius: 5px 5px 0 0;border-radius: 5px 5px 0 0;';

# ------------------------------------------------------------------
# Post Content
# ------------------------------------------------------------------
$postBackGround			= '#FFFFFF';
$postBorder				= '1px solid #dddddd';
$postColor				= '#4C5D77';
$postBackGroundOdd		= '#ffffff';
$postBorderOdd			= '1px solid #dddddd';
$postColorOdd			= '#4C5D77';
$postBackGroundEven		= '#FFFFFF';
$postBorderEven			= '1px solid #dddddd';
$postColorEven			= '#4C5D77';

$userBackGround			= $itemListBackGround;
$userBorder				= $itemListBorder;
$userColor				= $itemListColor;
$userBackGroundOdd		= $itemListBackGround;
$userBorderOdd			= $itemListBorder;
$userColorOdd			= $itemListColor;
$userBackGroundEven		= $itemListBackGround;
$userBorderEven			= $itemListBorder;
$userColorEven			= $itemListColor;

$postPadding			= '2px';
$postMargin				= '2px 1px 5px 1px';
$postBackRadius			= '-webkit-border-radius: 0px 5px 5px 0px; border-radius: 0px 5px 5px 0px;';

# ------------------------------------------------------------------
# Standard Links
# ------------------------------------------------------------------
$linkColor				= '#115588';
$linkHover				= '#dd2222';
$linkDecoration			= 'none';

$alt1LinkColor			= '#225599';
$alt1LinkHover			= '#dd2222';
$alt1LinkDecoration		= 'none';

$alt2LinkColor			= '#225599';
$alt2LinkHover			= '#225599';
$alt2LinkDecoration		= 'none';

$alt3LinkColor			= '#115588';
$alt3LinkHover			= '#dd2222';
$alt3LinkDecoration		= 'none';

$alt4LinkColor			= '#4c5d77';
$alt4LinkHover			= '1px solid #c6cee4';
$alt4LinkDecoration		= 'none';

$alt5LinkColor			= '#225599';
$alt5LinkHover			= '#225599';
$alt5LinkDecoration		= 'none';

$alt6LinkColor			= '#225599';
$alt6LinkHover			= '#225599';
$alt6LinkDecoration		= 'underline';

# ------------------------------------------------------------------
# Standard Radii
# ------------------------------------------------------------------
$smallRadius	= '-webkit-border-radius: 5px; border-radius: 5px;';
$largeRadius	= '-webkit-border-radius: 9px; border-radius: 9px;';

# ------------------------------------------------------------------
# Misc Font Sizes
# ------------------------------------------------------------------
$PostContentFontSize           ='90%';
$spMainContainerSmall          ='90%';
$spListTopicRowName            ='90%';
$spListForumRowName            ='85%';
$spListPostLink_spListLabel    ='85%';
$UserInfo                      ='80%';
$spPostUserSignature           ='90%';
$spEven_spPostUserPosts        ='90%';
$spOdd_spPostUserPosts         ='90%';
$spPostContent_h1              ='1.6em';
$spPostContent_h2              ='1.5em';
$spPostContent_h3              ='1.4em';
$spPostContent_h4              ='1.3em';
$spPostContent_h5              ='1.2em';
$spPostContent_h6              ='1.1em';
$spSpoiler                     ='0.85em';
$divsfcode                     ='1em';
$inputsfcodeselect             ='10px';
$spPostForm                    ='85%';
$spEditorTitle                 ='1.1em';
$spLabelBordered               ='100%';
$spLabelBorderedButton         ='80%';
$spLabelSmall                  ='80%';
$spButtonAsLabel               ='80%';
$spProfileShowHeader           ='1.4em';
$spProfileShowHeaderEdit       ='0.6em';
$spBreadCrumbs                 ='0.85em';
$spHeaderName                  ='100%';
$spHeaderDescription           ='80%';
$spInHeaderLabel               ='80%';
$spInHeaderSubForums           ='80%';
$aspRowName                    ='95%';
$MemberListSectionspRowName    ='90%';
$spRowDescription              ='80%';
$spInRowForumPageLink          ='85%';
$spInRowLabel                  ='80%';
$spInRowRankDateNumber         ='90%';
$spListSectionInRowRankDateNumber ='80%';
$spInRowLastPostLink           ='80%';
$spOddspInRowSubForums         ='80%';
$spOddhoverspInRowSubForums    ='80%';
$spEvenspInRowSubForums        ='80%';
$spEvenhoverspInRowSubForums   ='80%';
$spAck                         ='85%';
$spUnreadPostsInfo             ='0.9em';
$aspPageLinks                  ='0.8em';
$spForumTimeZone               ='0.8em';
$spFooterStats                 ='0.8em';
$spLoginSearchAdvancedForms    ='90%';
$spSearchForm                  ='0.8em';
$pspSearchDetails              ='0.8em';
$spControl                     ='100%';
$spSubmit                      ='80%';
$labellist                     ='1em';
$pvtip                         ='12px';
$spMessageSuccessFailure       ='90%';
$ulspProfileTabs               ='0.8em';
$spProfileHeader               ='1.2em';
$lispProfileMenuItem           ='0.8em';
$spProfileFormPane             ='0.9em';
$aspToolsButton                ='80%';
$FontspQuickLinks              ='80%';

# ------------------------------------------------------------------
# Some Component Widths
# ------------------------------------------------------------------

$quickLinksSelectWidth		= '230px';
$quickLinksListWidth		= '300px';

# ------------------------------------------------------------------
# Images
# ------------------------------------------------------------------
$OnOff                 ='transparent url("images/onoff.png") 0 -3px no-repeat';
$ImageClose            ='url("images/close.gif")';
$ImageResize           ='url("images/resize.gif")';
$Imagedd_arrow         ='url("images/dd_arrow.gif") no-repeat 0 0';
$Imagesp_ImageOverlay  ='#666666 url("images/sp_ImageOverlay.png") 50% 50% repeat';

# ------------------------------------------------------------------
#Quicklinks Child Colors on dropdown
# ------------------------------------------------------------------

$pQuickLinksTopicspPostNew     ='#488ccc !important';
$pQuickLinksTopicspPostMod     ='#f26565 !important';
$spQuickLinksTopichover        ='#4c5d77';
$spQuickLinksTopicColor        ='#000000';

?>