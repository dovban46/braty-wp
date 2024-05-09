'use strict';require('@babel/register');
const template = 'wp-content/themes/braty/';
const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const concat = require('gulp-concat')
const autoprefixer = require('gulp-autoprefixer')
const cssnano = require('gulp-cssnano')
const rename = require('gulp-rename')
const webpack = require('webpack')
const webpackStream = require('webpack-stream')
const CompressionPlugin = require('compression-webpack-plugin')
const TerserPlugin = require('terser-webpack-plugin')
// Define tasks using arrow functions.
const compileCss = () => {
  return gulp    .src(`${template}/src/scss/main.scss`)
    .pipe(sass().on('error', sass.logError))    .pipe(autoprefixer('last 2 versions'))
    .pipe(cssnano())    .pipe(concat('main.css'))
    .pipe(rename({ suffix: '.min' }))    .pipe(gulp.dest(`${template}/dist`));
};
const compileJs = () => {  return gulp
    .src(`${template}/src/js/main.js`)    .pipe(
      webpackStream({        mode: 'production',
        output: {          filename: '[name].min.js',
          chunkFilename: 'vendors.min.js'        },
        module: {          rules: [
            {              test: /\.(js)$/,
              exclude: /(node_modules)/,              loader: 'babel-loader',
              options: {                presets: ['@babel/preset-env']
              }            }
          ]        },
        optimization: {          minimize: true,
          minimizer: [new TerserPlugin()],          splitChunks: {
            cacheGroups: {              commons: {
                test: /[\\/]node_modules[\\/]/,                name: 'vendors',
                chunks: 'all'              }
            }          }
        },        plugins: [
          new CompressionPlugin(),          new webpack.ProvidePlugin({
            $: 'jquery',            jQuery: 'jquery'
          })        ]
      }),      webpack
    )    .on('error', error => {
      console.error(error);    })
    .pipe(gulp.dest(`${template}/dist`));};
const compileVendorJs = () => {
  return gulp    .src(`${template}/js/vendors/*.js`)
    .pipe(concat('vendors.min.js'))    .pipe(gulp.dest('dist'));
};
const watchFiles = () => {  gulp.watch(`${template}src/scss/**/*.scss`, compileCss);
  gulp.watch(`${template}src/js/**/*.js`, compileJs);};
const build = gulp.series(compileCss, compileJs, watchFiles);
// Export tasks.
exports.compileCss = compileCssexports.compileJs = compileJs
exports.compileVendorJs = compileVendorJs
exports.watch = watchFilesexports.build = build
exports.default = build