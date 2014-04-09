module.exports = function(grunt) {

grunt.initConfig({
  less: {
    production: {
      options: {
        paths: ["app/bower_components/bootstrap/less"],
        yuicompress: true
      },
      files: {
        "assets/css/app.min.css": "assets/_less/app.less"
      },
      options: {
        compress: true
      }
    }
  },
  uglify: {
    jquery: {
      files: {
        'assets/js/jquery.min.js': 'app/bower_components/jquery/jquery.js'
      }
    },
    bootstrap: {
      files: {
        'assets/js/bootstrap.min.js': ['app/bower_components/bootstrap/js/collapse.js', 'app/bower_components/bootstrap/js/button.js', 'app/bower_components/bootstrap/js/dropdown.js']
      }
    },
    backstretch: {
      files: {
        'assets/js/backstretch.min.js' : 'app/bower_components/jquery-backstretch/jquery.backstretch.js'
      }
    }
  },
  copy: {
    bootstrap: {
      files: [
        {expand: true, cwd: 'app/bower_components/bootstrap/fonts/', src: ['**'], dest: 'assets/fonts/'},
      ]
    },
  }
});

grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-contrib-less');
grunt.loadNpmTasks('grunt-contrib-copy');

grunt.registerTask('default', [ 'less', 'uglify', 'copy']);

};
