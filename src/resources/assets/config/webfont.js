// Génération de font à partir d'une liste de SVG
module.exports = {
  icons: {
    src: '<%= paths.source %>/webfont-icons/*.svg',
    dest: '<%= paths.build %>/webfonts',
    destCss: '<%= paths.source %>/sass/build_modules/',
    options: {
      template: '<%= paths.source %>/webfont-icons/templates/template_icons.css',
      stylesheet: 'scss',
      relativeFontPath: '../webfonts/',
      htmlDemo: false
    }
  }
};

