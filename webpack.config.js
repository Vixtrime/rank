var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

// const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

Encore

    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('main', './assets/js/modules/main/main.js')
    .enableVueLoader()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .splitEntryChunks()
    .disableSingleRuntimeChunk()
    .enableSassLoader()

    .addPlugin(new VuetifyLoaderPlugin({
        match (originalTag, { kebabTag, camelTag, path, component }) {
            if (kebabTag.startsWith('core-')) {
                return [camelTag, `import ${camelTag} from '@/components/core/${camelTag.substring(4)}.vue'`]
            }
        }
    }))

    .configureBabel(() => {
    }, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    // .addPlugin(new BundleAnalyzerPlugin({analyzerHost: '174.28.1.5', analyzerPort: '8888'}))


;

module.exports = Encore.getWebpackConfig();
