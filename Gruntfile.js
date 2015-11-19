module.exports = function( grunt ) {

	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),
		sass: {
			dist: {
				options: {
					sourceMap: true,
					outputStyle: 'expanded'
				},
				files: {
					'style.css' : 'sass/style.scss'
				},
			},
		},
		watch: {
			css: {
				files: '**/*.scss',
				tasks: ['sass'],
				options: {
					livereload: true,
				},
			},
		},
		postcss: {
			options: {
				processors: [
					require( 'autoprefixer' )({ browsers: 'last 2 versions' }), // Add vendor prefixes.
					require( 'pixrem' )(), // Add fall backs for rem units.
				]
			},
			dist: {
				src: '*.css'
			},
		},
		wp_readme_to_markdown: {
			your_target: {
				files: {
					'readme.md' : 'readme.txt'
				},
			},
		},
		makepot: {
			target: {
				options: {
					type: 'wp-theme'
				},
			},
		},
	});

	// Load plugins.
	grunt.loadNpmTasks( 'grunt-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-postcss' );
	grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );

	// Configure tasks.
	grunt.registerTask( 'build', ['sass', 'postcss', 'wp_readme_to_markdown', 'makepot' ] );

};
