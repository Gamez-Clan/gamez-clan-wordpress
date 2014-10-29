<?php

# --------------------------------------------------------------------------------------
#
#	Simple:Press Template Color Attribute File
#	Theme		:	default
#	Color		:	Fools Gold
#	Author		:	Simple:Press
#
# --------------------------------------------------------------------------------------

# ------------------------------------------------------------------
# The overall SP forum container
# ------------------------------------------------------------------
$mainBackGroundBase		= '#f6f8f9';
$mainBackGroundFrom		= '#f6f8f9';
$mainBackGroundTo		= '#f6f8f9';
$mainBackGroundBorder	= '1px solid #4A4945';
$mainBackGroundColor	= '#fcd27f';
$mainBackGroundHover	= '1px solid #4A4945';
$mainBackGroundGradient	= "-moz-linear-gradient(100% 100% 90deg, $mainBackGroundTo, $mainBackGroundFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($mainBackGroundFrom), to($mainBackGroundTo)); background: -ms-linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: -o-linear-gradient(top,  $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background-color: $mainBackGroundBase;";
$mainBackGroundSolid	= '#f6f8f9';
$mainBackGroundImage	= 'url("images/fools_gold_bg.gif")';
$mainBackGround			= $mainBackGroundImage; # pick background from: $mainBackGroundSolid, $mainBackGroundImage or $mainBackGroundGradient
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
$listSectionColor		= '#FFCC00';
$listSectionHover		= 'none';
$listSectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $listSectionTo, $listSectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($listSectionFrom), to($listSectionTo)); background: -ms-linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background: -o-linear-gradient(top,  $listSectionFrom 0%,$listSectionTo 100%); background: linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background-color: $listSectionBase;";
$listSectionSolid		= '#f6f8f9';
$listSectionImage		= 'url("images/fools_gold_bg.gif")';
$listSectionBackGround	= $listSectionImage; # pick background from: $listSectionSolid, $listSectionImage or $listSectionGradient

# ------------------------------------------------------------------
# Header sections within lists
# ------------------------------------------------------------------
$itemHeaderBase			= '#dce7ee';
$itemHeaderFrom			= '#dce7ee';
$itemHeaderTo			= '#dce7ee';
$itemHeaderBorder		= '1px solid #FCC149';
$itemHeaderColor		= '#fdd27f';
$itemHeaderHover		= '1px solid #FCC149';
$itemHeaderGradient		= "-moz-linear-gradient(100% 100% 90deg, $itemHeaderTo, $itemHeaderFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemHeaderFrom), to($itemHeaderTo)); background: -ms-linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background: -o-linear-gradient(top,  $itemHeaderFrom 0%,$itemHeaderTo 100%); background: linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background-color: $itemHeaderBase;";
$itemHeaderSolid		= '#232120';
$itemHeaderImage		= 'url("images/image.gif")';
$itemHeaderBackGround	= $itemHeaderSolid; # pick background from: $itemHeaderSolid, $itemHeaderImage or $itemHeaderGradient
$headerMessageColor     ='#FFCC00';

# ------------------------------------------------------------------
# Item sections within list
# ------------------------------------------------------------------
$itemListBase					= '#eff3f8';
$itemListFrom					= '#eff3f8';
$itemListTo						= '#eff3f8';
$itemListBorder					= '1px solid #4A4945';
$itemListColor					= '#000000';
$itemListGradient				= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolid					= '#eff3f8';
$itemListImage					= 'url("images/fools_gold_row.gif")';
$itemListBackGround				= $itemListImage; # pick background from: $itemListSolid, $itemListImage or $itemListGradient
$itemListColorHover				= '#000000';
$itemListBorderHover			= '1px solid #4A4945';
$itemListGradientHover			= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidHover				= '#F6F4D0';
$itemListImageHover				= 'url("images/fools_gold_row.gif")';
$itemListBackGroundHover		= $itemListSolidHover; # pick background from: $itemListSolidHover, $itemListImageHover or $itemListGradientHover

