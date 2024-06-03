const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const cleanCSS = require('gulp-clean-css');
const path = require('path');

const PATHS = {
    blockScss: "./src/Blocks/**/*.scss",
    blockDist: "./src/Blocks/**/",
    scss: "./assets/styles/sass/style.scss",
    config: "./tailwind.config.js",
    dist: "./"
};
function compileStyles() {
    return src(PATHS.scss)
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([tailwindcss(PATHS.config), autoprefixer]))
        .pipe(cleanCSS())
        .pipe(dest(PATHS.dist));
}

function compileBlockStyles() {
    return src(PATHS.blockScss)
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([tailwindcss(PATHS.config), autoprefixer]))
        .pipe(cleanCSS())
        .pipe(dest(function (){
            return path.join(__dirname, 'src/Blocks');
        }));
}

function watchStyles() {
    watch('./assets/styles/sass/**/*.scss', compileStyles);
    watch(PATHS.blockScss, compileBlockStyles);
}


exports.default = series(compileStyles, compileBlockStyles, watchStyles);
