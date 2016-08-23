// Gestion des fallback SVG
module.exports = {
  all: {
    // specify files in array format with multiple src-dest mapping
    files: [
      // rasterize all SVG files in "img" and its subdirectories to "img/png"
      //{ src: ['img/**/*.svg'], dest: 'img/png/' },
      // rasterize SVG file to same directory
      { src: ['<%= paths.build %>/images/svg/*.svg'] }
    ]
  }
};

