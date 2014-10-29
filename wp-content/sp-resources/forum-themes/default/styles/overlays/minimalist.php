<?php

# --------------------------------------------------------------------------------------
#
#	Simple:Press Template Color Attribute File
#	Theme		:	default
#	Color		:	Minimalist
#	Author		:	Simple:Press
#
# --------------------------------------------------------------------------------------

# ------------------------------------------------------------------
# special overrides
# ------------------------------------------------------------------
echo '
#spMainContainer .spPostSection {
    border-left: 1px solid #eeeeee !important;
}
.ui-dialog .ui-dialog-content p {
    text-align: center;
}
';

# ------------------------------------------------------------------
# The overall SP forum container
# ------------------------------------------------------------------
$mainBackGroundBase		= '#ffffff';
$mainBackGroundFrom		= '#ffffff';
$mainBackGroundTo		= '#ffffff';
$mainBackGroundBorder	= 'none';
$mainBackGroundColor	= '#000000';
$mainBackGroundHover	= '1px solid #abb0b5';
$mainBackGroundGradient	= "-moz-linear-gradient(100% 100% 90deg, $mainBackGroundTo, $mainBackGroundFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($mainBackGroundFrom), to($mainBackGroundTo)); background: -ms-linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: -o-linear-gradient(top,  $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background: linear-gradient(top, $mainBackGroundFrom 0%,$mainBackGroundTo 100%); background-color: $mainBackGroundBase;";
$mainBackGroundSolid	= '#ffffff';
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
# The over container of forum lists
# ------------------------------------------------------------------
$listSectionBase		= '#ffffff';
$listSectionFrom		= '#ffffff';
$listSectionTo			= '#ffffff';
$listSectionBorder		= 'none';
$listSectionColor		= '#000000';
$listSectionHover		= 'none';
$listSectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $listSectionTo, $listSectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($listSectionFrom), to($listSectionTo)); background: -ms-linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background: -o-linear-gradient(top,  $listSectionFrom 0%,$listSectionTo 100%); background: linear-gradient(top, $listSectionFrom 0%,$listSectionTo 100%); background-color: $listSectionBase;";
$listSectionSolid		= '#ffffff';
$listSectionImage		= 'url("images/image.gif")';
$listSectionBackGround	= $listSectionSolid; # pick background from: $listSectionSolid, $listSectionImage or $listSectionGradient

# ------------------------------------------------------------------
# Header sections within lists
# ------------------------------------------------------------------
$itemHeaderBase			= '#eeeeee';
$itemHeaderFrom			= '#eeeeee';
$itemHeaderTo			= '#eeeeee';
$itemHeaderBorder		= 'none';
$itemHeaderColor		= '#111111';
$itemHeaderHover		= 'none';
$itemHeaderGradient		= "-moz-linear-gradient(100% 100% 90deg, $itemHeaderTo, $itemHeaderFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemHeaderFrom), to($itemHeaderTo)); background: -ms-linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background: -o-linear-gradient(top,  $itemHeaderFrom 0%,$itemHeaderTo 100%); background: linear-gradient(top, $itemHeaderFrom 0%,$itemHeaderTo 100%); background-color: $itemHeaderBase;";
$itemHeaderSolid		= '#eeeeee';
$itemHeaderImage		= 'url("images/image.gif")';
$itemHeaderBackGround	= $itemHeaderSolid; # pick background from: $itemHeaderSolid, $itemHeaderImage or $itemHeaderGradient
$headerMessageColor     ='#000000';

# ------------------------------------------------------------------
# Item sections within list
# ------------------------------------------------------------------
$itemListBase					= '#ffffff';
$itemListFrom					= '#ffffff';
$itemListTo						= '#ffffff';
$itemListBorder					= 'none';
$itemListColor					= '#000000';
$itemListGradient				= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolid					= '#ffffff';
$itemListImage					= 'url("images/image.gif")';
$itemListBackGround				= $itemListSolid; # pick background from: $itemListSolid, $itemListImage or $itemListGradient
$itemListColorHover				= '#000000';
$itemListBorderHover			= 'none';
$itemListGradientHover			= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidHover				= '#ffffff';
$itemListImageHover				= 'url("images/image.gif")';
$itemListBackGroundHover		= $itemListSolidHover; # pick background from: $itemListSolidHover, $itemListImageHover or $itemListGradientHover

