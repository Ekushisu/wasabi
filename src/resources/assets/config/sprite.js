module.exports = {
  icons: {
    src: '<%= paths.source %>/images/icons-sprite/*.png',
    dest: '<%= paths.build %>/images/sprite.png',
    imgPath: '../images/sprite.png',
    destCss: '<%= paths.source %>/sass/components/_sprites.scss'
  }
};
