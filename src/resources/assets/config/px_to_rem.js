// Duplication des propriétés px avec rem
module.exports = {
  dist: {
    options: {
      base: 10,
      fallback: true
    },
    files: [{
      expand: true,
      cwd: '<%= paths.build %>/css/',
      src: ['*.css'],
      dest: '<%= paths.build %>/css/'
    }]
  }
};
