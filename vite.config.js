import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  root: path.resolve(__dirname, 'resources'),
  build: {
    outDir: path.resolve(__dirname, 'public/build'),
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'resources/css/app.css'),
    },
  },
});
