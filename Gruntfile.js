module.exports = function( grunt ) {

	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),
		sass: {
			options: {
				outputStyle: 'expanded',
				// sourceComments: true,
				sourceMap: true,
				includePaths: [
					'node_modules/bourbon/app/assets/stylesheets',
					'node_modules/bourbon-neat/core/',
					'node_modules/sanitize.scss'
				]
			},
			dist: {
				files: {
					'style.css': 'assets/sass/style.scss'
				},
			},
		},
		postcss: {
			options: {
				map: true,
				processors: [
					require( 'autoprefixer' )({ browsers: 'last 2 versions' }), // Add vendor prefixes.
					require( 'css-mqpacker' )({ sort: true }),
				]
			},
			dist: {
				src: '*.css'
			},
		},
		cssnano: {
			options: {
				autoprefixer: false,
				safe: true,
			},
			dist: {
				files: {
					'style.min.css' : 'style.css'
				},
			},
		},
		jshint: {
			files: ['Gruntfile.js', 'js/src/*.js']
		},
		concat: {
			options: {
				banner: '/*! <%= pkg.name %> theme JS - This file is built with Grunt and should not be edited directly */\n\n',
				separator: '\n\n'
			},
			dist: {
				src: [
					'assets/js/src/utilities.js',
					'assets/js/src/skip-link-focus-fix.js',
					'assets/js/src/navigation.js',
					'assets/js/src/alcatraz.js', // This must be included after all other objects.
					'assets/js/src/patterns.js',
					'assets/js/src/init.js' // This should be last.
				],
				dest: 'js/<%= pkg.name %>-theme.js'
			}
		},
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> theme JS - This file is built with Grunt and should not be edited directly */\n',
				sourceMap: true
			},
			dist: {
				files: {
					'assets/js/<%= pkg.name %>-theme.min.js': ['<%= concat.dist.dest %>']
				}
			}
		},
		watch: {
			css: {
				files: ['assets/sass/**/*.scss'],
				tasks: ['styles'],
				options: {
					livereload: true
				},
			},
			js: {
				files: ['<%= jshint.files %>'],
				tasks: ['scripts']
			}
		},
		wp_readme_to_markdown: {
			your_target: {
				files: {
					'readme.md' : 'readme.txt'
				},
			},
		},
		makepot: {
			theme: {
				options: {
					cwd: '',
					domainPath: 'languages/',
					potFilename: 'alcatraz.pot',
					type: 'wp-theme'
				},
			},
		},
	});

	// Load plugins.
	grunt.loadNpmTasks( 'grunt-sass' );
	grunt.loadNpmTasks( 'grunt-postcss' );
	grunt.loadNpmTasks( 'grunt-cssnano' );
	grunt.loadNpmTasks( 'grunt-contrib-jshint' );
	grunt.loadNpmTasks( 'grunt-contrib-concat' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );

	// Configure tasks.
	grunt.registerTask( 'styles', ['sass', 'postcss', 'cssnano'] );
	grunt.registerTask( 'scripts', ['jshint', 'concat', 'uglify'] );
	grunt.registerTask( 'build', ['sass', 'postcss', 'jshint', 'concat', 'uglify', 'wp_readme_to_markdown', 'makepot'] );
};
