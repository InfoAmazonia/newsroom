module.exports = function(grunt) {

  grunt.initConfig({
    sass: {
      all: {
        options: {
          style: 'expanded'
        },
        files: [
          {
            'css/main.css': 'css/sass/app.scss'
          },
          {
            cwd: 'inc/siteorigin-widgets',
            src: ['**/*.scss'],
            dest: 'inc/siteorigin-widgets',
            expand: true,
            ext: '.css'
          }
        ]
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
      },
      fitvids: {
        files: [
          {
            cwd: 'bower_components/fitvids',
            src: ['jquery.fitvids.js'],
            dest: 'lib',
            expand: true
          }
        ]
      },
      photoswipe: {
        files: [
          {
            cwd: 'bower_components/photoswipe/dist',
            src: ['**/*'],
            dest: 'lib/photoswipe',
            expand: true
          }
        ]
      },
      hammerjs: {
        files: [
          {
            cwd: 'bower_components/hammer.js',
            src: ['**/*'],
            dest: 'lib/hammerjs',
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
        files: ['**/*.php', '**/*.less', '!inc/acf/**/*.php', '!node_modules/**/*.php', '!inc/class-tgm*'],
        tasks: ['pot']
      },
      sass: {
        files: '**/*.scss',
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
