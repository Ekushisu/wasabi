module.exports = {
  options: {
    stripBanners: false,
    banner: '<%= banner %>\n',
    process: function(src, filepath) {
      // add comments with original filename
      return '//### file:' + filepath + ' ###//\n' + src + '//### endfile:' + filepath + '###//\n';
    }
  },
  // Les librairies auxquelles on ne touche pas
  jslibs: {
    src: '<%= paths.jslibs_srcs %>',
    dest: '<%= paths.build %>/js/libs.js',
  },
  // Le code bien de chez nous
  jsapp: {
    src: '<%= paths.jsapp_srcs %>',
    dest: '<%= paths.build %>/js/app.js',
  }
};
