<?php
/**
 * @version   $Id: userlist.php 21622 2014-06-19 11:16:14Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

?>

<div style="margin: 0 auto;">
    <div>
        <div style="float:left;clear:none;">
            <?php echo $that->searchbox; ?>
        </div>
        <div style="float:right;clear:none;">
            <?php echo $that->roleselect; ?>
        </div>
    </div>
    <div style="clear:both;"></div>

	<table cellspacing="0" class="wp-list-table widefat fixed posts content-table">
        <thead>
	        <tr>
	            <th align="left">
	                <span>Name</span>
	                <a class="arrow_up" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'display_name', 'order' => 'ASC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_up.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	                <a class="arrow_down" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'display_name', 'order' => 'DESC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_down.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	            </th>

	            <th align="left">
	                <span>Email</span>
	                <a class="arrow_up" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'email', 'order' => 'ASC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_up.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	                <a class="arrow_down" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'email', 'order' => 'DESC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_down.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	            </th>

	            <th align="left">
	                <span>User Role</span>
	            </th>

	            <th align="left">
	                <span>Post Count</span>
	                <a class="arrow_up" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'post_count', 'order' => 'ASC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_up.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	                <a class="arrow_down" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'post_count', 'order' => 'DESC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_down.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	            </th>

	            <th align="left">
	                <span>Registered Date</span>
	                <a class="arrow_up" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'registered', 'order' => 'ASC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_up.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	                <a class="arrow_down" href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'registered', 'order' => 'DESC'));?>">
		                <img src="<?php echo $that->images_path;?>bullet_arrow_down.png" width="16" height="16" alt="" title="" style="vertical-align:middle;" />
	                </a>
	            </th>
	        </tr>
        </thead>
        <tbody>
	        <?php $j = 0; foreach ($that->users as $user) : $j++; ?>
	        <tr class="<?php echo (($j % 2 == 0) ? 'alternate ' : '');?>iedit">
	            <td>
	                <a class="user-link" href="#" rel="<?php echo $user->user_url?>" title="<?php echo $user->display_name;?>" pid="<?php echo $user->ID?>" ptype="article" onclick="if (window.parent) window.parent.jSelectUser_Sprocket('<?php echo $user->ID; ?>', '<?php echo addslashes($user->display_name); ?>');">
	                    <span><?php echo $user->display_name; ?></span>
	                </a>
	            </td>
	            <td>
	                <?php if ($user->user_email) : ?>
	                    <span><?php echo $user->user_email;?></span>
	                <?php else: ?>
	                    <span>Not Available</span>
	                <?php endif;?>
	            </td>
	            <td>
	                <a class="thickbox" href="<?php echo RokCommon_URL::updateParams($that->link, array('role' => $user->role));?>">
	                    <span><?php echo ucfirst($user->role)?></span>
	                </a>
	            </td>
	            <td>
	                <span><?php echo $user->postcount; ?></span>
	            </td>
	            <td>
	                <span><?php echo $user->user_registered; ?></span>
	            </td>
	        </tr>
            <?php endforeach; ?>
        </tbody>
	</table>

	<?php if ($that->total_pages > 1) { ?>
		<div class="tablenav bottom">
			<div class="tablenav-pages">
				<span class="displaying-num"><?php echo $that->total_users;?> users</span>
                <span class="pagination-links">
                    <?php if ($that->paged != 1): ?>
	                    <a class="first-page" title="Go to the first page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => 1))?>">&laquo;</a>
	                    <a class="prev-page" title="Go to the previous page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $that->paged - 1))?>">&lsaquo;</a>
                    <?php endif;?>
	                <span class="paging-input">
                        <span class="current-page">
                            <?php echo $that->paged; ?>
                        </span>
                        of
                        <span class="total-pages">
                            <?php echo $that->total_pages;?>
                        </span>
                    </span>
	                <?php if ($that->paged != $that->total_pages): ?>
		                <a class="next-page" title="Go to the next page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $that->paged + 1))?>">&rsaquo;</a>
		                <a class="last-page" title="Go to the last page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $that->total_pages))?>">&raquo;</a>
	                <?php endif;?>
                </span>
			</div>
		</div>
	<?php } ;?>

</div>
<div style="clear:both;"></div>