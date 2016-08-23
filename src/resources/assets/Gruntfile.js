module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);
  require('time-grunt')(grunt);

  // sources path configurations
  var options =  {
    paths: {
      source: __dirname,
      build: '../../../public/wasabi-assets',
      //  Extern JS libs
      jslibs_srcs: [
        '<%= paths.source %>/bower_components/jquery/dist/jquery.js',
        '<%= paths.source %>/bower_components/materialize/dist/js/materialize.js'
      ],
      // Homemade JS
      jsapp_srcs: [
        '<%= paths.source %>/js/app.js'
      ]
    },
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %>\n'+
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author %> */\n',
  }

  //loads the various task configuration files
  var configs = require('load-grunt-configs')(grunt, options);
  grunt.initConfig(configs);


  grunt.registerTask('generatestatic', [
    'shell:npm_install',
    'bower:install',
    //'webfont',
    'copy',
    'svg2png',
    'imagemin',
    'modernizr',
    'real_favicon',
    'sprite',
  ]);

  grunt.registerTask('sassdev', [
    'sass:dev',
    'autoprefixer:dev'
  ]);

  grunt.registerTask('sassprod', [
    'sass:prod',
    'autoprefixer:prod',
    'px_to_rem'
  ]);

  grunt.registerTask('dev', [
    'generatestatic',
    'sassdev',
    'concat'
  ]);

  grunt.registerTask('prod', [
    'generatestatic',
    'sassprod',
    'concat',
    'uglify'
  ]);


};
