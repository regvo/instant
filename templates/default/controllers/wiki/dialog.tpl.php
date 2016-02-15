<div class="wiki_controller ajax_window" >
	<img class="logo_wiki" src='/templates/default/images/wiki.png' >
	<h2><?php echo $title;?></h2>
	<?php if(is_array($rows) && count($rows)>0):?>	
		<?php foreach($rows as $row):?>
			<div class="info_block" >
				<p class="title" ><?php echo $row['title'];?></p>
				<p class="description" ><?php echo $row['description'];?></p>
				<a href="<?php echo $row['link'];?>" target="_blank" class="link" ><?php echo LANG_WIKI_READ_MORE;?></a>
			</div>
		<?php endforeach;?>
	<?php else:?>
		<div class="info_block" >
			<p class="title" ><?php echo LANG_WIKI_NOT_ROWS;?></p>
		</div>
	<?php endif;?>
	
</div>