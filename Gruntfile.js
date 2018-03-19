module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

	    cssmin: {
	      build: {
	        files: {
	          'style.min.css': 'style.css',
	        }
	      }
	    },

	    uglify: {
	      build: {
	        files: {
	          'js/custom.min.js': 'js/custom.js'
	        }
	      }
	    },

		watch: {
		    livereload: {
		        options: { livereload: true },
		        files: [
		            '*.css',
		            '*.html',
		            '*.php',
		            '*/*.php',
		            '*/*/*.php',
		            '*/*/*/*.php',
		        ]
		    }
		}



	});

	// Load the plugin
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.loadNpmTasks('grunt-contrib-csslint');

	// Do the task
	grunt.registerTask('default', ['cssmin', 'uglify', 'watch', 'csslint']);

};