$itemListBaseOdd				= '#ffffff';
$itemListFromOdd				= '#ffffff';
$itemListToOdd					= '#ffffff';
$itemListBorderOdd				= 'none';
$itemListColorOdd				= '#000000';
$itemListHoverOdd				= '1px solid #abb0b5';
$itemListGradientOdd			= "-moz-linear-gradient(100% 100% 90deg, $itemListToOdd, $itemListFromOdd); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromOdd), to($itemListToOdd)); background: -ms-linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background: -o-linear-gradient(top,  $itemListFromOdd 0%,$itemListToOdd 100%); background: linear-gradient(top, $itemListFromOdd 0%,$itemListToOdd 100%); background-color: $itemListBaseOdd;";
$itemListSolidOdd				= '#ffffff';
$itemListImageOdd				= 'url("images/image.gif")';
$itemListBackGroundOdd			= $itemListSolidOdd; # pick background from: $itemListSolidOdd, $itemListImageOdd or $itemListGradientOdd
$itemListColorOddHover			= '#000000';
$itemListBorderOddHover			= 'none';
$itemListGradientOddHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidOddHover			= '#ffffff';
$itemListImageOddHover			= 'url("images/image.gif")';
$itemListBackGroundOddHover		= $itemListSolidOddHover; # pick background from: $itemListSolidOddHover, $itemListImageOddHover or $itemListGradientOddHover

$itemListBaseEven				= '#ffffff';
$itemListFromEven				= '#ffffff';
$itemListToEven					= '#ffffff';
$itemListBorderEven				= 'none';
$itemListColorEven				= '#000000';
$itemListGradientEven			= "-moz-linear-gradient(100% 100% 90deg, $itemListToEven, $itemListFromEven); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFromEven), to($itemListToEven)); background: -ms-linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background: -o-linear-gradient(top,  $itemListFromEven 0%,$itemListToEven 100%); background: linear-gradient(top, $itemListFromEven 0%,$itemListToEven 100%); background-color: $itemListBaseEven;";
$itemListSolidEven				= '#ffffff';
$itemListImageEven				= 'url("images/image.gif")';
$itemListBackGroundEven			= $itemListSolidEven; # pick background from: $itemListSolidEven, $itemListImageEven or $itemListGradientEven
$itemListColorEvenHover			= '#4c5d77';
$itemListBorderEvenHover		= 'none';
$itemListGradientEvenHover		= "-moz-linear-gradient(100% 100% 90deg, $itemListTo, $itemListFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($itemListFrom), to($itemListTo)); background: -ms-linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background: -o-linear-gradient(top,  $itemListFrom 0%,$itemListTo 100%); background: linear-gradient(top, $itemListFrom 0%,$itemListTo 100%); background-color: $itemListBase;";
$itemListSolidEvenHover			= '#ffffff';
$itemListImageEvenHover			= 'url("images/image.gif")';
$itemListBackGroundEvenHover	= $itemListSolidEvenHover; # pick background from: $itemListSolidEvenHover, $itemListImageEvenHover or $itemListGradientEvenHover

# ------------------------------------------------------------------
# Success / Fail
# ------------------------------------------------------------------
$successBackGround	= '#c6f5c7';
$successBorder		= '1px solid #c0c0c0';
$successColor		= '#000000';

$failBackGround		= '#f7a3a3';
$failBorder			= '1px solid #c0c0c0';
$failColor			= '#000000';

$noticeBackGround	= '#ffffff';
$noticeBorder		= '1px solid #c0c0c0';
$noticeColor		= '#000000';

# ------------------------------------------------------------------
# Alternate Backgrounds
# ------------------------------------------------------------------
$alt1SectionBase		= '#fbfbfb';
$alt1SectionFrom		= '#FFFFFF';
$alt1SectionTo			= '#eeeeee';
$alt1SectionBorder		= '1px solid #c0c0c0';
$alt1SectionColor		= '#333333';
$alt1SectionHover		= '1px solid #c0c0c0';
$alt1SectionGradient	= "#eeeeee";
$alt1SectionSolid		= '#fbfbfb';
$alt1SectionImage		= 'url("images/image.gif")';
$alt1SectionBackGround	= $alt1SectionFrom; # pick background from: $alt1SectionSolid, $alt1SectionImage or $alt1SectionGradient
$alt1SectionBorder      = '1px solid #dddddd';

$alt2SectionBase		= '#fbfbfb';
$alt2SectionFrom		= '#fbfbfb';
$alt2SectionTo			= '#c3c3c3';
$alt2SectionBorder		= '1px solid #c0c0c0';
$alt2SectionColor		= '#000000';
$alt2SectionHover		= '#567cc3';
$alt2SectionGradient	= "-moz-linear-gradient(100% 100% 90deg, $alt2SectionTo, $alt2SectionFrom); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from($alt2SectionFrom), to($alt2SectionTo)); background: -ms-linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background: -o-linear-gradient(top,  $alt2SectionFrom 0%,$alt2SectionTo 100%); background: linear-gradient(top, $alt2SectionFrom 0%,$alt2SectionTo 100%); background-color: $alt2SectionBase;";
$alt2SectionSolid		= '#ffffff';
$alt2SectionImage		= 'url("images/image.gif")';
$alt2SectionBackGround	= $alt2SectionSolid; # pick background from: $alt2SectionSolid, $alt2SectionImage or $alt2SectionGradient

