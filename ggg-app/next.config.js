/** @type {import('next').NextConfig} */

module.exports = {
  async redirects() {
    return [
      {
        source: '/',
        destination: '/login',
        permanent: true,
      },
      {
        source: '/store',
        destination: '/store/featured',
        permanent: true,
      },
    ]
  },
}