module.exports = {
  options: {
    banner: '<%= banner %>'
  },
  all: {
    files: {
      '<%= concat.jslibs.dest %>': ['<%= concat.jslibs.dest %>'],
      '<%= concat.jsapp.dest %>': ['<%= concat.jsapp.dest %>']
    }
  }
};
