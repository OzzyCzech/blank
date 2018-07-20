require('dotenv').config();

import path from 'path';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import HtmlWebpackHarddiskPlugin from 'html-webpack-harddisk-plugin';

const isHot = process.argv.indexOf('--hot') !== -1; // detect --hot
const isDev = process.argv.indexOf('development') !== -1; // detect --mode development

console.info("Webpack " + (isHot ? "running hot-reload sever" : "building output") + " in " + (isDev ? "DEVELOPMENT" : "PRODUCTION") + " mode");

const app = {

	context: path.resolve('.'),

	entry: {
		app: "./src/js/index.js"
	},

	output: {
		path: path.resolve(__dirname, './dist'),
		publicPath: isDev ? "http://" + process.env.HOST + ":8080/dist" : "/wp-content/themes/" + path.basename(__dirname) + "/dist/",
		filename: isDev ? '[name].js' : '[name].[chunkhash].js',
		chunkFilename: isDev ? '[name].js' : '[name].[chunkhash].js'
	},

	resolve: {
		modules: [path.resolve(__dirname, "src"), "node_modules"]
	},


	devServer: {
		overlay: true,
		contentBase: path.join(__dirname),
		compress: true,
		host: process.env.HOST,
		port: 8080,
		disableHostCheck: true,
		allowedHosts: [process.env.HOST],
		headers: {'Access-Control-Allow-Origin': '*'}
	},

	// @see https://webpack.js.org/configuration/devtool/
	// in DEVELOPMENT mode is set to eval by default but we need maps also...
	devtool: isDev ? "cheap-eval-source-map" : false,

	module: {
		rules: [

			// JS
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {loader: "babel-loader"},
			},

			// CSS
			{
				test: /\.css$/,
				use: [
					MiniCssExtractPlugin.loader,
					"css-loader", "postcss-loader"
				]
			},

			// images & fonts loader
			{
				test: /\.(jpe?g|png|gif|webp|eot|ttf|woff|woff2|svg|)$/i,
				use: [
					{loader: "url-loader", options: {limit: 1000, name: "assets/[name].[hash].[ext]"}}
				]
			}

		]
	},

	plugins: [

		new HtmlWebpackPlugin({title: '', alwaysWriteToDisk: true, minify: {}}),

		// Always write HTML to disc
		new HtmlWebpackHarddiskPlugin(),

	].concat(isHot ? [] : [
		// Extract CSS to file when is not HMR mode...
		new MiniCssExtractPlugin({
			filename: isDev ? 'css/[name].css' : 'css/[name].[contenthash].css',
			chunkFilename: 'css/[id].css'
		})
	]),

};

module.exports = app;
