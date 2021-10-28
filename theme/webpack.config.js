const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CopyPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

let mode = "development";
let target = "web";

const plugins = [
  new CleanWebpackPlugin(),
  new MiniCssExtractPlugin(),
  new CopyPlugin({
	patterns: [
	  { from: 'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js', to: '../dist/' },
	  { from: 'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.css', to: '../dist/' },
	  { from: 'node_modules/@fortawesome/fontawesome-free/webfonts', to: '../dist/webfonts/' },
	  { from: 'node_modules/@fortawesome/fontawesome-free/css/all.min.css', to: '../dist/fa/fontawesome.css' },
	],
  }),
];

module.exports = {
  // mode defaults to 'production' if not set
  mode: mode,
  stats: {
    children: true,
  },
  performance: {
	hints: false,
	maxEntrypointSize: 1512000,
	maxAssetSize: 1512000
  },	


  // This is unnecessary in Webpack 5, because it's the default.
  // However, react-refresh-webpack-plugin can't find the entry without it.
  entry: "./assets/scripts/index.js",

  output: {
    // output path is required for `clean-webpack-plugin`
    path: path.resolve(__dirname, "dist"),
    // this places all images processed in an image folder
    // assetModuleFilename: "images/[hash][ext][query]",
  },

  module: {
    rules: [
      {
        test: /\.(s[ac]|c)ss$/i,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            // This is required for asset imports in CSS, such as url()
            options: { publicPath: "" },
          },
          "css-loader",
        //   "postcss-loader",
          // according to the docs, sass-loader should be at the bottom, which
          // loads it first to avoid prefixes in your sourcemaps and other issues.
          "sass-loader",
        ],
      },
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: {
          // without additional settings, this will reference .babelrc
          loader: "babel-loader",
          options: {
            /**
             * From the docs: When set, the given directory will be used
             * to cache the results of the loader. Future webpack builds
             * will attempt to read from the cache to avoid needing to run
             * the potentially expensive Babel recompilation process on each run.
             */
            cacheDirectory: true,
          },
        },
      },
    ],
  },

  plugins: plugins,

  target: target,

  devtool: "source-map",

  resolve: {
    extensions: [".js", ".jsx"],
  },

};
