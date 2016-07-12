import path from 'path';
import webpack from 'webpack';
import ExtractTextPlugin from 'extract-text-webpack-plugin';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
var argv = require('minimist')(process.argv.slice(2));

// webpack --stable
const isDevelopment = Boolean(!argv.stable);
if (!isDevelopment) {
	console.log("\n_.~._.~._.~._ RUNNING WEBPACK IN PRODUCTION MODE _.~._.~._.~._\n");
}

export default {
	context: path.resolve('./'),
	cache: isDevelopment,
	debug: isDevelopment,

	// cheap-module-eval-source-map, because we want original source, but we don't
	// care about columns, which makes this devtool faster than eval-source-map.
	// http://webpack.github.io/docs/configuration.html#devtool
	devtool: isDevelopment ? 'cheap-module-eval-source-map' : '',

	entry: {app: "./js/app"},

	// Výstupní soubory...
	output: {
		pathinfo: true,
		filename: "./js/[name].min.js",
		chunkFilename: "./js/[id].js",
		sourceMapFilename: "./js/[name].min.js.map"
	},

	externals: {'jquery': 'jQuery'},

	resolve: {
		modulesDirectories: ['node_modules', 'public/js'],
		alias: {
			app: path.resolve("./js/"),
			boostrap: path.resolve("./node_modules/bootstrap/js/")
		},
		extensions: ['', '.js', '.jsx']
	},

	module: {
		loaders: [
			{test: /\.jsx?$/, loader: 'babel', include: /js/, query: {cacheDirectory: isDevelopment}},
			{test: /\.css/, loader: isDevelopment ? 'style!css' : ExtractTextPlugin.extract('style', 'css!postcss')},
			{
				test: /\.less$/,
				loader: isDevelopment ? 'style!css!less' : ExtractTextPlugin.extract('style', 'css!postcss!less')
			},
			{test: /\.jpe?g$|\.gif$|\.png$|\.ico$/, loader: 'file?name=img/[name].[ext]'},
			{test: /\.eot|\.ttf|\.svg|\.woff2?/, loader: 'file?name=fonts/[name].[ext]'}
		]
	},

	postcss: function () {
		return [autoprefixer, cssnano];
	},

	plugins: [
		new ExtractTextPlugin("style", "./style.css"),
	].concat(
			isDevelopment ? [] : [

				// https://github.com/webpack/docs/wiki/optimization#deduplication
				new webpack.optimize.DedupePlugin(),

				// https://github.com/webpack/docs/wiki/optimization#minimize
				new webpack.optimize.OccurrenceOrderPlugin(),

				// https://github.com/webpack/docs/wiki/optimization#minimize
				new webpack.optimize.UglifyJsPlugin(
						{
							//minimize: true,
							comments: false,
							sourceMap: false,
							pathinfo: false,
							compress: {screw_ie8: true, keep_fnames: true, warnings: false},
							mangle: {screw_ie8: true, keep_fnames: true, except: ['$', 'jQuery']}
						}
				)
			]
	)

};