<?php

# --------------------------------------------------------------------------------------
#
#	Simple:Press Template Color Attribute File
#	Theme		:	default
#	Color		:	Late Summer
#	Author		:	Simple:Press
#
# --------------------------------------------------------------------------------------

# ------------------------------------------------------------------
# The overall SP forum container
# ------------------------------------------------------------------
$mainBackGroundBase		= '#f6f8f9';
$mainBackGroundFrom		= '#f6f8f9';
$mainBackGroundTo		= '#f6f8f9';
$mainBackGroundBorder	= '1px solid #d8d8c2';
$mainBackGroundColor	= '#444444';
$mainBackGroundHover	= '1px solid #d8d8c2';
$mainBackGroundGradient	= "-moz-linear-gradient(100% 100% 90deg, $mainBackGroundTo, $mainBackGroundFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($mainBackGroundFrom), to($mainBackGroundTo)); background: -ms-linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: -o-linear-gradient(top,  $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background-color: $mainBackGroundBase;";
$mainBackGroundSolid	= '#F0F0D8';
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
$listSectionColor		= '#444444';
$listSectionHover		= 'none';
$listSectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $listSectionTo, $listSectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($listSectionFrom), to($listSectionTo)); background: -ms-linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background: -o-linear-gradient(top,  $listSectionFrom 0%,$listSectionTo 100%); background: linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background-color: $listSectionBase;";
$listSectionSolid		= '#F0F0D8';
$listSectionImage		= 'url("images/image.gif")';
$listSectionBackGround	= $listSectionSolid; # pick background from: $listSectionSolid, $listSectionImage or $listSectionGradient

# ------------------------------------------------------------------
# Header sections within lists
# ------------------------------------------------------------------
$itemHeaderBase			= '#D8D8C0';
$itemHeaderFrom			= '#D8C0A8';
$itemHeaderTo			= '#D8D8C0';
$itemHeaderBorder		= '1px solid #c2ac97';
$itemHeaderColor		= '#444444';
$itemHeaderHover		= '1px solid #c2ac97';
$itemHeaderGradient		= "-moz-linear-gradient(100% 100% 90deg, $itemHeaderTo, $itemHeaderFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemHeaderFrom), to($itemHeaderTo)); background: -ms-linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background: -o-linear-gradient(top,  $itemHeaderFrom 0%,$itemHeaderTo 100%); background: linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background-color: $itemHeaderBase;";
$itemHeaderSolid		= '#BEDB89';
$itemHeaderImage		= 'url("images/image.gif")';
$itemHeaderBackGround	= $itemHeaderGradient; # pick background from: $itemHeaderSolid, $itemHeaderImage or $itemHeaderGradient
$headerMessageColor     ='#000000';

# ------------------------------------------------------------------
# Item sections within list
# ------------------------------------------------------------------
$itemListBase					= '#F0D8C0';
$itemListFrom					= '#F0C0A8';
$itemListTo						= '#F0D8C0';
$itemListBorder					= '1px solid #d8c2ac';
$itemListColor					= '#444444';
$itemListGradient				= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolid					= '#ECF3E3';
$itemListImage					= 'url("images/image.gif")';
$itemListBackGround				= $itemListGradient; # pick background from: $itemListSolid, $itemListImage or $itemListGradient
$itemListColorHover				= '#444444';
$itemListBorderHover			= '1px solid #d8c2ac';
$itemListGradientHover			= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidHover				= '#ECF3E3';
$itemListImageHover				= 'url("images/image.gif")';
$itemListBackGroundHover		= $itemListGradient; # pick background from: $itemListSolidHover, $itemListImageHover or $itemListGradientHover

$itemListBaseOdd				= '#F0D8C0';
$itemListFromOdd				= '#F0C0A8';
$itemListToOdd					= '#F0D8C0';
$itemListBorderOdd				= '1px solid #d8ac97';
$itemListColorOdd				= '#444444';
$itemListGradientOdd			= "-moz-linear-gradient(100% 100% 90deg, $itemListToOdd, $itemListFromOdd); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromOdd), to($itemListToOdd)); background: -ms-linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background: -o-linear-gradient(top,  $itemListFromOdd 0%,$itemListToOdd 100%); background: linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background-color: $itemListBaseOdd;";
$itemListSolidOdd				= '#ECF3E3';
$itemListImageOdd				= 'url("images/image.gif")';
$itemListBackGroundOdd			= $itemListGradientOdd; # pick background from: $itemListSolidOdd, $itemListImageOdd or $itemListGradientOdd
$itemListColorOddHover			= '#444444';
$itemListBorderOddHover			= '1px solid #d8ac97';
$itemListGradientOddHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidOddHover			= '#ECF3E3';
$itemListImageOddHover			= 'url("images/image.gif")';
$itemListBackGroundOddHover		= $itemListGradientOdd; # pick background from: $itemListSolidOddHover, $itemListImageOddHover or $itemListGradientOddHover

