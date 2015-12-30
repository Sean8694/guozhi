var gulp = require('gulp'),
    newer = require('gulp-newer'),
    imagemin = require('gulp-imagemin');

gulp.task('generate-img', function () {
    return gulp.src('Public/**/*.{jpg,png,gif,ico}')
        .pipe(newer('dist/img'))
        .pipe((imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        })))
        .pipe(gulp.dest('dist/img'));
});