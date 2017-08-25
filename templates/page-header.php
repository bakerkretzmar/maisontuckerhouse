<?php use Roots\Sage\Titles; ?>

<?php if ( !has_post_thumbnail() ): ?>
<div class="page-header">
  <h1><?= Titles\title(); ?></h1>
</div>
<?php endif; ?>
