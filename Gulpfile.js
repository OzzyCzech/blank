var gulp = require("gulp"), gutil = require("gulp-util");

var coffee = require("gulp-coffee"),
		imagemin = require("gulp-imagemin"),
		compiler = require("gulp-closure-compiler"),
		less = require("gulp-less"),
		concat = require("gulp-concat"),
		exec = require("gulp-exec");

gulp.task("css", function () {
	gulp.src("style.less")
			.pipe(less({compress: true}))
			.pipe(gulp.dest("."));
});

gulp.task("coffee", function () {
	gulp.src("js/**/*.coffee")
			.pipe(coffee({bare: true}).on("error", gutil.log))
			.pipe(gulp.dest("js"))
});

gulp.task('img', function () {
	gulp.src('img/**/*')
			.pipe(imagemin())
			.pipe(gulp.dest('img'));
});

gulp.task("concat", function () {
	var scripts = [
		"js/main.js"
	];

	gulp.src(scripts)
			.pipe(concat("blank.min.js"))
			.pipe(gulp.dest("js"))
});

gulp.task("minify", ["coffee", "concat"], function () {
	gulp.src("js/blank.min.js")
			.pipe(compiler())
			.pipe(gulp.dest("js"));
});

gulp.task("js", ["coffee", "minify"]);
gulp.task("default", ["js", "css"]);
