<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>

<h2><a href="<?php echo (isset($this->_rootref['U_VIEW_FORUM'])) ? $this->_rootref['U_VIEW_FORUM'] : ''; ?>"><?php echo (isset($this->_rootref['FORUM_NAME'])) ? $this->_rootref['FORUM_NAME'] : ''; ?></a></h2>


<?php if ($this->_rootref['S_FORUM_RULES']) {  ?>

	<div class="rules">
		<div class="inner"><span class="corners-top"><span></span></span>

		<?php if ($this->_rootref['U_FORUM_RULES']) {  ?>

			<a href="<?php echo (isset($this->_rootref['U_FORUM_RULES'])) ? $this->_rootref['U_FORUM_RULES'] : ''; ?>"><?php echo ((isset($this->_rootref['L_FORUM_RULES'])) ? $this->_rootref['L_FORUM_RULES'] : ((isset($user->lang['FORUM_RULES'])) ? $user->lang['FORUM_RULES'] : '{ FORUM_RULES }')); ?></a>
		<?php } else { ?>

			<strong><?php echo ((isset($this->_rootref['L_FORUM_RULES'])) ? $this->_rootref['L_FORUM_RULES'] : ((isset($user->lang['FORUM_RULES'])) ? $user->lang['FORUM_RULES'] : '{ FORUM_RULES }')); ?></strong><br />
			<?php echo (isset($this->_rootref['FORUM_RULES'])) ? $this->_rootref['FORUM_RULES'] : ''; ?>

		<?php } ?>


		<span class="corners-bottom"><span></span></span></div>
	</div>
<?php } if ($this->_rootref['S_HAS_SUBFORUM']) {  if (! $this->_rootref['S_IS_BOT'] && $this->_rootref['U_MARK_FORUMS']) {  ?>

<ul class="linklist">
	<li class="rightside"><a href="<?php echo (isset($this->_rootref['U_MARK_FORUMS'])) ? $this->_rootref['U_MARK_FORUMS'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MARK_SUBFORUMS_READ'])) ? $this->_rootref['L_MARK_SUBFORUMS_READ'] : ((isset($user->lang['MARK_SUBFORUMS_READ'])) ? $user->lang['MARK_SUBFORUMS_READ'] : '{ MARK_SUBFORUMS_READ }')); ?></a></li>
</ul>
<?php } $this->_tpl_include('forumlist_body.html'); } $_topicrow_count = (isset($this->_tpldata['topicrow'])) ? sizeof($this->_tpldata['topicrow']) : 0;if ($_topicrow_count) {for ($_topicrow_i = 0; $_topicrow_i < $_topicrow_count; ++$_topicrow_i){$_topicrow_val = &$this->_tpldata['topicrow'][$_topicrow_i]; if (! $_topicrow_val['S_TOPIC_TYPE_SWITCH'] && ! $_topicrow_val['S_FIRST_ROW']) {  ?>

		</ul>
		<span class="corners-bottom"><span></span></span></div>
	</div>
	<?php } if ($_topicrow_val['S_FIRST_ROW'] || ! $_topicrow_val['S_TOPIC_TYPE_SWITCH']) {  ?>

		<div class="forumbg<?php if ($_topicrow_val['S_TOPIC_TYPE_SWITCH'] && ( $_topicrow_val['S_POST_ANNOUNCE'] || $_topicrow_val['S_POST_GLOBAL'] )) {  ?> announcement<?php } ?>">
		<div class="inner"><span class="corners-top"><span></span></span>
		<ul class="topiclist">
			<li class="header">
				<dl class="icon">
					<dt><?php if ($this->_rootref['S_DISPLAY_ACTIVE']) {  echo ((isset($this->_rootref['L_ACTIVE_TOPICS'])) ? $this->_rootref['L_ACTIVE_TOPICS'] : ((isset($user->lang['ACTIVE_TOPICS'])) ? $user->lang['ACTIVE_TOPICS'] : '{ ACTIVE_TOPICS }')); } else if ($_topicrow_val['S_TOPIC_TYPE_SWITCH'] && ( $_topicrow_val['S_POST_ANNOUNCE'] || $_topicrow_val['S_POST_GLOBAL'] )) {  echo ((isset($this->_rootref['L_ANNOUNCEMENTS'])) ? $this->_rootref['L_ANNOUNCEMENTS'] : ((isset($user->lang['ANNOUNCEMENTS'])) ? $user->lang['ANNOUNCEMENTS'] : '{ ANNOUNCEMENTS }')); } else { echo ((isset($this->_rootref['L_TOPICS'])) ? $this->_rootref['L_TOPICS'] : ((isset($user->lang['TOPICS'])) ? $user->lang['TOPICS'] : '{ TOPICS }')); } ?></dt>
				
					<dd class="lastpost"><span><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?></span></dd>
				</dl>
			</li>
		</ul>
		<ul class="topiclist topics">
	<?php } ?>


		<li class="row<?php if (!($_topicrow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } if ($_topicrow_val['S_POST_GLOBAL']) {  ?> global-announce<?php } if ($_topicrow_val['S_POST_ANNOUNCE']) {  ?> announce<?php } if ($_topicrow_val['S_POST_STICKY']) {  ?> sticky<?php } if ($_topicrow_val['S_TOPIC_REPORTED']) {  ?> reported<?php } ?>">
			<dl class="icon" style="background-image: url(<?php echo $_topicrow_val['TOPIC_FOLDER_IMG_SRC']; ?>); background-repeat: no-repeat;">
				<dt<?php if ($_topicrow_val['TOPIC_ICON_IMG'] && $this->_rootref['S_TOPIC_ICONS']) {  ?> style="background-image: url(<?php echo (isset($this->_rootref['T_ICONS_PATH'])) ? $this->_rootref['T_ICONS_PATH'] : ''; echo $_topicrow_val['TOPIC_ICON_IMG']; ?>); background-repeat: no-repeat;"<?php } ?> title="<?php echo $_topicrow_val['TOPIC_FOLDER_IMG_ALT']; ?>"><?php if ($_topicrow_val['S_UNREAD_TOPIC']) {  ?><a href="<?php echo $_topicrow_val['U_NEWEST_POST']; ?>"><?php echo (isset($this->_rootref['NEWEST_POST_IMG'])) ? $this->_rootref['NEWEST_POST_IMG'] : ''; ?></a> <?php } ?><a href="<?php echo $_topicrow_val['U_VIEW_TOPIC']; ?>" class="topictitle"><?php echo $_topicrow_val['TOPIC_TITLE']; ?></a>
					<?php if ($_topicrow_val['S_TOPIC_UNAPPROVED'] || $_topicrow_val['S_POSTS_UNAPPROVED']) {  ?><a href="<?php echo $_topicrow_val['U_MCP_QUEUE']; ?>"><?php echo $_topicrow_val['UNAPPROVED_IMG']; ?></a> <?php } if ($_topicrow_val['S_TOPIC_REPORTED']) {  ?><a href="<?php echo $_topicrow_val['U_MCP_REPORT']; ?>"><?php echo (isset($this->_rootref['REPORTED_IMG'])) ? $this->_rootref['REPORTED_IMG'] : ''; ?></a><?php } ?><br />
					<?php if ($_topicrow_val['PAGINATION']) {  ?><strong class="pagination"><span><?php echo $_topicrow_val['PAGINATION']; ?></span></strong><?php } ?>

					














				</dt>
			
				<dd class="lastpost"><span><dfn><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?> </dfn><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_topicrow_val['LAST_POST_AUTHOR_FULL']; ?>

					<?php if (! $this->_rootref['S_IS_BOT']) {  ?><a href="<?php echo $_topicrow_val['U_LAST_POST']; ?>"><?php echo (isset($this->_rootref['LAST_POST_IMG'])) ? $this->_rootref['LAST_POST_IMG'] : ''; ?></a> <?php } ?><br /><?php echo $_topicrow_val['LAST_POST_TIME']; ?></span>
				</dd>
			</dl>
		</li>

	<?php if ($_topicrow_val['S_LAST_ROW']) {  ?>

			</ul>
		<span class="corners-bottom"><span></span></span></div>
	</div>
	<?php } }} else { if ($this->_rootref['S_IS_POSTABLE']) {  ?>

	<div class="panel">
		<div class="inner"><span class="corners-top"><span></span></span>
		<strong><?php echo ((isset($this->_rootref['L_NO_TOPICS'])) ? $this->_rootref['L_NO_TOPICS'] : ((isset($user->lang['NO_TOPICS'])) ? $user->lang['NO_TOPICS'] : '{ NO_TOPICS }')); ?></strong>
		<span class="corners-bottom"><span></span></span></div>
	</div>
	<?php } } ?>