$itemListBaseOdd				= '#eff3f8';
$itemListFromOdd				= '#eff3f8';
$itemListToOdd					= '#eff3f8';
$itemListBorderOdd				= '1px solid #4A4945';
$itemListColorOdd				= '#000000';
$itemListGradientOdd			= "-moz-linear-gradient(100% 100% 90deg, $itemListToOdd, $itemListFromOdd); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromOdd), to($itemListToOdd)); background: -ms-linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background: -o-linear-gradient(top,  $itemListFromOdd 0%,$itemListToOdd 100%); background: linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background-color: $itemListBaseOdd;";
$itemListSolidOdd				= '#000000';
$itemListImageOdd				= 'url("images/fools_gold_row.gif")';
$itemListBackGroundOdd			= $itemListImageOdd; # pick background from: $itemListSolidOdd, $itemListImageOdd or $itemListGradientOdd
$itemListColorOddHover			= '#000000';
$itemListBorderOddHover			= '1px solid #4A4945';
$itemListGradientOddHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidOddHover			= '#F6F4D0';
$itemListImageOddHover			= 'url("images/fools_gold_row.gif")';
$itemListBackGroundOddHover		= $itemListSolidOddHover; # pick background from: $itemListSolidOddHover, $itemListImageOddHover or $itemListGradientOddHover

$itemListBaseEven				= '#f9f9f9';
$itemListFromEven				= '#f9f9f9';
$itemListToEven					= '#f9f9f9';
$itemListBorderEven				= '1px solid #4A4945';
$itemListColorEven				= '#000000';
$itemListGradientEven			= "-moz-linear-gradient(100% 100% 90deg, $itemListToEven, $itemListFromEven); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromEven), to($itemListToEven)); background: -ms-linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background: -o-linear-gradient(top,  $itemListFromEven 0%,$itemListToEven 100%); background: linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background-color: $itemListBaseEven;";
$itemListSolidEven				= '#000000';
$itemListImageEven				= 'url("images/fools_gold_row.gif")';
$itemListBackGroundEven			= $itemListImageEven; # pick background from: $itemListSolidEven, $itemListImageEven or $itemListGradientEven
$itemListColorEvenHover			= '#000000';
$itemListBorderEvenHover		= '1px solid #4A4945';
$itemListGradientEvenHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidEvenHover			= '#F6F4D0';
$itemListImageEvenHover			= 'url("images/fools_gold_row.gif")';
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
$noticeBorder		= '1px solid #4A4945';
$noticeColor		= '#4c5d77';

# ------------------------------------------------------------------
# Alternate Backgrounds
# ------------------------------------------------------------------
$alt1SectionBase		= '#fcd27f';
$alt1SectionFrom		= '#e8ac38';
$alt1SectionTo			= '#fcd27f';
$alt1SectionBorder		= '1px solid #4A4945';
$alt1SectionColor		= '#000000';
$alt1SectionHover		= '1px solid #FACE77';
$alt1SectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $alt1SectionTo, $alt1SectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($alt1SectionFrom), to($alt1SectionTo));background: -ms-linear-gradient(top, $alt1SectionFrom 0%,$alt1SectionTo 100%); background: -o-linear-gradient(top,  $alt1SectionFrom 0%,$alt1SectionTo 100%); background: linear-gradient(top, $alt1SectionFrom 0%,$alt1SectionTo 100%); background-color: $alt1SectionBase;";
$alt1SectionSolid		= '#f9fbfc';
$alt1SectionImage		= 'url("images/image.gif")';
$alt1SectionBackGround	= $alt1SectionGradient; # pick background from: $alt1SectionSolid, $alt1SectionImage or $alt1SectionGradient

$alt2SectionBase		= '#fcd27f';
$alt2SectionFrom		= '#e8ac38';
$alt2SectionTo			= '#fcd27f';
$alt2SectionBorder		= '1px solid #4A4945';
$alt2SectionColor		= '#B07600';
$alt2SectionHover		= '#211f1e';
$alt2SectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $alt2SectionTo, $alt2SectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($alt2SectionFrom), to($alt2SectionTo)); background: -ms-linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background: -o-linear-gradient(top,  $alt2SectionFrom 0%,$alt2SectionTo 100%); background: linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background-color: $alt2SectionBase;";
$alt2SectionSolid		= '#FDD78D';
$alt2SectionImage		= 'url("images/image.gif")';
$alt2SectionBackGround	= $alt2SectionSolid; # pick background from: $alt2SectionSolid, $alt2SectionImage or $alt2SectionGradient

# ------------------------------------------------------------------
# Alternate color variations
# ------------------------------------------------------------------
$alt1BackGround		= '#211f1e';
$alt1Border			= '1px solid #FCD27F';
$alt1Color			= '#FCD27F';

