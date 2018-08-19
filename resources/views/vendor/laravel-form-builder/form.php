<div class="panel panel-default" style="<?php echo  ( isset( $form->collapsable ) && $form->collapsable ? 'background-color: #f4f4f4;' : ''); ?>">
	<?php if ( isset( $form->title ) ) {
		?>
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
				<?php if ( isset( $form->collapsable ) && $form->collapsable ): ?>
                    <a class="collapsed" role="button" data-toggle="collapse" href="#<?php echo str_replace( ' ', '', $form->title ) ?>" aria-expanded="false">
                        <b><?php echo $form->title; ?></b>
                    </a>
				<?php else: ?>
                    <b><?php echo $form->title; ?></b>
				<?php endif; ?>
            </h3>
        </div>
		<?php
	} ?>

	<?php if ( isset( $form->collapsable ) && $form->collapsable ): ?>
    <div id="<?php echo str_replace( ' ', '', $form->title ) ?>" class="panel-collapse collapse">
		<?php endif; ?>
		<?php if ( $showStart ): ?>
			<?= Form::open( $formOptions ) ?>
		<?php endif; ?>

		<?php if ( $showFields ): ?>
			<?php foreach ( $fields as $field ): ?>
				<?php if ( ! in_array( $field->getName(), $exclude ) ) { ?>
					<?= $field->render() ?>
				<?php } ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if ( $showEnd ): ?>
			<?= Form::close() ?>
		<?php endif; ?>
		<?php if ( isset( $this->collapsable ) && $this->collapsable ): ?>
    </div>
<?php endif; ?>
</div>