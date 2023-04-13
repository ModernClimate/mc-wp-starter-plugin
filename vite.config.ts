import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    rollupOptions: {
      input: {
        ['plugin-scripts']: './assets/scripts/plugin-scripts.js',
        ['plugin-styles']: './assets/styles/plugin-styles.scss',
      },
      output: {
        dir: './build',
        entryFileNames: () => {
          return `scripts/[name].min.js`;
        },
        assetFileNames: () => {
          return `styles/[name].min.[ext]`;
        },
      },
    },
    sourcemap: true,
  },
  plugins: [],
});
