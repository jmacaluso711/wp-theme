
<?php if (have_rows( $acf_flexible_content )) : $row_count = 0; ?>

	<?php while (have_rows( $acf_flexible_content )) : the_row(); $row_class = 'fc-row-' . ++$row_count; ?>

		<?php if (get_row_layout() == 'example' ) : ?>

			<?php include(locate_template('/flexible_content/acf-example.php')); ?>

		<?php elseif (get_row_layout() == 'example-2') : ?>

			<?php include(locate_template('/flexible_content/acf-example-2.php')); ?>

		<?php endif; ?>

	<?php endwhile; ?>

<?php endif; ?>
