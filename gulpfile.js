var source = require('vinyl-source-stream')
    gulp = require('gulp'),
    gutil = require('gulp-util'),
    browserify = require('browserify'),
    watchify = require('watchify'),
    notify = require('gulp-notify');

var sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    buffer = require('vinyl-buffer');

var svgmin = require('gulp-svgmin'),
    svgstore = require('gulp-svgstore'),
    cheerio = require('gulp-cheerio');

var browserSync = require('browser-sync'),
    reload = browserSync.reload;


/* 
    Styles
*/
gulp.task('styles',function() {
  // Compiles CSS
  gulp.src('scss/main.scss')
    .pipe(sass({
      style: 'compressed',
      errLogToConsole: false,
      onError: sassError
    }))
    .on('error', sassError)
    .pipe(autoprefixer())
    .pipe(minifycss())
    .pipe(gulp.dest('./build/css/'))
    .pipe(reload({stream:true}))
    .pipe(notify({message: "Sass compiled successfully!"}))
});

var sassError = function (error) {
    notify({
        title: 'Gulp Sass Error',
        message: 'Check the console.'
    }).write(error);

    console.log(error.toString());

    this.emit('end');
}

/*
  Images
*/
gulp.task('images',function(){
  gulp.src('img/**')
    .pipe(gulp.dest('./build/img'))
});

/*
  Browser Sync
*/
gulp.task('browser-sync', function() {
    browserSync({
        // we need to disable clicks and forms for when we test multiple rooms
        ghostMode: false
    });
});

function handleErrors() {
  var args = Array.prototype.slice.call(arguments);
  notify.onError({
    title: 'Compile Error',
    message: '<%= error.message %>'
  }).apply(this, args);
  this.emit('end'); // Keep gulp from hanging on this task
}

function buildScript(file, watch) {
  var props = {
    entries: ['./js/' + file],
    debug : true
  };

  // watchify() if watch requested, otherwise run browserify() once 
  var bundler = watch ? watchify(browserify(props)) : browserify(props);

  function rebundle() {
    var stream = bundler.bundle();
    return stream
      .on('error', handleErrors)
      .pipe(source(file))
      .pipe(gulp.dest('./build/js'))
      // If you also want to uglify it
      // .pipe(buffer())
      // .pipe(uglify())
      // .pipe(rename('main.min.js'))
      // .pipe(gulp.dest('./build/js'))
      .pipe(reload({stream:true}))
      .pipe(notify({message: "JS compiled successfully!"}))
  }

  // listen for an update and run rebundle
  bundler.on('update', function() {
    rebundle();
    gutil.log('Rebundle...');
  });

  // run it once the first time buildScript is called
  return rebundle();
}

gulp.task('scripts', function() {
  return buildScript('main.js', false); // this will run once because we set watch to false
});

// run 'scripts' task first, then watch for future changes
gulp.task('default', ['images','styles','scripts', 'browser-sync'], function() {
  gulp.watch('scss/**/*', ['styles']); // gulp watch for sass changes
  return buildScript('main.js', true); // browserify watch for JS changes
});