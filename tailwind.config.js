
const { min, max } = require("lodash");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "blue-primary": "#032038",
                "blue-second": "#052742",
                "gradient-1": "#696EFF",
                "gradient-2": "#F8ACFF",
                "blue-border": "#1DCAD3",
                "blue-button": "#082D4A",
                "base-color": "#F1F2F6",
                "text-base": "#101010",
                "text-red": "#E63946",
            },
            height: {
                half: "50%",
            },
            width: {
                half: "50%",
            },
            minHeight: {
                half: "50%",
            },
            minWidth: {
                half: "50%",
            },
            maxHeight: {
                half: "50%",
            },
            maxWidth: {
                half: "50%",
            },
        },
    },
    corePlugins: {
        preflight: true,
    },
    plugins: [],
};
