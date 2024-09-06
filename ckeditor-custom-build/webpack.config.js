const path = require('path');

module.exports = {
    entry: './src/ckeditor.js',
    output: {
        filename: 'ckeditor.js',
        path: path.resolve(__dirname, 'dist'),
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [ 'style-loader', 'css-loader' ]
            },
            {
        test: /\.svg$/,
        use: [
          {
            loader: 'svg-inline-loader',
          },
        ],
      },
        ]
    }
};
