const path = require('path'),
  MiniCssExtractPlugin = require('mini-css-extract-plugin'),
  UglifyJSPlugin = require('uglifyjs-webpack-plugin'),
  OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin'),
  BrowserSyncPlugin = require('browser-sync-webpack-plugin'),
  StyleLintPlugin = require('stylelint-webpack-plugin'),
  SpriteLoaderPlugin = require('svg-sprite-loader/plugin');

module.exports = {
  context: __dirname,
  entry: {
    frontend: ['babel-polyfill', './src/index.js', './src/sass/main.scss'],
    editor: ['./src/editor.js', './src/sass/editor.scss'],
    customizer: './src/customizer.js',
    admin: './src/admin.js'
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name]-bundle.js'
  },
  resolve: {
    extensions: ['.js', '.jsx', '.scss', '.css', '.json']
  },
  mode: 'development',
  devtool: 'source-map',
  module: {
    rules: [
      {
        enforce: 'pre',
        exclude: /node_modules/,
        test: /\.jsx?$/,
        loader: 'eslint-loader'
      },
      {
        test: /\.jsx?$/,
        loader: 'babel-loader'
      },
      {
        test: /\.s?css$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              indent: 'postcss',
              plugins: [
                require('autoprefixer')({ browsers: 'last 2 versions' }),
                require('css-mqpacker')({ sort: true })
              ]
            }
          },
          {
            loader: 'sass-loader',
            options: {
              includePaths: [
                'node_modules/sanitize.scss',
                'node_modules/aurora-utilities/sass'
              ]
            }
          }
        ]
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
      }
    ]
  },
  plugins: [
    new StyleLintPlugin(),
    new MiniCssExtractPlugin({ filename: '[name].css' }),
    new SpriteLoaderPlugin(),
    new BrowserSyncPlugin({ files: '**/*.php', proxy: 'https://alcatraz.test' })
  ],
  optimization: {
    minimizer: [new UglifyJSPlugin(), new OptimizeCssAssetsPlugin()]
  }
};
