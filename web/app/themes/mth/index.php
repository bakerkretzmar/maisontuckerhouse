<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
        <link rel="stylesheet" href="https://use.typekit.net/fhf1btp.css">
    </head>
    <body <?php body_class(['font-proxima']); ?>>
        <?php wp_body_open(); ?>
        <?php do_action('get_header'); ?>
        <div id="app">
            <?php echo view(app('sage.view'), app('sage.data'))->render(); ?>
        </div>
        <?php do_action('get_footer'); ?>
        <?php wp_footer(); ?>
    </body>
</html>
