const webpack = require('webpack'),
  path = require('path'),
  ExtractTextPlugin = require('extract-text-webpack-plugin'),
  StyleLintPlugin = require('stylelint-webpack-plugin'),
  BrowserSyncPlugin = require('browser-sync-webpack-plugin'),
  SpriteLoaderPlugin = require('svg-sprite-loader/plugin');

const config = {
  context: __dirname,
  entry: {
    frontend: './src/index.js',
    customizer: './src/customizer.js',
    admin: './src/admin.js'
  },
  output: {
    path: path.join(__dirname, 'dist'),
    filename: '[name]-bundle.js'
  },
  resolve: {
    extensions: ['.js', '.jsx', '.scss', '.json']
  },
  devtool: 'source-map',
  module: {
    rules: [
      {
        test: /\.s?css$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                importLoaders: 1,
                sourceMap: process.env.NODE_ENV ? false : true,
                minimize: process.env.NODE_ENV ? true : false
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                ident: 'postcss',
                plugins: [
                  require('autoprefixer')({ browsers: 'last 2 versions' }),
                  require('css-mqpacker')({ sort: true })
                ],
                sourceMap: process.env.NODE_ENV ? 'inline' : true
              }
            },
            {
              loader: 'sass-loader',
              options: {
                includePaths: [
                  'node_modules/sanitize.scss',
                  'node_modules/aurora-utilities/sass'
                ],
                sourceMap: process.env.NODE_ENV ? false : true
              }
            }
          ]
        })
      },
      {
        test: /\.svg$/,
        loader: 'svg-sprite-loader',
        options: {
          extract: true,
          spriteFilename: 'svg-defs.svg'
        }
      },
      {
        test: /\.(jpe?g|png|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              outputPath: 'images/',
              name: '[name].[ext]'
            }
          },
          'img-loader'
        ]
      },
      {
        enforce: 'pre',
        test: /\.jsx$/,
        loader: 'eslint-loader',
        exclude: /node_modules/
      },
      {
        test: /\.jsx?$/,
        loader: 'babel-loader'
      }
    ]
  },
  plugins: [
    new StyleLintPlugin(),
    new ExtractTextPlugin('[name].css'),
    new SpriteLoaderPlugin(),
    new BrowserSyncPlugin({
      files: '**/*.php',
      injectChanges: true,
      proxy: 'https://alcatraz.test'
    })
  ]
};

if ('production' === process.env.NODE_ENV) {
  config.devtool = false;
  config.plugins.push(
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': JSON.stringify('production')
    })
  );
  config.plugins.push(
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        comparisons: false
      }
    })
  );
}

module.exports = config;
