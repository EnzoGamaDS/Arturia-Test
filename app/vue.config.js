module.exports = {
  devServer: {
    proxy: {
      '^/api': {
        target: 'http://localhost:8080',
        changeOrigin: false,
        logLevel: 'debug',
        pathRewrite: { '^/api': '/api' },
      },
    },
  },
};
