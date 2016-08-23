module.exports = {
  css: {
    files: '<%= paths.source %>/sass/**/*.scss',
    tasks: ['sass:dev', 'autoprefixer:dev']
  },
  img: {
    files: '<%= paths.source %>/images/**/*',
    tasks: ['imagemin','copy']
  },
  iconsfont: {
    files: '<%= paths.source %>/icons/*',
    tasks: ['webfont']
  },
  js: {
    files: '<%= paths.source %>/js/*',
    tasks: ['concat:jsapp']
  },
};
