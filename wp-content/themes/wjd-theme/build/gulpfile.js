var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var pump = require('pump');

gulp.task('styles', function() {
    return gulp.src('../scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(
            sass({
                outputStyle: 'compressed'
            }).on(
                'error', sass.logError
            )
        )
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 20 versions'],
            cascade: false
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('../'))
});

gulp.task('scripts', function() {
    return pump([
        gulp.src(['../js/*.js', '!../js/*.min.js'], { base: './' }),
        rename({
            suffix: '.min'
        }),
        uglify(),
        gulp.dest('./')
    ]);
});

//Watch task
gulp.task('theme-watcher',function() {
    gulp.watch('../scss/**/*.scss', ['styles']);
    gulp.watch(['../js/*.js', '!../js/*.min.js'], ['scripts']);
});