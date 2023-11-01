import '@/styles/global.css'
import { Lexend } from 'next/font/google';

const lexend = Lexend({ subsets: ['latin'] })

export const metadata = {
  title: 'GGG',
  description: 'Good Games Garage',
}

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <head>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,100,1,200" rel="stylesheet" />
      </head>
      <body className={lexend.className}>{children}</body>
    </html>
  )
}
