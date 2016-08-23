module.exports = {
  // Copie des glyphs boostrap
  font: {
    expand: true,
    cwd: '<%= paths.source %>/font/',
    src: '**',
    dest: '<%= paths.build %>/fonts/',
  },
  svg: {
    expand: true,
    cwd: '<%= paths.source %>/images/svg/',
    src: '**',
    dest: '<%= paths.build %>/images/svg/',
  },
  misc: {
    expand: true,
    cwd: '<%= paths.source %>/images/misc/',
    src: '**',
    dest: '<%= paths.build %>/images/misc/',
  },
  js: {
    expand: true,
    cwd: '<%= paths.source %>/js/',
    src: 'ZeroClipboard.swf',
    dest: '<%= paths.build %>/js/',
  },
  wysiwyg: {
    expand: true,
    cwd: '<%= paths.source %>/bower_components/trumbowyg/dist/ui/',
    src: 'trumbowyg.min.css',
    dest: '<%= paths.build %>/../admin-assets/css/',
  },
  wysiwygjs: {
    expand: true,
    cwd: '<%= paths.source %>/bower_components/trumbowyg/dist/',
    src: 'trumbowyg.min.js',
    dest: '<%= paths.build %>/../admin-assets/js/',
  },
  wysiwygjsicon: {
    expand: true,
    cwd: '<%= paths.source %>/bower_components/trumbowyg/dist/ui/',
    src: 'icons.svg',
    dest: '<%= paths.build %>/../admin-assets/js/ui/',
  }
};
