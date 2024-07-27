module.exports = {
  content: [
    './public/**/*.html',
    './src/**/*.{vue,js,ts,jsx,tsx}',
  ],
  theme: {
    extend: {
      colors: {
        facebook: {
          DEFAULT: '#1877F2',
          dark: '#0F62FE',
          light: '#42A5F5',
          background: '#F0F2F5',
          text: '#050505',
        },
      },
    },
  },
  plugins: [],
}