$itemListBaseEven				= '#F0C0A8';
$itemListFromEven				= '#F0D8C0';
$itemListToEven					= '#F0C0A8';
$itemListBorderEven				= '1px solid #d8ac97';
$itemListColorEven				= '#444444';
$itemListGradientEven			= "-moz-linear-gradient(100% 100% 90deg, $itemListToEven, $itemListFromEven); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromEven), to($itemListToEven)); background: -ms-linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background: -o-linear-gradient(top,  $itemListFromEven 0%,$itemListToEven 100%); background: linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background-color: $itemListBaseEven;";
$itemListSolidEven				= '#F6F6F6';
$itemListImageEven				= 'url("images/image.gif")';
$itemListBackGroundEven			= $itemListGradientEven; # pick background from: $itemListSolidEven, $itemListImageEven or $itemListGradientEven
$itemListColorEvenHover			= '#444444';
$itemListBorderEvenHover		= '1px solid #d8ac97';
$itemListGradientEvenHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidEvenHover			= '#F6F6F6';
$itemListImageEvenHover			= 'url("images/image.gif")';
$itemListBackGroundEvenHover	= $itemListGradientEven; # pick background from: $itemListSolidEvenHover, $itemListImageEvenHover or $itemListGradientEvenHover

# ------------------------------------------------------------------
# Success / Fail
# ------------------------------------------------------------------
$successBackGround	= '#c6f5c7';
$successBorder		= '1px solid #888888';
$successColor		= '#444444';

$failBackGround		= '#f7a3a3';
$failBorder			= '1px solid #888888';
$failColor			= '#444444';

$noticeBackGround	= '#f6f8f9';
$noticeBorder		= '1px solid #d8d8c2';
$noticeColor		= '#444444';

# ------------------------------------------------------------------
# Alternate Backgrounds
# ------------------------------------------------------------------
$alt1SectionBase		= '#F0F0D8';
$alt1SectionFrom		= '#D8D8C0';
$alt1SectionTo			= '#F0F0D8';
$alt1SectionBorder		= '1px solid #c2c2ac';
$alt1SectionColor		= '#000000';
$alt1SectionHover		= '1px solid #d8d8c2';
$alt1SectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $alt1SectionTo, $alt1SectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($alt1SectionFrom), to($alt1SectionTo));background: -ms-linear-gradient(top, $alt1SectionFrom 0%,$alt1SectionTo 100%); background: -o-linear-gradient(top,  $alt1SectionFrom 0%,$alt1SectionTo 100%); background: linear-gradient(top, $alt1SectionFrom 0%,$alt1SectionTo 100%); background-color: $alt1SectionBase;";
$alt1SectionSolid		= '#F0F0C0';
$alt1SectionImage		= 'url("images/image.gif")';
$alt1SectionBackGround	= $alt1SectionGradient; # pick background from: $alt1SectionSolid, $alt1SectionImage or $alt1SectionGradient

$alt2SectionBase		= '#fbfbfb';
$alt2SectionFrom		= '#fbfbfb';
$alt2SectionTo			= '#c3c3c3';
$alt2SectionBorder		= '1px solid #c2c2ac';
$alt2SectionColor		= '#444444';
$alt2SectionHover		= '#D8D8C0';
$alt2SectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $alt2SectionTo, $alt2SectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($alt2SectionFrom), to($alt2SectionTo)); background: -ms-linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background: -o-linear-gradient(top,  $alt2SectionFrom 0%,$alt2SectionTo 100%); background: linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background-color: $alt2SectionBase;";
$alt2SectionSolid		= '#F0F0D8';
$alt2SectionImage		= 'url("images/image.gif")';
$alt2SectionBackGround	= $alt2SectionSolid; # pick background from: $alt2SectionSolid, $alt2SectionImage or $alt2SectionGradient

