export default {
    content: [
        './app/**/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './vendor/filament/**/*.blade.php',
    ],
    plugins: [
        require('preline/plugin'),
    ]
}
