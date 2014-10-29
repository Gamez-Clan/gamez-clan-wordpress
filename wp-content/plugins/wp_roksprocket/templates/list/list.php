<?php
/**
 * @version   $Id: list.php 21622 2014-06-19 11:16:14Z jakub $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

if($that->order == "DESC"){
    $order = "ASC";
} else {
    $order = "DESC";
}
?>

<script type="text/javascript">
    window.addEvent('domready', function () {
        new Tips(".rok-tips", {title:"data-tips"});
    });
    jQuery(document).ready(function ($) {
        $("#rok-tabs").tabs();
    });
</script>

<form id="roksprocket-filter" method="get" action="">
	<div class="page-header wrap">
	    <div id="icon-roksprocket" class="icon32"></div>
	    <h2>RokSprocket Items List <a href="<?php echo $that->edit_url;?>&id=0" class="add-new-h2">Add New</a></h2>
	</div>
	<div style="clear:both;"></div>
	<div class="page-body">
	    <div style="margin: 0 auto;">
	        <div class="tablenav top">

	            <div class="alignright actions" style="float:right">
	                <?php echo $that->searchbox; ?>
	            </div>
	            <div style="clear:both">

	                <div class="alignleft actions" style="clear:none; margin-right: 0px;">
	                    <?php echo $that->bulkselect; ?>
	                </div>

	                <div class="alignleft actions" style="clear:none">
	                    <?php echo $that->bulkbutton; ?>
	                </div>

	                <div class="alignleft actions" style="clear:none;  margin-right: 0px;">
	                    <?php echo $that->provider; ?>
	                </div>

	                <div class="alignleft actions" style="clear:none">
	                    <?php echo $that->clearbutton; ?>
	                </div>

	                <div class="alignright actions" style="clear:none">
	                    <div class="tablenav-pages">
	                        <span class="displaying-num"><?php echo $that->paged;?> items</span>
	                        <span class="pagination-links">
	                            <?php if ($that->paged != 1): ?>
	                            <a class="first-page" title="Go to the first page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => 1))?>">&laquo;</a>
	                            <a class="prev-page" title="Go to the previous page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $that->paged - 1))?>">&lsaquo;</a>
	                            <?php endif;?>
	                            <span class="paging-input">
	                                <input class="current-page" title="Current page" type="text" name="paged" value="<?php echo $that->paged;?>" size="1">
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
	            </div>
	        </div>
	        <div style="clear:both;"></div>

	        <table cellspacing="0" class="wp-list-table widefat fixed" style="margin: 0 auto;">
	            <thead>
					<tr>
						<th class="manage-column column-cb check-column">
							<span class="checkall"><input type="checkbox"/></span>
						</th>
						<th class="manage-column column-title <?php echo strtolower($order); ?> <?php echo ($that->orderby == 'title') ? 'sorted' : 'sortable'; ?>">
							<div class="sort<?php echo ($that->orderby == 'title') ? ' active' : ''; ?>">
								<a href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'title', 'order' => $order));?>" title="Order by Title">Title<span class="sorting-indicator"></span></a>
							</div>
						</th>
						<th class="manage-column column-provider">
							<span>Provider</span>
						</th>
						<th class="manage-column column-layout">
							<span>Layout</span>
						</th>
						<th class="manage-column column-modified <?php echo strtolower($order); ?> <?php echo ($that->orderby == 'modified') ? 'sorted' : 'sortable'; ?>">
							<div class="sort<?php echo ($that->orderby == 'modified') ? ' active' : ''; ?>">
								<a href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'modified', 'order' => $order));?>" title="Order by Modified Date">Last Modified<span class="sorting-indicator"></span></a>
							</div>
						</th>

						<th class="manage-column column-id <?php echo strtolower($order); ?> <?php echo ($that->orderby == 'id') ? 'sorted' : 'sortable'; ?>">
							<div class="sort<?php echo ($that->orderby == 'id') ? ' active' : ''; ?>">
								<a href="<?php echo RokCommon_URL::updateParams($that->link, array('orderby' => 'id', 'order' => $order));?>" title="Order by Id">Id<span class="sorting-indicator"></span></a>
							</div>
						</th>
					</tr>
	            </thead>

		        <tbody>

		            <?php $j = 0; foreach ($that->results as $results) : $j++; ?>

		            <tr class="<?php echo (($j % 2 == 0) ? 'alternate ' : '');?>iedit">
		                <th class="check-column">
		                    <div class="relative">
		                        <span class="selectid"><input type="checkbox" value="<?php echo $results->id; ?>"/></span>
		                    </div>
		                </th>
		                <td>
		                    <div class="relative">
		                        <strong>
		                            <a class="row-title" href="<?php echo $that->edit_url . '&id=' . $results->id; ?>" title="<?php echo $results->title;?>" pid="<?php echo $results->id; ?>">
		                                <span><?php echo $results->title;?></span>
		                            </a>
		                        </strong>
		                        <div class="row-actions">
		                            <span class="edit">
		                                <a class="edit-link" href="<?php echo $that->edit_url . '&id=' . $results->id; ?>" title="Edit">
		                                    <span>Edit</span>
		                                </a> |
		                            </span>
		                            <span class="delete">
		                                <a class="submitdelete" href="<?php echo $that->link . '&task=delete&id=' . $results->id; ?>" title="Delete" data-roksprocket-deleteid="<?php echo $results->id; ?>">
		                                    <span>Delete</span>
		                                </a>
		                            </span>
		                        </div>
		                    </div>
		                </td>
		                <td>
		                    <div class="relative">
		                        <div class="single-layout">
			                        <i data-dynamic="false" class="icon provider <?php echo strtolower($results->provider);?>"></i><?php echo $results->displayname;?>
		                        </div>
		                    </div>
		                </td>
		                <td>
		                    <div class="relative">
		                        <div class="single-layout">
			                        <i data-dynamic="false" class="icon layout <?php echo strtolower($results->layout);?>"></i><?php echo ucwords($results->layout);?>
		                        </div>
		                    </div>
		                </td>
		                <td>
		                    <div class="relative">
		                        <span>
									<abbr title="<?php echo date_i18n(__('Y/m/d g:i:s A'), strtotime($results->modified));?>"><?php echo apply_filters('roksprocket_widget_date_column_time', date_i18n(__('Y/m/d'), strtotime($results->modified), $results->id, 'modified'));?></abbr>
								</span>
		                    </div>
		                </td>
		                <td>
		                    <div class="relative">
		                        <span><?php echo $results->id; ?></span>
		                    </div>
		                </td>
		            </tr>

		            <?php endforeach; ?>

	            </tbody>
	        </table>

	        <?php if ($that->total_pages > 1) { ?>
	        <div class="tablenav bottom">
                <div class="tablenav-pages">
                    <span class="displaying-num"><?php echo $that->total_posts;?> items</span>
                    <span class="pagination-links">
                        <?php if ($that->paged != 1): ?>
                        <a class="first-page" title="Go to the first page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => 1))?>">«</a>
                        <a class="prev-page" title="Go to the previous page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $that->paged - 1))?>">‹</a>
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
                        <a class="next-page" title="Go to the next page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $that->paged + 1))?>">›</a>
                        <a class="last-page" title="Go to the last page" href="<?php echo RokCommon_URL::updateParams($that->link, array('paged' => $that->total_pages))?>">»</a>
                        <?php endif;?>
                    </span>
                </div>
	        </div>
	        <?php } ;?>

	    </div>
	    <div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
</form>
