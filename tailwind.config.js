/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./src/**/*.{js,ts,jsx,tsx}",
    "./parts/**/*.php",
    "./templates/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#0073aa",
        secondary: "#23282d",
      },
      fontFamily: {
        sans: [
          "-apple-system",
          "BlinkMacSystemFont",
          "Segoe UI",
          "Roboto",
          "Oxygen",
          "Ubuntu",
          "Cantarell",
          "sans-serif",
        ],
      },
      container: {
        center: true,
        padding: "1.5rem",
        screens: {
          sm: "640px",
          md: "768px",
          lg: "1024px",
          xl: "1200px",
        },
      },
    },
  },
  plugins: [],
};
