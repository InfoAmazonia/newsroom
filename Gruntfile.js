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
    copy: {
      normalize: {
        files: [
          {
            cwd: 'bower_components/normalize.css',
            src: ['normalize.css'],
            dest: 'css',
            expand: true
          }
        ]
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
        files: 'css/**/*.scss',
        tasks: ['sass']
      },
      copy: {
        files: ['bower_components/normalize/**/*'],
        tasks: ['copy']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-pot');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask(
    'build',
    'Compiles everything.',
    ['sass', 'copy', 'pot']
  );

  grunt.registerTask(
    'default',
    'Build, start server and watch.',
    ['sass', 'copy', 'pot', 'watch']
  );

}
