export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
        // CSS minification and optimization for production
        ...(process.env.NODE_ENV === 'production' ? {
            cssnano: {
                preset: ['default', {
                    discardComments: {
                        removeAll: true,
                    },
                    normalizeWhitespace: true,
                    colorMin: true,
                    minifyFontValues: true,
                    minifySelectors: true,
                    // Remove unused CSS
                    reduceIdents: false,
                    // Merge similar rules
                    mergeLonghand: true,
                    mergeRules: true,
                }],
            },
        } : {}),
    },
};
