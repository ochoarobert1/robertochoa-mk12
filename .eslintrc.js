module.exports = {
  root: !0,
  env: { browser: !0, es2021: !0, node: !0 },
  extends: ["airbnb-base"],
  parserOptions: { ecmaVersion: 12, sourceType: "module" },
  rules: {
    "no-console": "warn",
    "import/no-extraneous-dependencies": ["error", { devDependencies: !0 }],
    "linebreak-style": ["error", "unix"],
  },
};
