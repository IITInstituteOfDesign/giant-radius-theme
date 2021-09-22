var browserify = require('browserify');
var gulp = require('gulp');
var bower = require('main-bower-files');
var transform = require('vinyl-transform');
var $ = require('gulp-load-plugins')();

function handleError(err) {
  console.error(err.toString());
  this.emit('end');
}

gulp.task('scripts', ['scripts:lint']);

gulp.task('scripts:lint', function() {
  return gulp.src('assets/javascripts/src/**/*.js')
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'))
    .pipe($.jshint.reporter('fail'));
});

gulp.task('styles', ['styles:compile']);

gulp.task('styles:compile', function() {
  return gulp.src([
    'assets/stylesheets/src/main.less',
    'assets/stylesheets/src/admin.less'
    ]).pipe($.less({
      paths: [ 'vendor/' ]
    }))
    .on('error', handleError)
    .pipe($.autoprefixer({ browsers: ['last 2 versions'] }))
    .pipe(gulp.dest('assets/stylesheets'));
});

gulp.task('watch', ['build'], function() {
  $.livereload.listen();

  gulp.watch([
    'assets/javascripts/*.js',
    'assets/stylesheets/*.css',
    '**/*.php'
    ]).on('change', $.livereload.changed);

    gulp.watch('assets/javascripts/src/**/*.js', ['scripts:bundle']);
    gulp.watch('assets/stylesheets/src/**/*.less', ['styles']);
  });

gulp.task('build', ['scripts','styles'], function () {});

gulp.task('default', function() {
  gulp.start('build');
});
