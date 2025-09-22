import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    safelist: [
        "bg-yellow-400",
        "hover:bg-yellow-500",
        "bg-red-500",
        "hover:bg-red-600",
        "text-white",
        "px-3",
        "py-1",
        "text-xs",
        "font-medium",
        "rounded",
        "flex",
        "justify-center",
        "space-x-2",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
