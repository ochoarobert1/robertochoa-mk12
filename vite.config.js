import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import eslint from 'vite-plugin-eslint';

export default defineConfig({
  build: {
    outDir: 'js',
    rollupOptions: {
      input: {
        functions: 'src/index.js',
      },
      output: {
        entryFileNames: '[name].js',
      },
    },
  },
  plugins: [
    eslint({
      include: ['src/**/*.js'],
      exclude: ['node_modules/**', 'js/**'],
      emitError: true,
      emitWarning: true,
    }),
    viteStaticCopy({
      targets: [
        {
          src: 'src/json/*.json',
          dest: '.',
        },
      ],
    }),
  ],
});
