// Suppression des fichiers generés
module.exports = {
  all: {
    src: ["<%= paths.build %>", "<%= paths.source %>/sass/build_modules/", "<%= paths.source %>/js/build/", "<%= paths.source %>/bower_components/"],
    options: {
      force: true
    }
  }
};
