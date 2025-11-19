import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import viteCompression from 'vite-plugin-compression';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        
        // Gzip compression for production
        viteCompression({
            algorithm: 'gzip',
            ext: '.gz',
            threshold: 10240, // Only compress files larger than 10kb
            deleteOriginFile: false,
        }),
        
        // Brotli compression for production (better than gzip)
        viteCompression({
            algorithm: 'brotliCompress',
            ext: '.br',
            threshold: 10240,
            deleteOriginFile: false,
        }),
    ],

    build: {
        // Enable minification for production
        minify: 'terser',

        terserOptions: {
            compress: {
                drop_console: true, // Remove console.logs in production
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug', 'console.trace'],
                passes: 2, // Run minification twice for better results
                ecma: 2020,
            },
            mangle: {
                safari10: true,
            },
            format: {
                comments: false, // Remove all comments
            },
        },

        // Code splitting configuration
        rollupOptions: {
            output: {
                // Manual chunks for better caching
                manualChunks: (id) => {
                    // Vendor chunks
                    if (id.includes('node_modules')) {
                        if (id.includes('axios')) {
                            return 'vendor-axios';
                        }
                        if (id.includes('vue')) {
                            return 'vendor-vue';
                        }
                        // Other node_modules go into vendor
                        return 'vendor';
                    }
                },

                // Chunk naming for better cache control
                chunkFileNames: 'js/[name]-[hash].js',
                entryFileNames: 'js/[name]-[hash].js',
                assetFileNames: ({ name }) => {
                    if (/\.(gif|jpe?g|png|svg|webp|avif)$/.test(name ?? '')) {
                        return 'images/[name]-[hash][extname]';
                    }

                    if (/\.css$/.test(name ?? '')) {
                        return 'css/[name]-[hash][extname]';
                    }

                    if (/\.(woff2?|eot|ttf|otf)$/.test(name ?? '')) {
                        return 'fonts/[name]-[hash][extname]';
                    }

                    return 'assets/[name]-[hash][extname]';
                },
            },
        },

        // Chunk size warning limit (500kb)
        chunkSizeWarningLimit: 500,

        // CSS code splitting for better caching
        cssCodeSplit: true,

        // Minify CSS
        cssMinify: true,

        // Asset inline limit (4kb) - smaller files embedded as base64
        assetsInlineLimit: 4096,

        // Source maps for debugging (disable in production for smaller files)
        sourcemap: false,

        // Target modern browsers for smaller output
        target: 'es2020',

        // Optimize module preloading
        modulePreload: {
            polyfill: true,
        },

        // Report compressed size
        reportCompressedSize: true,

        // Output directory
        outDir: 'public/build',
        emptyOutDir: true,
    },

    // Server configuration for development
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: false,
        },
    },

    // Optimize dependencies
    optimizeDeps: {
        include: ['axios'],
        esbuildOptions: {
            target: 'es2020',
        },
    },

    // CSS preprocessing options
    css: {
        devSourcemap: false,
        postcss: './postcss.config.js',
    },

    // Improve build performance
    esbuild: {
        legalComments: 'none',
        drop: ['console', 'debugger'],
    },
});