# ------------------------------------------------------------------
# Alternate color variations
# ------------------------------------------------------------------
$alt1BackGround		= '#eeeeee';
$alt1Border			= '1px solid #c0c0c0';
$alt1Color			= '#555555';

$alt2BackGround		= '#FFFFFF';
$alt2Border			= '1px solid #c0c0c0';
$alt2Color			= '#555555';

$alt3BackGround		= '#ffffff';
$alt3Border			= 'none';
$alt3Color			= '#000000';

$alt4BackGround		= '#ffffff';
$alt4Border			= '1px solid #c0c0c0';
$alt4Color			= '#000000';

$alt5BackGround		= '#ffffff';
$alt5Border			= 'none';
$alt5Color			= '#333333';

$alt6BackGround		= '#ffffff';
$alt6Border			= 'none';
$alt6Color			= '#555555';

# ------------------------------------------------------------------
# form control element backgrounds
# ------------------------------------------------------------------
$controlBackGround		= '#ffffff';
$controlBorder			= '1px solid #c0c0c0';
$controlColor			= '#333333';
$controlHeight			= '25px';
$linkButtonHeight		= '21px';
$controlLineHeight		= '1.6em';

$controlBackGroundHover	= '#ffffff';
$controlBoxShadowHover  = '0 1px 3px rgba(0, 0, 0, 0.1) inset, 0 0 3px #c0c0c0';
$controlBorderHover		= '1px solid #c0c0c0';
$controlColorHover		= '#000000';

# ------------------------------------------------------------------
# profile tab/menu element backgrounds
# ------------------------------------------------------------------
$profileBackGround		= '#FFFFFF';
$profileBorder			= '1px solid #ffffff';
$profileColor			= '#333333';
$profileHeight			= '23px';

$profileBackGroundHover	= '#ffffff';
$profileBorderHover		= '1px solid #c0c0c0';
$profileColorHover		= '#000000';

$profileBackGroundCur	= '#eeeeee';
$profileBorderCur		= '1px solid #c0c0c0';
$profileColorCur		= '#000000';

$profileBackGroundAlt	= '#FFFFFF';

$profileTabsRadius      ='-webkit-border-radius: 3px 3px 0 0;border-radius: 3px 3px 0 0;';

# ------------------------------------------------------------------
# Post Content
# ------------------------------------------------------------------
$postBackGround			= '#FFFFFF';
$postBorder				= '1px solid #c0c0c0';
$postColor				= '#000000';
$postBackGroundOdd		= '#ffffff';
$postBorderOdd			= '1px solid #c0c0c0';
$postColorOdd			= '#000000';
$postBackGroundEven		= '#FFFFFF';
$postBorderEven			= '1px solid #c0c0c0';
$postColorEven			= '#000000';

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
$postMargin				= '0 1px 5px 1px';
$postBackRadius			= '-webkit-border-radius: 0px 3px 3px 0px; border-radius: 0px 3px 3px 0px;';

# ------------------------------------------------------------------
# Standard Links
# ------------------------------------------------------------------
$linkColor				= '#333333';
$linkHover				= '#000000';
$linkDecoration			= 'none';

$alt1LinkColor			= '#333333';
$alt1LinkHover			= '#000000';
$alt1LinkDecoration		= 'none';

$alt2LinkColor			= '#333333';
$alt2LinkHover			= '#000000';
$alt2LinkDecoration		= 'none';

$alt3LinkColor			= '#555555';
$alt3LinkHover			= '#000000';
$alt3LinkDecoration		= 'none';

$alt4LinkColor			= '#333333';
$alt4LinkHover			= '1px solid #c0c0c0';
$alt4LinkDecoration		= 'none';

$alt5LinkColor			= '#333333';
$alt5LinkHover			= '#000000';
$alt5LinkDecoration		= 'none';

$alt6LinkColor			= '#333333';
$alt6LinkHover			= '#000000';
$alt6LinkDecoration		= 'none';

# ------------------------------------------------------------------
# Standard Radii
# ------------------------------------------------------------------
$smallRadius	= '-webkit-border-radius: 5px; border-radius: 3px;';
$largeRadius	= '-webkit-border-radius: 9px; border-radius: 5px;';

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
$spQuickLinksTopichover        ='#000000';
$spQuickLinksTopicColor        ='#555555';

?>