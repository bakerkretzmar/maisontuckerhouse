const defaults = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    prefix: 'tw_',
    purge: [
        './assets/scripts/*.js',
        './lib/*.php',
        './templates/*.php',
        './*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Proxima Nova"', ...defaults.fontFamily.sans],
                calluna: ['"Calluna Sans"', ...defaults.fontFamily.sans],
                museo: ['"Museo Sans"', ...defaults.fontFamily.sans],
            },
        },
    },
    corePlugins: {
        preflight: false,
    },
};
