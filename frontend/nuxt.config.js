const pkg = require('./package')
require('dotenv').config()

module.exports = {
  mode: 'spa',

  /*
  ** Headers of the page
  */
  head: {
    title: pkg.name,
    meta: [
      { charset: 'utf-8' },
      { 'http-equiv': 'X-UA-Compatible', content: 'IE=edge' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: pkg.description }
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
    // eslint-disable-next-line no-dupe-keys
    link: [
      {
        href:
          'https://fonts.googleapis.com/css?family=Lato:100,300,400,600,700,900',
        rel: 'stylesheet',
        type: 'text/css'
      }
    ],
    script: [{ src: 'https://unpkg.com/ionicons/dist/ionicons.js', body: true },
    {src: '~/static/js/aos.js'},
    {src: '~/static/js/laapp.min.js'},
    {src: '~/static/js/popper.js'},
    {src: '~/static/js/odometer.js'},
    {src: '~/static/js/scrollspy.js'},
    {src: '~/static/js/aos.js'},]
  },

  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#40dee7' },

  /*
  ** Global CSS
  */
  css: [
    '~static/css/all.css',
    '~static/css/aos.css',
    '~static/css/demo.css',
    '~static/css/swiper.css',
    '~static/css/laapp.css',
  ],

  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    '~plugins/axios.js',
    '~plugins/jquery.js',
    '~plugins/components.js',
    '~plugins/frontend.js',
    // '~plugins/chart.js',
    // '~plugins/mq.js'
  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    '@nuxtjs/auth',
    '@nuxtjs/dotenv',
    [
      'nuxt-validate',
      {
        lang: 'pl'
      }
    ],
    '@nuxtjs/recaptcha'
  ],
  recaptcha: {
    language: 'PL',
    siteKey: '6LdaSq4UAAAAALLoGCy9Xn8FGcPAZTLV_XuQKLdA',
    version: 2
  },
  router: {
    middleware: ['auth']
  },

  /*
  ** Axios module configuration
  */
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
    baseURL: process.env.LARAVEL_ENDPOINT
  },
  auth: {
    redirect: {
      login: '/login',
      logout: '/',
      callback: '/login',
      user: '/'
    },
    strategies: {
      password_grant_custom: {
        _scheme: '~/auth/schemes/PassportPasswordScheme.js',
        client_id: process.env.PASSPORT_CLIENT_ID,
        client_secret: process.env.PASSPORT_CLIENT_SECRET,
        endpoints: {
          login: {
            url: '/oauth/token',
            method: 'post',
            propertyName: 'access_token'
          },
          logout: false,
          user: {
            url: 'api/auth/me'
          }
        }
      }
    }
  },

  /*
  ** Build configuration
  */
  build: {
    extractCSS: true,
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {
      // Run ESLint on save
      // if (ctx.isDev && ctx.isClient) {
      //   config.module.rules.push({
      //     enforce: 'pre',
      //     test: /\.(js|vue)$/,
      //     loader: 'eslint-loader',
      //     exclude: /(node_modules)/,
      //     options: {
      //       fix: false
      //     }
      //   })
      // }
    }
  }
}
