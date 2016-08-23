// Optimisation des images
module.exports = {
  dynamic: {
    files: [{
      expand: true,
      cwd: '<%= paths.source %>/images/',
      src: ['**/*.{png,jpg,gif}'],
      dest: '<%= paths.build %>/images/'
    }],
    options: {
      progressive: false,
      cache: false
    }
  }
};
