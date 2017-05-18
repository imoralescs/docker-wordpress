var themeName = "theme-name";
var fs = require('fs');
var gulp = require('gulp');
var notify = require('gulp-notify');
var sourcemaps = require('gulp-sourcemaps');
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');
var gutil = require('gulp-util');
var watchify = require('watchify');

// Import Theme 
gulp.task('wordpress:import', function() {
  gutil.log('Copying Theme to Wordpress...');
  return gulp.src(['./wp-content/themes/**/*.{php,css,js,map}'])
    .pipe(gulp.dest('./www/html/wp-content/themes/'))
});

// Rename Theme Directory
gulp.task('wordpress:rename', function(done) {
  fs.rename('./www/html/wp-content/themes/theme-name', './www/html/wp-content/themes/' + themeName, function (err) {
    if (err) {
      throw err;
    }
    done();
  });
});

// Sass Task
gulp.task('wordpress:css', function() {
	var gulpSass = require('gulp-sass');
	var bourbon = require('node-bourbon');

  gutil.log('Compiling SCSS...');

	var sassOptions = {
		errLogToConsole: true,
		linefeed: 'lf', // 'lf'/'crlf'/'cr'/'lfcr'
		outputStyle: 'compressed', // 'nested','expanded','compact','compressed'
		sourceComments: false,
		includePaths: bourbon.includePaths
	};

	return gulp.src('./development/sass/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe(gulpSass(sassOptions))
		.on("error", notify.onError({
			message: 'Error: <%= error.message %>'
		}))
		.pipe(sourcemaps.write('../maps'))
		.pipe(gulp.dest('./www/html/wp-content/themes/' + themeName +'/assets/css'));

});

// Input file.
var bundler = watchify(browserify({entries: './development/js/app.js', extensions: ['.js'], paths: ['./development/js','./development/js/modules'], debug: true}));

// Babel Transform
bundler.transform('babelify', {presets: ['es2015', 'stage-2']});

// On update recopile
bundler.on('update', bundle);

function bundle() {

  gutil.log('Compiling JS...');

  return bundler.bundle()
      .on('error', function (err) {
              gutil.log(err.message);
              this.emit("end");
      })
      .pipe(source('bundle.js'))
      .pipe(gulp.dest('./www/html/wp-content/themes/' + themeName +'/assets/js'));
}

// JS Task
gulp.task('wordpress:js', function () {
  return bundle();
});

gulp.task('default', ['wordpress:css', 'wordpress:js'], function(){
  gulp.watch('./development/sass/**/*.scss', ['wordpress:css']);
	gulp.watch('./development/js/**/*.js', ['wordpress:js']);
});
