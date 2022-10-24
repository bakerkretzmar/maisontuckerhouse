const defaults = require('tailwindcss/defaultTheme');

module.exports = {
    content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
    theme: {
        extend: {
            colors: {}, // Extend Tailwind's default colors
        },
    },
};
