const gulp = require('gulp');
const postcss = require('gulp-postcss');
const postcssnext = require('postcss-cssnext');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const browserify = require('browserify');
const browserSync = require('browser-sync');
const buffer = require('vinyl-buffer');
const source = require('vinyl-source-stream');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const svgmin = require('gulp-svgmin');
const svgstore = require('gulp-svgstore');
const cheerio = require('gulp-cheerio');
const rename = require('gulp-rename');

/*
  Paths
*/
const paths = {
  css: './css/',
  js: './js/',
  svg: './svg/',
  dist: './dist'
}

/*
  Error Handlers
*/
function handleCSSErrors(err) {
  notify.onError({
    title: 'Gulp error in ' + err.plugin,
    message: err.toString()
  })(err);
}

function handleJSErrors() {
  const args = Array.prototype.slice.call(arguments);
  notify.onError({
    title: 'Compile Error',
    message: '<%= error.message %>'
  }).apply(this, args);
  this.emit('end');
}

/*
  CSS
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


/*
   SVG
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

/*
  JS
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

/*
  Browser Sync
*/
gulp.task('browser-sync', function () {
  const config = {
    ghostMode: false,
    // server: {
    //   baseDir: "./"
    // }
  };
  return browserSync(config);
});

/*
  Watch
*/
gulp.task('watch', function () {
  gulp.watch(`${paths.js}/**/*.js`, ['js']);
  gulp.watch(`${paths.css}/**/*.css`, ['css']);
  gulp.watch(`${paths.svg}/*.svg`, ['svg']);
});

/*
  Run
*/
gulp.task('run', ['js', 'css', 'svg', 'watch', 'browser-sync']);
