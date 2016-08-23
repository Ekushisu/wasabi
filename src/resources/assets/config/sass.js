// Libsass
module.exports = {
  dev: {
    options: {
      imagePath: "../images",
      outputStyle: 'nested',
      sourceMap: true
    },
    files: [{
      "expand": true,
      "cwd": "<%= paths.source %>/sass/",
      "src": ["*.scss"],
      "dest": "<%= paths.build %>/css/",
      "ext": ".css"
    }]
  },
  prod: {
    options: {
      imagePath: "../images",
      outputStyle: 'compressed'
    },
    files: [{
      "expand": true,
      "cwd": "<%= paths.source %>/sass/",
      "src": ["*.scss"],
      "dest": "<%= paths.build %>/css/",
      "ext": ".css"
    }]
  }
};
