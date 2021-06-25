module.exports = {
    mode: 'jit',
    prefix: 'tw_',
    purge: ['./assets/scripts/*.js', './lib/*.php', './templates/*.php', './*.php'],
    theme: {
        extend: {},
    },
    corePlugins: {
        preflight: false,
    },
};
