/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  mode: 'jit',
  jit: true,
  content: [
    './**/*.{html,js,php}'
  ],
  theme: {
    extend: {
      spacing: {
        'px': '1px',
        '6xs': '2px',
        '5xs': '4px',
        '4xs': '8px',
        '3xs': '10px',
        '2xs': '12px',
        'xs': '14px',
        '15': '15px',
        'sm': '16px',
        '18': '18px',
        'md': '20px',
        '22': '22px',
        'lg': '24px',
        '25': '25px',
        'xl': '28px',
        '30': '30px',
        '2xl': '32px',
        '36' : '36px',
        '3xl': '40px',
        '4xl': '48px',
        '50': '50px',
        '5xl': '56px',
        '6xl': '64px',
        '7xl': '72px',
        '8xl': '80px',
        '100': '100px',
      },
      fontSize: theme => theme('spacing'),
      margin: theme => theme('spacing'),
      padding: theme => theme('spacing'),
      gap: theme => theme('spacing'),
      borderRadius: theme => theme('spacing'),
      borderWidth: theme => theme('spacing'),
      lineHeight: theme => theme('spacing'),
      minWidth: theme => theme('spacing'),
      maxWidth: theme => theme('spacing'),
      minHeight: theme => theme('spacing'),
      maxHeight: theme => theme('spacing'),
      screens: {
        '3xl': '1600px',
      },
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: {
        DEFAULT: '#000000',
        site: '#000A14',
      },
      white: {
        DEFAULT: '#FFFFFF',
        off_white: '#F9F6F3',
      },
      green: {
        DEFAULT: '#8cc640',
        hover: '#69A11D',
        active: '#0DA600',
        light: '#DFEECC',
      },
      gray: {
        light: '#F4F4F4',
        light_medium: '#D8D8D8',
        DEFAULT: '#969696',
        medium_dark: '#646464',
        dark: '#323232',
        borders: '#D9D9D9',
        300: '#ccc',
        700: '#333',
      },
      blue: {
        DEFAULT: '#221e53',
        hover: '#3327A7',
        active:'#006BE8',
        100: '#ebf8ff',
        500: '#4299e1',
      },
      red: {
        DEFAULT: '#FC1919',
      },
      purple: {
        DEFAULT: '#DFDCFF',
      },
      yellow:{
        DEFAULT:'#FFD600',
      },
      orange: {
        DEFAULT: '#FB2600',
        dark: '#B81C00'
      }
    },
    fontFamily: {
      heading: ['The Seasons', 'sans-serif'],
      body: ['Sailec', 'sans-serif'],
    },
    screens: {
      xxs: '320px',
      xs: '419px',
      ...defaultTheme.screens,
    },
  },
  plugins: [],
}

