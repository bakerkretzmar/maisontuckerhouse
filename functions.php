<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/widgets.php',
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

if (function_exists('pll_current_language') && ! function_exists('mth_trans')) {
    function mth_trans($text)
    {
        $translations = [
            'Want Tucker House in your Inbox? Subscribe to receive email updates, latest news, and learn how you can get involved! At Tucker House opportunities are endless!' => 'Abonnez-vous pour recevoir des mises à jour par courriel, les dernières nouvelles et découvrez comment vous pouvez vous impliquer! À la Maison Tucker, les opportunités sont infinies !',
            'Donate to Tucker House' => 'Faites un don à la Maison Tucker',
            'Make a tax-deductible gift today to encourage sustainable living and educate local youth for a healthier future.' => 'Faites un don déductible d’impôts aujourd’hui pour encourager un mode de vie durable et éduquer les jeunes de la région pour un avenir plus sain.',
            'Donate Now' => 'Cliquez-ici',
            'Subscribe' => 'Abonnez-vous',
            'Thanks to our sponsors and partners:' => 'Nous remercions nos partenaires et commanditaires:',
            'Sign up for Tucker House and Country Fun email newsletters!' => 'Abonnez-vous à l’infolettre de la Maison Tucker et Country Fun!',
            'We thank you for your interest in the great work of Tucker House. Get to know us, come out for a visit, or volunteer!' => 'Nous vous remercions de votre intérêt envers la Maison Tucker et ses initiatives. Pour en connaître davantage, vous pouvez venir nous visiter en tout temps ou faire du bénévolat pendant nos multiples activités.',
            'We send you newsletters and occasional updates on special events, activities, and programs like Country Fun Nature Camp. You can also opt out at any time.' => 'Nous vous envoyons occasionnellement des courriels pour vous tenir au courant de mises à jour, événements, activités et camp d’été (programmes) comme Country Fun Nature Camp. Vous pouvez aussi vous désabonner à tout moment.',
            'Want Tucker House in your Inbox?' => 'Vous voulez la Maison Tucker dans votre boîte de réception ?',
        ];

        if (is_string($text)) {
            if (array_key_exists($text, $translations) && pll_current_language() === 'fr') {
                return $translations[$text];
            }

            return $text;
        } else if (array_key_exists(pll_current_language(), $text)) {
            return $text[pll_current_language()];
        }

        return '';
    }
}
