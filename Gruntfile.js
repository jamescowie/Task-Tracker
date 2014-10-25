module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: 'src/<%= pkg.name %>.js',
                dest: 'build/<%= pkg.name %>.min.js'
            }
        },
        php: {
            test: {
                options: {
                    keepalive: true,
                    open: false,
                    port: 8000,
                    base: "web"
                }
            },
            watch: {}
        },
        bower_concat: {
            all: {
                dest: 'web/build/_bower.js',
                cssDest: 'web/build/_bower.css',
                dependencies: {
                    'underscore': 'jquery',
                    'backbone': 'underscore',
                    'jquery-mousewheel': 'jquery'
                },
                bowerOptions: {
                    relative: false
                }
            }
        },
        injector: {
            options: {
                addRootSlash: false,
                ignorePath: "web"
            },
            local_dependencies: {
                files: {
                    'app/views/layout.html': ['web/**/*.js', 'web/**/*.css']
                }
            }
        },
        coffee: {
            compile: {
                files: {
                    'web/main.js': ['web/coffee/*.coffee'] // compile and concat into single file
                }
            }
        },
        sass: {                              // Task
            dist: {                            // Target
                options: {                       // Target options
                    style: 'expanded',
                    sourcemap: false
                },
                files: {                         // Dictionary of files
                    'web/main.css': 'web/sass/main.scss'
                }
            }
        },
        watch: {
            css: {
                files: 'web/sass/*.scss',
                tasks: ['sass'],
                options: {
                    livereload: true,
                },
            },
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-bower-concat');
    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-injector');
    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', ['uglify', 'bower_concat', 'sass', 'coffee', 'injector', 'php']);

    grunt.registerTask('server', 'Running PHP Server', function() {
        grunt.log.writeln('Running php server');
        grunt.task.run('php');
    })

    grunt.registerTask('phpwatch', ['php:watch', 'watch']);
};
