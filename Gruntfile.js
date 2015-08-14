module.exports = function(grunt) {

  grunt.initConfig({
    sass: {
      all: {
        options: {
          style: 'expanded'
        },
        files: {
          'css/main.css': 'css/sass/app.scss'
        }
      }
    },
    pot: {
      options: {
        text_domain: 'newsroom',
        language: 'PHP',
        keywords: [
          '__',
          '_e',
          '_x',
          '_ex',
          '_n',
          '_nx'
        ],
        dest: 'languages/'
      },
      files: {
        src: ['**/*.php', '!node_modules/**/*.php', '!inc/acf/**/*.php', '!inc/class-tgm*'],
        expand: true
      }
    },
    watch: {
      options: {
        livereload: true
      },
      php: {
        files: ['**/*.php', '!inc/acf/**/*.php', '!node_modules/**/*.php', '!inc/class-tgm*'],
        tasks: ['pot']
      },
      sass: {
        files: 'src/css/**/*.scss',
        tasks: ['sass']
      }
    }
  });

  grunt.loadNpmTasks('grunt-browserify');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-pot');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask(
    'build',
    'Compiles everything.',
    ['sass', 'pot']
  );

  grunt.registerTask(
    'default',
    'Build, start server and watch.',
    ['sass', 'pot', 'watch']
  );

}
