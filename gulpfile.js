// INCLUIDE GULP
var gulp = require('gulp');

// INCLUIDE PLUGINS
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

// TASK SASS
gulp.task('sass', function () {
	return gulp.src(['./sass/main.scss'])
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'expanded'
		}))
		.pipe(autoprefixer())
		.pipe(concat('style.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./'));
});

// WATCH FILES FOR CHANGES
gulp.task('watch', function () {
	gulp.watch('sass/*.scss', ['sass']);
});

// EXECUTE
gulp.task('default', ['sass', 'watch']);
