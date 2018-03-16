/* eslint-disable camelcase */
module.exports = function(grunt) {
  // Load all packages.
  require('load-grunt-tasks')(grunt);

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    stylelint: {
      options: {
        configFile: '.stylelintrc',
        failOnError: false,
        syntax: 'scss'
      },
      src: ['assets/sass/**/*.scss']
    },
    sass: {
      options: {
        outputStyle: 'expanded',
        // sourceComments: true,
        sourceMap: true,
        includePaths: [
          'node_modules/bourbon/core',
          'node_modules/bourbon-neat/core',
          'node_modules/sanitize.scss'
        ]
      },
      dist: {
        files: {
          'style.css': 'assets/sass/style.scss'
        }
      }
    },
    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')({
            browsers: 'last 2 versions'
          }), // Add vendor prefixes.
          require('css-mqpacker')({
            sort: true
          })
        ]
      },
      dist: {
        src: '*.css'
      }
    },
    cssnano: {
      options: {
        autoprefixer: false,
        safe: true
      },
      dist: {
        files: {
          'style.min.css': 'style.css'
        }
      }
    },
    sassdoc: {
      default: {
        src: 'assets/sass/**/*.scss'
      }
    },
    eslint: {
      options: {
        configFile: '.eslintrc.json',
        quiet: true
      },
      target: ['assets/scripts/**/*.js']
    },
    concat: {
      options: {
        banner:
          '/*! <%= pkg.name %> theme JS - This file is built with Grunt and should not be edited directly */\n\n',
        separator: '\n\n'
      },
      dist: {
        src: [
          'vendor/jquery-mobile/jquery.mobile.custom.min.js',
          'assets/scripts/src/utilities.js',
          'assets/scripts/src/skip-link-focus-fix.js',
          'assets/scripts/src/navigation.js',
          'assets/scripts/src/alcatraz.js', // This must be included after all other objects.
          'assets/scripts/src/init.js' // This should be last.
        ],
        dest: 'assets/scripts/<%= pkg.name %>-theme.js'
      }
    },
    babel: {
      options: {
        sourceMap: false
      },
      dist: {
        files: {
          'assets/scripts/<%= pkg.name %>-theme.js':
            'assets/scripts/<%= pkg.name %>-theme.js'
        }
      }
    },
    uglify: {
      options: {
        banner:
          '/*! <%= pkg.name %> theme JS - This file is built with Grunt and should not be edited directly */\n',
        sourceMap: true
      },
      dist: {
        files: {
          'assets/scripts/<%= pkg.name %>-theme.min.js': [
            '<%= concat.dist.dest %>'
          ]
        }
      }
    },
    watch: {
      css: {
        files: ['assets/sass/**/*.scss'],
        tasks: ['styles'],
        options: {
          livereload: true
        }
      },
      js: {
        files: ['assets/scripts/**/*.js'],
        tasks: ['scripts']
      },
      sprites: {
        files: ['assets/icons/*.svg'],
        tasks: ['svgmin', 'svgstore']
      }
    },
    browserSync: {
      dev: {
        bsFiles: {
          src: ['*.php', '*.css', 'assets/scripts/*.js']
        },
        options: {
          watchTask: true,
          proxy: 'alcatraz.local', // add your local dev url here.
          injectChanges: true
        }
      }
    },
    svgmin: {
      options: {
        plugins: [{ removeViewBox: false }]
      },
      dist: {
        files: [
          {
            expand: true,
            cwd: 'assets/',
            src: ['icons/*.svg'],
            dest: 'assets/icons',
            flatten: true
          }
        ]
      }
    },
    svgstore: {
      dist: {
        files: {
          'assets/icons/svg-defs.svg': ['assets/icons/svg/*.svg']
        }
      },
      options: {
        cleanup: true
      }
    },
    wp_readme_to_markdown: {
      your_target: {
        files: {
          'readme.md': 'readme.txt'
        }
      }
    },
    makepot: {
      theme: {
        options: {
          cwd: '',
          domainPath: 'languages/',
          potFilename: 'alcatraz.pot',
          type: 'wp-theme'
        }
      }
    }
  });

  // Configure tasks.
  grunt.registerTask('default', ['browserSync', 'watch']);

  grunt.registerTask('styles', ['stylelint', 'sass', 'postcss']);

  grunt.registerTask('scripts', ['eslint', 'concat', 'babel']);

  grunt.registerTask('icons', ['svgmin', 'svgstore']);

  grunt.registerTask('lint', ['stylelint', 'eslint']);

  grunt.registerTask('minify', ['cssnano', 'uglify', 'icons']);

  grunt.registerTask('build', [
    'styles',
    'scripts',
    'icons',
    'minify',
    'wp_readme_to_markdown',
    'makepot'
  ]);
};
