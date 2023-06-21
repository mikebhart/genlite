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
            { from: 'assets/images/', to: '../dist/images/' },
		],
  	}),
];

module.exports = {
	mode: mode,
  	stats: {
    	children: true,
  	},
  	performance: {
		hints: false,
		maxEntrypointSize: 1512000,
		maxAssetSize: 1512000
  	},
  	watchOptions: {
    	aggregateTimeout: 0,
		ignored: '**/node_modules',
    	poll: 100,
  	},	
  	entry: "./assets/scripts/index.js",
  	output: {
		path: path.resolve(__dirname, "dist"),
  	},
  	module: {
    	rules: [
      		{
        		test: /\.(s[ac]|c)ss$/i,
        		use: [
						{
							loader: MiniCssExtractPlugin.loader,
							options: { publicPath: "" },
						},
          				"css-loader",
          				"sass-loader",
        			],
      		},
      		{
				test: /\.jsx?$/,
				exclude: /node_modules/,
				use: {
          			loader: "babel-loader",
          			options: {
            			cacheDirectory: true,
          			},
        		},
      		},
            {
                test: /\.(svg|eot|woff|ttf|svg|woff2|otf)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: "[path][name].[ext]"
                        }
                    }
                ]
            }
    	],
  	},
  	plugins: plugins,
  	target: target,
  	devtool: "source-map",
  	resolve: {
    	extensions: [".js", ".jsx"],
  	},
};

