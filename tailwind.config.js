// tailwind.config.js

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      backgroundColor: {
        'input-main': 'rgba(255, 255, 255, 0.5)',
        'input-main-focus': 'rgba(255, 255, 255, 0.8)',
      },
      fontSize: {
        'input-main': '2rem',
      },
      borderRadius: {
        'card': '0.5rem',
      },
      borderWidth: {
        'input-main': '2px',
      },
      textColor: {
        'card-title': '#1A202C',
        'card-text': '#718096',
      },
      spacing: {
        'card-padding': '1rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
}