module.exports = (grunt) ->

  grunt.initConfig

    bump:
      files:['package.json', 'component.json', 'bower.json', 'composer.json']
      push: false

    recess:
      lint:
        options:
          noIDs: false
          strictPropertyOrder: false
          zeroUnits: false
        src: 'style.less'
      compile:
        options:
          compile: true
          compress: true
          noIDs: false
        files:
          'style.css': [ 'style.less' ]

    coffee:
      options:
        bare: true
      app:
        files: [
          expand: true
          src: ['js/**/*.coffee' ]
          ext: '.js'
        ]

    clean:
      js: ["js/**/*.js", 'Gruntfile.js']
      css: ["css/**/*.css"]


    closureCompiler:
      options:
        compilerFile: 'components/closure-compiler/compiler.jar'
        checkModified: false
        compilerOpts:
          compilation_level: 'SIMPLE_OPTIMIZATIONS'
          summary_detail_level: 3
      zdrojak:
        src: ['js/main.js']
        dest: 'js/main.min.js'


  grunt.loadNpmTasks 'grunt-closure-tools'
  grunt.loadNpmTasks 'grunt-contrib-coffee'
  grunt.loadNpmTasks 'grunt-contrib-clean'
  grunt.loadNpmTasks 'grunt-recess'
  grunt.loadNpmTasks 'grunt-bump'


  grunt.registerTask 'css', ['recess:compile']
  grunt.registerTask 'js', ['coffee']


  grunt.registerTask 'default', ['clean', 'css', 'js']
  grunt.registerTask 'production', ['default', 'closureCompiler']
