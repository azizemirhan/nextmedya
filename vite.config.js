import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purgecss from '@fullhuman/postcss-purgecss';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss', // Added SCSS entry point
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    css: {
        postcss: {
            plugins: [
                purgecss({
                    content: [
                        './resources/**/*.blade.php',
                        './resources/**/*.js',
                        './resources/**/*.vue',
                    ],
                    defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || [],
                    safelist: {
                        deep: [/show$/, /fade$/, /active$/, /nav-/, /navbar-/, /btn-/, /modal-/, /carousel-/],
                        standard: ['html', 'body', 'container', 'row', 'col', 'show', 'collapsing']
                    }
                })
            ]
        },

        // Sass configuration - suppress deprecation warnings from Bootstrap
        preprocessorOptions: {
            scss: {
                // Suppress Sass deprecation warnings from node_modules (Bootstrap)
                api: 'modern-compiler', // Use modern Sass API
                silenceDeprecations: [
                    'legacy-js-api',
                    'import',
                    'global-builtin',
                    'color-functions',
                    'if-function'
                ],
                logger: {
                    warn(message, options) {
                        // Suppress warnings from node_modules (Bootstrap)
                        if (options.deprecation && options.stack?.includes('node_modules')) {
                            return;
                        }
                        console.warn(message);
                    }
                }
            }
        }
    },

    build: {
        // Enable minification for production
        minify: 'terser',

        terserOptions: {
            compress: {
                drop_console: true, // Remove console.logs in production
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug'],
            },
        },

        // Code splitting configuration
        rollupOptions: {
            output: {
                // Manual chunks for better caching
                manualChunks: {
                    'vendor': [
                        'axios',
                    ],
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

                    return 'assets/[name]-[hash][extname]';
                },
            },
        },

        // Chunk size warning limit (500kb)
        chunkSizeWarningLimit: 500,

        // CSS code splitting
        cssCodeSplit: true,

        // Asset inline limit (4kb)
        assetsInlineLimit: 4096,

        // Source maps for debugging (disable in production for smaller files)
        sourcemap: false,
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
    },
});
