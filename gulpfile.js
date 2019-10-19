require('dotenv').config();
const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass');
const minifyCSS = require('gulp-csso');
const browserSync = require('browser-sync').create();
const php = require('gulp-connect-php');

const phpServerPort = 8000;
const proxyAddr = process.env.BROWSER_SYNC_PROXY;

/** Start local php server */
function phpServer(cb) {
  php.server({base:'./', port:phpServerPort, keepalive:true});
  cb();
};

/** Compile all sass files to css and minimise */
function css() {
  return src('./scss/**/*.scss', { sourcemaps: true })
    .pipe(sass())
    .pipe(minifyCSS())
    .pipe(dest('./css'), { sourcemaps: true })
    .pipe(browserSync.stream());
}

/** Run browser-sync */
function browser() {
  let proxy = proxyAddr || `localhost:${phpServerPort}`;

  // proxy the php server to browser sync, reload when any php file is changed
  browserSync.init({
    proxy: proxy,
    files: ['./**/*.php'],
    notify: true
  });

  watch('./scss/**/*.scss', css);
  // watch('./js/*.js', js).on('change', browserSync.reload);
}

exports.css = css;
if(!proxyAddr) {
  exports.default = series(phpServer, browser);
} else {
  exports.default = browser;
}
