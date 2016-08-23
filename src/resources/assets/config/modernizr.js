module.exports = {
  dist: {
    // [REQUIRED] Path to the build you're using for development.
    "devFile" : "remote",

    // Path to save out the built file.
    "outputFile" : "<%= paths.source %>/js/built/modernizr.custom.js",

    // Based on default settings on http://modernizr.com/download/
    "extra" : {
        "shiv" : true,
        "printshiv" : false,
        "load" : true,
        "mq" : false,
        "cssclasses" : true,
        "svg": true,
        "csstransforms": true,
        "csstransforms3d": true
    },

    // Based on default settings on http://modernizr.com/download/
    "extensibility" : {
        "addtest" : false,
        "prefixed" : false,
        "teststyles" : false,
        "testprops" : false,
        "testallprops" : false,
        "hasevents" : false,
        "prefixes" : false,
        "domprefixes" : false,
        "cssclassprefix": ""
    },

    // By default, source is uglified before saving
    "uglify" : false,

    // Define any tests you want to implicitly include.
    "tests" : [],

    // By default, this task will crawl your project for references to Modernizr tests.
    // Set to false to disable.
    "parseFiles" : true,

    // When parseFiles = true, this task will crawl all *.js, *.css, *.scss and *.sass files,
    // except files that are in node_modules/.
    // You can override this by defining a "files" array below.
    // "files" : {
        // "src": []
    // },

    // This handler will be passed an array of all the test names passed to the Modernizr API, and will run after the API call has returned
    // "handler": function (tests) {},

    // When parseFiles = true, matchCommunityTests = true will attempt to
    // match user-contributed tests.
    "matchCommunityTests" : false,

    // Have custom Modernizr tests? Add paths to their location here.
    "customTests" : [],

    "excludeFiles": ['bootstrap-sass-3.1.1/**/*']
  }
};
