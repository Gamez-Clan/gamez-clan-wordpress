<?php
/**
 * @version   $Id: edit_article_info_cpt.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
?>

<h1 class="popover-title"><?php echo $article->title;?></h1>
<div class="article-info">
	<ul>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_ID')?></span>
			<span class="content"><?php echo $article->post_id;?></span>
		</li>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_STATUS')?></span>
			<span class="content"><?php
				switch($article->post_status) {
                    case  'draft' :
						$published = rc_e('DRAFT');
						$published .= ' <span class="red">&#9679;</span>';
						break;
					case 'publish':
                    case 'future':
                    case 'private':
						$published = rc_e('PUBLISHED');
						$published .= ' <span class="green">&#9679;</span>';
						break;
					case 'pending':
                    default:
						$published = rc_e('PENDING');
						$published .= ' <span class="red">&#9679;</span>';
						break;
				}
				echo $published;
			?></span>
		</li>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_ACCESS')?></span>
			<span class="content"><?php echo $article->post_title;?></span>
		</li>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_ALIAS')?></span>
			<span class="content"><?php echo $article->post_name;?></span>
		</li>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_CATEGORY')?></span>
			<span class="content"><?php echo $article->categories;?></span>
		</li>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_CREATED_BY')?></span>
			<span class="content"><?php echo $article->user_nicename;?></span>
		</li>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_CREATED_DATE')?></span>
			<span class="content"><?php echo $article->post_date;?></span>
		</li>
		<li>
			<span class="title"><?php rc_e('ROKSPROCKET_MODIFIED_DATE')?></span>
			<span class="content"><?php echo $article->post_modified;?></span>
		</li>
	</ul>
	<div class="statusbar">
		<a class="btn btn-primary" href="<?php echo $article->editUrl;?>" target="_blank">Edit</a>
	</div>
</div>
