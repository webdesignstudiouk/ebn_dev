<div class="panel panel-default">
<?php if(isset($form->title)){
	?>
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">
			<b><?php echo $form->title;?></b>
		</h3>
	</div>
	<?php
} ?>

<?php if ($showStart): ?>
    <?= Form::open($formOptions) ?>
<?php endif; ?>

<?php if ($showFields): ?>
    <?php foreach ($fields as $field): ?>
    	<?php if( ! in_array($field->getName(), $exclude) ) { ?>
        	<?= $field->render() ?>
		<?php } ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($showEnd): ?>
    <?= Form::close() ?>
<?php endif; ?>

</div>