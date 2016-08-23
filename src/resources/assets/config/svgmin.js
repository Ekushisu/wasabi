module.exports = {
  options: {                    // Configuration that will be passed directly to SVGO
    plugins: [
      { removeViewBox: false },
      { removeUselessStrokeAndFill: false }
    ]
  },
  all: {                        // Target
    files: [{                // Dictionary of files
      expand: true,
      cwd: '<%= paths.source %>/images/svg/',
      src: '**/*.svg',
      dest: '<%= paths.build %>/images/svg/',
      ext: '.svg'
    }]
  }
};
