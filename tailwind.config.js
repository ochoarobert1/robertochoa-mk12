/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./templates/**/*.php",
    "./includes/**/*.php",
    "./*.php",
    "./src/**/*.js",
    "./src/**/*.scss", // Add this line to include SCSS files
  ],
  plugins: [],
};
