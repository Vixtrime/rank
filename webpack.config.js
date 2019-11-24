var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

Encore

    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('main', './assets/js/modules/main/main.js')

    .enableVueLoader()
    .enableSassLoader()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .cleanupOutputBeforeBuild()
    .splitEntryChunks()
    .disableSingleRuntimeChunk()

    .addPlugin(new VuetifyLoaderPlugin({
        match(originalTag, {kebabTag, camelTag, path, component}) {
            if (kebabTag.startsWith('core-')) {
                return [camelTag, `import ${camelTag} from '@/components/core/${camelTag.substring(4)}.vue'`]
            }
        }
    }))

    .configureBabel(() => {
    }, {
        useBuiltIns: 'usage',
        corejs: 3
    });

module.exports = Encore.getWebpackConfig();
