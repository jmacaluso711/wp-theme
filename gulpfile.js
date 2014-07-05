var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    minifycss = require('gulp-minify-css'),
    imagemin = require('gulp-imagemin');

gulp.task('sass', function() {
  return gulp.src('scss/main.scss')
    .pipe(sass({ style: 'compressed' }))
    .pipe(minifycss())
    .pipe(gulp.dest('scss/css'));
});

gulp.task('images', function() {
  return gulp.src('images/**/*')
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest('img'))
    .pipe(notify({ message: 'Images task complete' }));
});

gulp.task('watch', function() {
   
   // Watch .scss files
   gulp.watch('scss/**/*.scss', ['sass']);

   // Watch image files
   gulp.watch('images/**/*', ['images']);

});