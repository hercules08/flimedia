/**
 * When passed a string, Glob will attempt to find each file that matches the
 * path given and return each path to the file as string[]
 */
const glob = require("glob");

/**
 * The Path API will be used to get the absolute path to the directory where we
 * plan to run Webpack
 */
const path = require("path");

const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const RemoveEmptyScriptsPlugin = require("webpack-remove-empty-scripts");
var LiveReloadPlugin = require('webpack-livereload-plugin');

/* ---------------
 * Main config
 * We will place here all the common settings
 * ---------------*/
var config = {
  devtool: "source-map",
  externals: {
    jquery: "jQuery",
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: ["babel-loader"],
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: "",
            },
          },
          {
            loader: "css-loader",
            options: {
              sourceMap: true, // <-- !!IMPORTANT!!
            },
          },

          {
            loader: "resolve-url-loader",
            options: {
              root: "",
              sourceMap: true, // <-- !!IMPORTANT!!
            },
          },
          {
            loader: "sass-loader",
            options: {
              sourceMap: true, // <-- !!IMPORTANT!!
            },
          },
        ],
      },
      {
        test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
        generator: {
          filename: "img/[name][ext]",
          emit: false,
        },
        use: {
          loader: "file-loader",
          options: {
            name: "[name].[ext]",
            outputPath: "./img/",
          },
        },
      },
      {
        test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
        type: "asset/resource",
        generator: {
          filename: "fonts/[name][ext]",
          emit: false,
        },
        exclude: [/node_modules/],
        use: {
          loader: "file-loader",
          options: {
            name: "[name].[ext]",
            outputPath: "./fonts/",
          },
        },
      },
    ],
  },
};

var configMain = Object.assign({}, config, {
  target: 'web',
  name: "configMain",
  entry: path.resolve(process.cwd(), "src", "index.js"),
  output: {
    path: __dirname + "/build",
    publicPath: "/",
    filename: "main.js",
  },
  plugins: [
    new RemoveEmptyScriptsPlugin(),
    new MiniCssExtractPlugin({
      filename: "main.css",
    }),
    new LiveReloadPlugin()
  ],
});

var configEditor = Object.assign({}, config, {
  target: 'web',
  name: "configEditor",
  entry: path.resolve(process.cwd(), "src", "editor.js"),
  output: {
    path: __dirname + "/build",
    publicPath: "/",
    filename: "editor.js",
  },
  plugins: [
    new RemoveEmptyScriptsPlugin(),
    new MiniCssExtractPlugin({
      filename: "editor.css",
    }),
    new LiveReloadPlugin()
  ],
});

var configLogin = Object.assign({}, config, {
  target: 'web',
  name: "configLogin",
  entry: path.resolve(process.cwd(), "src", "login.js"),
  output: {
    path: __dirname + "/build",
    publicPath: "/",
    filename: "login.js",
  },
  plugins: [
    new RemoveEmptyScriptsPlugin(),
    new MiniCssExtractPlugin({
      filename: "login.css",
    }),
  ],
});

var configBlocks = Object.assign({}, config, {
  name: "configBlocks",
  entry: glob
    .sync("./template-parts/blocks/**/**/*.scss")
    .reduce((acc, path) => {
      // Extract just the block name for the entry key
      const entryMatch = path.match(/blocks\/([^/]+)\/[^/]+\.scss$/);
      if (entryMatch && entryMatch[1]) {
        const entry = entryMatch[1];
        acc[entry] = path;
      }
      return acc;
    }, {}),
  output: {
    path: path.resolve(__dirname, "template-parts/blocks"),
    publicPath: "/",
    filename: "[name]/[name].js", // Output JS (if any) to the block folder
  },
  plugins: [
    new RemoveEmptyScriptsPlugin(),
    new MiniCssExtractPlugin({
      filename: "[name]/[name].css", // Output CSS to the block folder
    }),
    new LiveReloadPlugin(),
  ],
});

module.exports = [configMain, configBlocks, configEditor, configLogin];
