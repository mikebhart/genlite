const autoprefixer = require("autoprefixer");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const CleanPlugin = require("clean-webpack-plugin");
const CopyPlugin = require('copy-webpack-plugin');


module.exports = (env, argv) => {
    function isDevelopment() {
        return argv.mode === "development";
    }
    var config = {
        entry: {
            main: "./src/js/main.js"
        },
        output: {
            filename: "./js/[name].js"
        },
        optimization: {
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        output: {
                            comments: false
                        }
                    },
                    sourceMap: false
                }),
                new OptimizeCSSAssetsPlugin({
                    cssProcessorOptions: {
                        map: {
                            inline: false,
                            annotation: true
                        }
                    }
                })
            ]
        },
        plugins: [
            new CleanPlugin(),
            new MiniCSSExtractPlugin({
                chunkFilename: "[id].css",
                filename: chunkData => {
                    return chunkData.chunk.name === "script" ? "style.css" : "./css/[name].css";
                }
            }),
            new CopyPlugin([
                { from: 'node_modules/echo-js/dist/echo.min.js', to: '../dist/js/echo.js' },
                { from: 'node_modules/@fortawesome/fontawesome-free/webfonts', to: '../dist/webfonts/' },
                { from: 'node_modules/@fortawesome/fontawesome-free/css/all.min.css', to: '../dist/css/fontawesome.css' },
                { from: 'node_modules/@barba/core/dist/barba.js', to: '../dist/js/barba.js'},
                { from: 'node_modules/gsap//dist/gsap.min.js', to: '../dist/js/gsap.js'}
            ])
        ],
        devtool: isDevelopment() ? "cheap-module-source-map" : "source-map",
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: "babel-loader",
                        options: {
                            presets: [
                                "@babel/preset-env",
                                [
                                    "@babel/preset-react",
                                    {
                                        pragma: "wp.element.createElement",
                                        pragmaFrag: "wp.element.Fragment",
                                        development: isDevelopment()
                                    }
                                ]
                            ],
                            plugins: ["@babel/plugin-proposal-class-properties"]
                        }
                    }
                },
                {
                    test: /\.(sa|sc|c)ss$/,
                    use: [
                        MiniCSSExtractPlugin.loader,
                        "css-loader",
                        {
                            loader: "postcss-loader",
                            options: {
                                plugins: [autoprefixer()]
                            }
                        },
                        "sass-loader"
                    ]
                },
 
            ]
            
        },
        externals: {
            jquery: "jQuery",
            react: "React",
            "react-dom": "ReactDOM",
            "@wordpress/blocks": ["wp", "blocks"],
            "@wordpress/editor": ["wp", "editor"],
            "@wordpress/components": ["wp", "components"],
            "@wordpress/elements": ["wp", "elements"]
        }
    };
    return config;
};
