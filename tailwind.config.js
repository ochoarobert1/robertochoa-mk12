/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./templates/**/*.php",
    "./includes/**/*.php",
    "./*.php",
    "./src/**/*.js",
    "./src/**/*.scss", // Add this line to include SCSS files
  ],
  theme: {
    screens: {
      xxs: "320px",
      xs: "414px",
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1536px",
    },
    extend: {
      fontFamily: {
        primary: ["Roboto", "ui-sans-serif", "system-ui", "sans-serif"],
        secondary: ["Work Sans", "sans-serif"],
      },
      fontSize: {
        xs: "0.75rem",
        sm: "0.875rem",
        base: "1rem",
        lg: "1.125rem",
        xl: "1.25rem",
        "2xl": "1.5rem",
        "3xl": "1.875rem",
        "4xl": "2.25rem",
        "5xl": "3rem",
        "6xl": "4rem",
      },
      colors: {
        hred: "#e0040b",
        sgray: "#f9f9f9",
        sblack: "#3c3c3c",
        hblue: "#151515",
        black: "#000000",
        white: "#ffffff",
      },
      screens: {
        xxs: "320px",
        xs: "414px",
        sm: "640px",
        md: "768px",
        lg: "1024px",
        xl: "1280px",
        "2xl": "1536px",
      },
    },
  },
  plugins: [],
};
