var gulp = require('gulp'),
   sass = require('gulp-ruby-sass'),
   minifycss = require('gulp-minify-css'),
   uglify = require('gulp-uglify'),
   autoprefixer = require('gulp-autoprefixer'),
   svgmin = require('gulp-svgmin'),
   svgstore = require('gulp-svgstore'),
   cheerio = require('gulp-cheerio');

gulp.task('sass', function() {
   return sass('scss/main.scss', {style: 'compressed'}) 
      .on('error', function (err) {
         console.error('Error', err.message);
      })
      .pipe(autoprefixer({
         browsers: ['last 2 versions'],
         cascade: false
      }))
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
      }))
      .pipe(cheerio(function($) {
        $('svg').attr('style', 'display:none');
      }))
      .pipe(gulp.dest('img/svg-sprite/'))
});

gulp.task('default', function() {

   // SVG Sprite
   gulp.watch('svg/*.svg',['svg']);

   // Watch .scss files
   gulp.watch('scss/**/*.scss', ['sass']);

   // Watch .js files
   gulp.watch('js/*.js', ['compress']);

});