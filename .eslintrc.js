export default {
  root: true,
  env: { browser: true, es2021: true, node: true },
  extends: ["airbnb-base"],
  parserOptions: { ecmaVersion: 12, sourceType: "module" },
  rules: {
    "no-console": "warn",
    "import/no-extraneous-dependencies": ["error", { devDependencies: true }],
    "linebreak-style": ["error", "unix"],
  },
};