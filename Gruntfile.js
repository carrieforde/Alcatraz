module.exports = function(grunt) {
	// Load all packages.
	require("load-grunt-tasks")(grunt);

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),
		sass: {
			options: {
				outputStyle: "expanded",
				// sourceComments: true,
				sourceMap: true,
				includePaths: [
					"node_modules/bourbon/core",
					"node_modules/bourbon-neat/core",
					"node_modules/sanitize.scss"
				]
			},
			dist: {
				files: {
					"style.css": "assets/sass/style.scss"
				}
			}
		},
		postcss: {
			options: {
				map: true,
				processors: [
					require("autoprefixer")({
						browsers: "last 2 versions"
					}), // Add vendor prefixes.
					require("css-mqpacker")({
						sort: true
					})
				]
			},
			dist: {
				src: "*.css"
			}
		},
		cssnano: {
			options: {
				autoprefixer: false,
				safe: true
			},
			dist: {
				files: {
					"style.min.css": "style.css"
				}
			}
		},
		sassdoc: {
			default: {
				src: "assets/sass/**/*.scss"
			}
		},
		jshint: {
			files: ["Gruntfile.js", "assets/scripts/src/*.js"]
		},
		concat: {
			options: {
				banner:
					"/*! <%= pkg.name %> theme JS - This file is built with Grunt and should not be edited directly */\n\n",
				separator: "\n\n"
			},
			dist: {
				src: [
					"vendor/jquery-mobile/jquery.mobile.custom.min.js",
					"assets/scripts/src/utilities.js",
					"assets/scripts/src/skip-link-focus-fix.js",
					"assets/scripts/src/navigation.js",
					"assets/scripts/src/alcatraz.js", // This must be included after all other objects.
					"assets/scripts/src/init.js" // This should be last.
				],
				dest: "assets/scripts/<%= pkg.name %>-theme.js"
			}
		},
		uglify: {
			options: {
				banner:
					"/*! <%= pkg.name %> theme JS - This file is built with Grunt and should not be edited directly */\n",
				sourceMap: true
			},
			dist: {
				files: {
					"assets/scripts/<%= pkg.name %>-theme.min.js": [
						"<%= concat.dist.dest %>"
					]
				}
			}
		},
		watch: {
			css: {
				files: ["assets/sass/**/*.scss"],
				tasks: ["styles"],
				options: {
					livereload: true
				}
			},
			js: {
				files: ["<%= jshint.files %>"],
				tasks: ["scripts"]
			}
		},
		browserSync: {
			dev: {
				bsFiles: {
					src: ["*.php", "*.css", "assets/scripts/*.js"]
				},
				options: {
					watchTask: true,
					proxy: "alcatraz.local", // add your local dev url here.
					injectChanges: true
				}
			}
		},
		wp_readme_to_markdown: {
			your_target: {
				files: {
					"readme.md": "readme.txt"
				}
			}
		},
		makepot: {
			theme: {
				options: {
					cwd: "",
					domainPath: "languages/",
					potFilename: "alcatraz.pot",
					type: "wp-theme"
				}
			}
		}
	});

	// Configure tasks.
	grunt.registerTask("default", ["browserSync", "watch"]);

	grunt.registerTask("styles", ["sass", "postcss", "cssnano"]);
	grunt.registerTask("scripts", ["jshint", "concat", "uglify"]);
	grunt.registerTask("build", [
		"sass",
		"postcss",
		"jshint",
		"concat",
		"uglify",
		"wp_readme_to_markdown",
		"makepot"
	]);
};
