import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js', // JS entry point
        'resources/sass/app.scss', // CSS entry point
        'resources/js/jodit.js',
        'resources/sass/jodit.scss',
        'resources/js/pdf.js',
        'resources/sass/pdf.scss',
        'resources/js/intl-tel-input.js',
        'resources/sass/intl-tel-input.scss',
      ],
      refresh: true, // Enable file watching for Blade files
    }),
  ],
  // Optional: Reduce watched files (but keep critical paths)
  server: {
    watch: {
      ignored: [
        '**/node_modules/**',
        '**/vendor/**',
        '**/storage/**', // Example: Ignore non-critical directories
      ],
    },
  },
});