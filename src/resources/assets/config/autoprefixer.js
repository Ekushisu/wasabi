// Gestion automatique des prefix CSS3
module.exports = {
  dev: {
    options: {
      map: true
    },
    files: [{
      expand: true,
      cwd: '<%= paths.build %>/css/',
      src: ['*.css'],
      dest: '<%= paths.build %>/css/'
    }]
  },
  prod: {
    options: {
      map: false
    },
    files: [{
      expand: true,
      cwd: '<%= paths.build %>/css/',
      src: ['*.css'],
      dest: '<%= paths.build %>/css/'
    }]
  }
};
