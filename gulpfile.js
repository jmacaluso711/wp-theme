var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    minifycss = require('gulp-minify-css'),
    prefix = require('gulp-autoprefixer'),
    livereload = require('gulp-livereload'),
    imagemin = require('gulp-imagemin');
    //Todo - Add svgstore
    //Todo - Add JS minifiy
    //Todo - Add combine-media-queries

gulp.task('sass', function() {
  return gulp.src('sass/style.scss')
    .pipe(sass({ style: 'compressed' }))
    .pipe(minifycss())
    .pipe(prefix({ cascade: true }))
    .pipe(gulp.dest('./'));
});

gulp.task('images', function() {
  return gulp.src('img/**/*')
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest('img'))
    .pipe(notify({ message: 'Images task complete' }));
});

gulp.task('default', function() {
   
   //livereload
   livereload.listen();

   // Watch .scss files
   gulp.watch('sass/**/*.scss', ['sass']);

   // Watch image files
   gulp.watch('img/**/*', ['images']);

});