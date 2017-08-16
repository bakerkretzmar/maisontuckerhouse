<?php if ( get_field('sidebar_select') == 'Secondary' ) {
  dynamic_sidebar('sidebar-secondary');
} else {
  dynamic_sidebar('sidebar-primary');
} ?>
