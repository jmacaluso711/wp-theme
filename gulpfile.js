const gulp = require('gulp'),
      postcss = require('gulp-postcss'),
      postcssnext = require('postcss-cssnext'),
      cssnano = require('cssnano'),
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
  css: './css/',
  js: './js/',
  svg: './svg/',
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
 * CSS
 */
gulp.task('css', function () {
  const plugins = [
    postcssnext(),
    cssnano()
  ];
  return gulp.src(`${paths.css}/main.css`)
    .pipe(plumber({
      errorHandler: function (err) {
        handleCSSErrors(err)
      }
    }))
    .pipe(sourcemaps.init())
    .pipe(postcss(plugins))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(`${paths.dist}/css`))
    .pipe(browserSync.reload({ stream: true }))
    .pipe(notify('CSS Success!'));
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
  return browserify(`${paths.js}/main.js`, { debug: true, extensions: ['es6'] })
    .transform("babelify", { presets: ["es2015"] })
    .bundle()
    .on('error', handleJSErrors)
    .pipe(source('bundle.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(`${paths.dist}/js/`))
    .pipe(browserSync.reload({ stream: true }))
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
  gulp.watch(`${paths.css}/**/*.css`, ['css']);
  gulp.watch(`${paths.svg}/*.svg`, ['svg']);
});

/**
 * Build
 */
gulp.task('build', ['js', 'css', 'svg']);

/**
 * Dev
 */
gulp.task('dev', ['js', 'css', 'svg', 'watch', 'browser-sync']);