# ------------------------------------------------------------------
# Alternate color variations
# ------------------------------------------------------------------
$alt1BackGround		= '#D8D8C0';
$alt1Border			= '1px solid #dddddd';
$alt1Color			= '#444444';

$alt2BackGround		= '#e8f0f0';
$alt2Border			= 'none';
$alt2Color			= '#A87C67';

$alt3BackGround		= "-moz-linear-gradient(100% 100% 90deg, $itemListFrom, $itemHeaderFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemHeaderFrom), to($itemListFrom)); background: -ms-linear-gradient(top, $itemHeaderFrom 0%,$itemListFrom 100%); background: -o-linear-gradient(top,  $itemHeaderFrom 0%,$itemListFrom 100%); background: linear-gradient(top, $itemHeaderFrom 0%,$itemListFrom 100%); background-color: $itemHeaderFrom;";
$alt3Border			= '1px solid #c2c2ac';
$alt3Color			= '#444444';

$alt4BackGround		= '#F0C0A8';
$alt4Border			= '1px solid #d8ac97';
$alt4Color			= '#444444';

$alt5BackGround		= $itemListBackGroundOdd;
$alt5Border			= '1px solid #d4dacc';
$alt5Color			= '#444444';

$alt6BackGround		= '#e8f0f0';
$alt6Border			= 'none';
$alt6Color			= '#7788aa';

# ------------------------------------------------------------------
# form control element backgrounds
# ------------------------------------------------------------------
$controlBackGround		= '#ffffff';
$controlBorder			= '1px solid #c2c2ac';
$controlColor			= '#333333';
$controlHeight			= '25px';
$linkButtonHeight		= '21px';
$controlLineHeight		= '1.6em';

$controlBackGroundHover	= '#F6F6F6';
$controlBoxShadowHover  = '0 1px 3px rgba(0, 0, 0, 0.1) inset, 0 0 3px #d8d8c2';
$controlBorderHover		= '1px solid #d8d8c2';
$controlColorHover		= '#444444';

# ------------------------------------------------------------------
# profile tab/menu element backgrounds
# ------------------------------------------------------------------
$profileBackGround		= $alt1SectionBackGround;
$profileBorder			= '1px solid #90C090';
$profileColor			= '#444444';
$profileHeight			= '23px';

$profileBackGroundHover	= $mainBackGround;
$profileBorderHover		= '1px solid #d8d8c2';
$profileColorHover		= '#444444';

$profileBackGroundCur	= $itemHeaderBackGround;
$profileBorderCur		= '1px solid #d5d5d5';
$profileColorCur		= '#444444';

$profileBackGroundAlt	= '#D8C0A8';

$profileTabsRadius      ='-webkit-border-radius: 5px 5px 0 0;border-radius: 5px 5px 0 0;';

# ------------------------------------------------------------------
# Post Content
# ------------------------------------------------------------------
$postBackGround			= '#f0f0d8';
$postBorder				= '1px solid #d8d8c2';
$postColor				= '#444444';
$postBackGroundOdd		= '#f0f0d8';
$postBorderOdd			= '1px solid #d8d8c2';
$postColorOdd			= '#444444';
$postBackGroundEven		= '#f0f0d8';
$postBorderEven			= '1px solid #d8d8c2';
$postColorEven			= '#444444';

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
$postMargin				= '2px 2px 5px 2px';
$postBackRadius			= '-webkit-border-radius: 0px 5px 5px 0px; border-radius: 0px 5px 5px 0px;';

# ------------------------------------------------------------------
# Standard Links
# ------------------------------------------------------------------
$linkColor				= '#a87C67';
$linkHover				= '#d8ac97';
$linkDecoration			= 'none';

$alt1LinkColor			= '#444444';
$alt1LinkHover			= '#444444';
$alt1LinkDecoration		= 'none';

$alt2LinkColor			= '#8Ba55B';
$alt2LinkHover			= '#8Ba55B';
$alt2LinkDecoration		= 'none';

$alt3LinkColor			= '#a87C67';
$alt3LinkHover			= '#d8ac97';
$alt3LinkDecoration		= 'none';

$alt4LinkColor			= '#444444';
$alt4LinkHover			= '1px solid #d8d8c2';
$alt4LinkDecoration		= 'none';

$alt5LinkColor			= '#ffff90';
$alt5LinkHover			= '#F0F0D8';
$alt5LinkDecoration		= 'none';

$alt6LinkColor			= '#444444';
$alt6LinkHover			= '#444444';
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
$spQuickLinksTopicColor        ='#000000';

?>