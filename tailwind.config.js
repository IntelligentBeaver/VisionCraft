import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#F9D72F",

                    "primary-content": "#151101",

                    secondary: "#DFA62A",

                    "secondary-content": "#120a01",

                    accent: "#18182F",

                    "accent-content": "#cbcbd2",

                    neutral: "#18182F",

                    "neutral-content": "#cbcbd2",

                    "base-100": "#ffffff",

                    "base-200": "#dedede",

                    "base-300": "#bebebe",

                    "base-content": "#161616",

                    info: "#1C92F2",

                    "info-content": "#000814",

                    success: "#009485",

                    "success-content": "#000806",

                    warning: "#ff9900",

                    "warning-content": "#160800",

                    error: "#ff5724",

                    "error-content": "#160300",
                },
            },
        ],
    },
};
