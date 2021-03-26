/**
 * Import config
 */
var config = require("./config.json");

/**
 * Import plugins
 */
const gulp = require("gulp"),
  browserSync = require("browser-sync").create(),
  cleanCSS = require("gulp-clean-css"),
  plugins = require("gulp-load-plugins")();

/**
 * Process styles
 */
function styles() {
  return gulp
    .src("./assets/scss/main.scss")
    .pipe(plugins.plumber())
    .pipe(plugins.sassGlob())
    .pipe(plugins.sass())
    .pipe(gulp.dest("./dist/css"))
    .pipe(cleanCSS(config.optimization.cleanCSS))
    .pipe(plugins.rename({ extname: ".min.css" }))
    .pipe(gulp.dest("./dist/css"))
    .pipe(browserSync.stream());
}
exports.styles = styles;
styles.description = "Procesar CSS";

/**
 * Process javascript
 */
function scripts() {
  return gulp
    .src(["./assets/js/**/*.js"])
    .pipe(plugins.plumber())
    .pipe(plugins.concat("main.js"))
    .pipe(gulp.dest("./dist/js"))
    .pipe(plugins.terser(config.optimization.terser))
    .pipe(plugins.rename({ extname: ".min.js" }))
    .pipe(gulp.dest("./dist/js"))
    .pipe(browserSync.stream());
}
exports.scripts = scripts;
scripts.description = "Process Javascript";

/**
 * Serve site
 */
function serve() {
  browserSync.init({
    proxy: config.site.URL,
  });
  gulp.watch("./assets/scss/**/*.scss", styles);
  gulp.watch("./assets/js/**/*.js", scripts);
  gulp
    .watch(["./**/*.php", "./dist/**/*.css", "./dist/**/*.js"])
    .on("change", browserSync.reload);
}

exports.serve = serve;
serve.description =
  "Ejecutar server, observar cambios y reprocesar/recargar si hay cambios";

/**
 * Default task
 */
exports.default = gulp.parallel(styles, scripts, serve);
