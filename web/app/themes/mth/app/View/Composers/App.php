<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = ['*'];

    /**
     * Data to be passed to view before rendering.
     */
    public function with(): array
    {
        return [
            'siteName' => $this->siteName(),
            'siteDescription' => $this->siteDescription(),
        ];
    }

    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }

    public function siteDescription(): string
    {
        return get_bloginfo('description', 'display');
    }
}
