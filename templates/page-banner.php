<?php use Roots\Sage\Titles; ?>

<div class="pageBanner container-fluid">
  <h1 class="pageTitle"><?= Titles\title(); ?></h1>
  <?= get_the_post_thumbnail(); ?>
</div>
