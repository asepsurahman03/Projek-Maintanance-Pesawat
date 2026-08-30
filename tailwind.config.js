/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/View/**/*.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
                mono: ['JetBrains Mono', 'Fira Code', 'monospace'],
            },
            colors: {
                aviation: {
                    50:  '#f0f4ff',
                    100: '#e0eaff',
                    200: '#c7d9fd',
                    300: '#a5befc',
                    400: '#7f9af8',
                    500: '#5f73f3',
                    600: '#4553e8',
                    700: '#3941cc',
                    800: '#3037a5',
                    900: '#2c3483',
                    950: '#1a1f4e',
                },
            },
            typography: {
                DEFAULT: {
                    css: {
                        maxWidth: '100%',
                    },
                },
            },
        },
    },
    plugins: [],
};
