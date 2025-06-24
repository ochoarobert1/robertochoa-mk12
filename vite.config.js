import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import postcss from '@tailwindcss/postcss';
import { existsSync, rmSync } from 'fs';

// Clean the dist directory before build
if (existsSync('./dist')) {
  console.log('Cleaning dist directory...');
  rmSync('./dist', { recursive: true, force: true });
}

export default defineConfig({
  server: {
    watch: {
      usePolling: true,
      interval: 100,
    },
  },
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        functions: 'src/index.js',
        styles: 'src/scss/app.scss',
        admin: 'src/scss/admin-app.scss',
      },
      output: {
        entryFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
      },
    },
  },
  css: {
    postcss: {
      plugins: [postcss()],
    },
  },
  plugins: [
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
