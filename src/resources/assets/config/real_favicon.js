module.exports = {
  create: {
    // The favicon master picture
    src: '<%= paths.source %>/images/favicon/favicon.png',
    // Directory where the generated pictures will be stored
    dest: '<%= paths.build %>/images/favicons/',
    // Path to icon (eg. favicon.ico will be accessible through http://mysite.com/path/to/icons/favicon.ico)
    // icons_path: '/path/to/icons',
    // HTML files where the favicon code should be inserted
    html: [],
    design: {
      // These options reflect the settings available in RealFaviconGenerator
      ios: {
        picture_aspect: 'no_change'
      },
      android_chrome: {
        picture_aspect: 'no_change',
        manifest: {
            name: 'XXX.fr',
            display: 'browser'
        },
      },
      coast: {
        picture_aspect: 'no_change'
      },
      windows: {
        picture_aspect: 'no_change'
      }
    },
    settings: {
      // 0 = no compression, 5 = maximum compression
      compression: 2,
      // Default is Mitchell
      scaling_algorithm: 'Mitchell'
    }
  }
};
