const defaults = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
    theme: {
        extend: {
            colors: {
                gray: colors.stone,
            },
            fontFamily: {
                museo: ['museo-sans', ...defaults.fontFamily.sans],
                calluna: ['calluna-sans', ...defaults.fontFamily.sans],
                proxima: ['proxima-nova', ...defaults.fontFamily.sans],
            },
        },
    },
};
