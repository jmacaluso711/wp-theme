const gulp = require('gulp'),
  autoprefixer = require('autoprefixer'),
  postcss = require('gulp-postcss'),
  cssnano = require('cssnano'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  browserify = require('browserify'),
  browserSync = require('browser-sync'),
  buffer = require('vinyl-buffer'),
  source = require('vinyl-source-stream'),
  plumber = require('gulp-plumber'),
  notify = require('gulp-notify'),
  svgmin = require('gulp-svgmin'),
  svgstore = require('gulp-svgstore'),
  cheerio = require('gulp-cheerio'),
  rename = require('gulp-rename');

/**
 * Paths
 */
const paths = {
  scss: './assets/scss/',
  js: './assets/js/',
  svg: './assets/svg/',
  dist: './dist'
}

/**
 * CSS Error Handler
 * @param {Object} err
 */
function handleCSSErrors(err) {
  notify.onError({
    title: 'Gulp error in ' + err.plugin,
    message: err.toString()
  })(err);
}

/**
 * JS Error Handler
 */
function handleJSErrors() {
  const args = Array.prototype.slice.call(arguments);
  notify.onError({
    title: 'Compile Error',
    message: '<%= error.message %>'
  }).apply(this, args);
  this.emit('end');
}

/**
 * SCSS
 */
gulp.task('sass', function () {
  return gulp.src(`${paths.scss}/main.scss`)
    .pipe(plumber({
      errorHandler: function (err) {
        handleCSSErrors(err)
      }
    }))
    .pipe(sourcemaps.init())
    .pipe(postcss([autoprefixer()]))
    .pipe(sass({ outputStyle: 'compressed' }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(`${paths.dist}/css`))
    .pipe(browserSync.stream({ match: '**/*.scss' }))
    .pipe(notify('SCSS Success!'));
});

/**
 * SVG
 */
gulp.task('svg', function (svg) {
  return gulp
    .src(`${paths.svg}/*.svg`)
    .pipe(svgmin())
    .pipe(rename({
      prefix: 'icon-'
    }))
    .pipe(svgstore({
      inlineSvg: true
    }))
    .pipe(cheerio({
      run: function ($) {
        $('[fill]').removeAttr('fill');
        $('svg').attr('style', 'display:none');
        $('svg').attr('width', 0);
        $('svg').attr('height', 0);
      },
      parserOptions: { xmlMode: false }
    }))
    .pipe(gulp.dest('img/svg-sprite/'))
});

/**
 * JS Build
 */
gulp.task('js', function () {
  return browserify(`${paths.js}/main.js`, { debug: true })
    .transform("babelify", { presets: ["@babel/preset-env"] })
    .bundle()
    .on('error', handleJSErrors)
    .pipe(source('bundle.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(`${paths.dist}/js/`))
    .pipe(browserSync.stream({ match: '**/*.js' }))
    .pipe(notify('JS Success!'));
});

/**
 * Browser sync
 */
gulp.task('browser-sync', function () {
  const config = {
    ghostMode: false,
  };
  return browserSync(config);
});

/**
 * Watch
 */
gulp.task('watch', function () {
  gulp.watch(`${paths.js}/**/*.js`, ['js']);
  gulp.watch(`${paths.scss}/**/*.scss`, ['sass']);
  gulp.watch(`${paths.svg}/*.svg`, ['svg']);
});

/**
 * Build
 */
gulp.task('build', ['js', 'sass', 'svg']);

/**
 * Dev
 */
gulp.task('dev', ['js', 'sass', 'svg', 'watch', 'browser-sync']);