$alt2BackGround		= '#e8f0f0';
$alt2Border			= '1px solid #4A4945';
$alt2Color			= '#000000';

$alt3BackGround		= '#FDD78D';
$alt3Border			= '1px solid #4A4945';
$alt3Color			= '#B07600';

$alt4BackGround		= '#FDD78D';
$alt4Border			= '1px solid #4A4945';
$alt4Color			= '#000000';

$alt5BackGround		= $itemHeaderBackGround;
$alt5Border			= '1px solid #FCC149';
$alt5Color			= '#B07600';

$alt6BackGround		= '#e8f0f0';
$alt6Border			= 'none';
$alt6Color			= '#7788aa';

# ------------------------------------------------------------------
# form control element backgrounds
# ------------------------------------------------------------------
$controlBackGround		= '#FCD27F';
$controlBorder			= '1px solid #EAEAEA';
$controlColor			= '#B07600';
$controlHeight			= '25px';
$linkButtonHeight		= '21px';
$controlLineHeight		= '1.6em';

$controlBackGroundHover	= '#FCD27F';
$controlBoxShadowHover  = '0 1px 3px rgba(0, 0, 0, 0.1) inset, 0 0 3px #FCC149';
$controlBorderHover		= '1px solid #FCC149';
$controlColorHover		= '#B07600';


# ------------------------------------------------------------------
# profile tab/menu element backgrounds
# ------------------------------------------------------------------
$profileBackGround		= $alt1SectionBackGround;
$profileBorder			= '1px solid #FCC149';
$profileColor			= '#000000';
$profileHeight			= '23px';

$profileBackGroundHover	= '#fafafa';
$profileBorderHover		= '1px solid #FCC149';
$profileColorHover		= '#000000';

$profileBackGroundCur	= '#fafafa';
$profileBorderCur		= '1px solid #FCC149';
$profileColorCur		= '#B07600';

$profileBackGroundAlt	= $alt1SectionBackGround;

$profileTabsRadius      ='-webkit-border-radius: 5px 5px 0 0;border-radius: 5px 5px 0 0;';

# ------------------------------------------------------------------
# Post Content
# ------------------------------------------------------------------
$postBackGround			= '#f6f4dd';
$postBorder				= '1px solid #4A4945';
$postColor				= '#000000';
$postBackGroundOdd		= '#f6f4dd';
$postBorderOdd			= '1px solid #4A4945';
$postColorOdd			= '#000000';
$postBackGroundEven		= '#f6f4dd';
$postBorderEven			= '1px solid #4A4945';
$postColorEven			= '#000000';

$userBackGround			= '#fcd27f';
$userBorder				= $itemListBorder;
$userColor				= $itemListColor;
$userBackGroundOdd		= '#fcd27f';
$userBorderOdd			= $itemListBorder;
$userColorOdd			= $itemListColor;
$userBackGroundEven		= '#fcd27f';
$userBorderEven			= $itemListBorder;
$userColorEven			= $itemListColor;

$postPadding			= '2px';
$postMargin				= '2px 2px 5px 2px';
$postBackRadius			= '-webkit-border-radius: 0px 5px 5px 0px; border-radius: 0px 5px 5px 0px;';

# ------------------------------------------------------------------
# Standard Links
# ------------------------------------------------------------------
$linkColor				= '#b07600';
$linkHover				= '#d1900b';
$linkDecoration			= 'none';

$alt1LinkColor			= '#302f2f';
$alt1LinkHover			= '#ff3300';
$alt1LinkDecoration		= 'none';

$alt2LinkColor			= '#302F2F';
$alt2LinkHover			= '#ff3300';
$alt2LinkDecoration		= 'none';

$alt3LinkColor			= '#FFCC00';
$alt3LinkHover			= '#FFCC00';
$alt3LinkDecoration		= 'none';

$alt4LinkColor			= '#000000';
$alt4LinkHover			= '1px solid #FACE77';
$alt4LinkDecoration		= 'none';

$alt5LinkColor			= '#B07600';
$alt5LinkHover			= '#d1900b';
$alt5LinkDecoration		= 'none';

$alt6LinkColor			= '#B07600';
$alt6LinkHover			= '#d1900b';
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
$spQuickLinksTopichover        ='#FFFFFF';
$spQuickLinksTopicColor        ='#B07600';

?>