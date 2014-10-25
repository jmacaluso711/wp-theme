var gulp = require('gulp'),
   sass = require('gulp-ruby-sass'),
   minifycss = require('gulp-minify-css'),
   uglify = require('gulp-uglify'),
   prefix = require('gulp-autoprefixer'),
   livereload = require('gulp-livereload'),
   svgmin = require('gulp-svgmin'),
   svgstore = require('gulp-svgstore');

gulp.task('sass', function() {
   return gulp.src('sass/style.scss')
      .pipe(sass({ style: 'compressed' }))
      .pipe(minifycss())
      .pipe(prefix({ cascade: true }))
      .pipe(gulp.dest('./'));
});

gulp.task('compress', function() {
   gulp.src('js/*.js')
      .pipe(uglify())
      .pipe(gulp.dest('js/dist'))
});

gulp.task('svg', function(){
   return gulp.src('svg/*.svg')
      .pipe(svgmin())
      .pipe(svgstore({ 
         fileName: 'icons.svg',
         prefix: 'icon-',
         inlineSvg: true,
         transformSvg: function transformSvg (svg, cb) {
            svg.attr({ style: 'display:none' })
            cb(null)
         }
      }))
      .pipe(gulp.dest('img/svg-sprite/'))
});

gulp.task('default', function() {
   
   //livereload
   livereload.listen();

   // SVG Sprite
   gulp.watch('svg/*.svg',['svg']);

   // Watch .scss files
   gulp.watch('scss/**/*.scss', ['sass']);

   // Watch .js files
   gulp.watch('js/*.js', ['compress']);

});