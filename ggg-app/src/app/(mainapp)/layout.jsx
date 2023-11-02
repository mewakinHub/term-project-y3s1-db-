import '@/styles/mainapp.css'
import { Route } from '@/app/route.js'
import { Icon } from '@/assets/icon.jsx'
import Image from 'next/image'
import logo from '@/assets/logo.png'

export default function layoutMain({ children }) {
  return (
    <div className='root mainapp'>
        <nav>
          <div className='nav-main'>
            <Image className='center logo'
              src={logo}
              style={{maxWidth: '70px', height: 'auto'}}
            />
            <div className='nav-main-buttons'>
              <button className='featured'>
                {Icon('featured')}
                <p>Featured</p>
              </button>
              <button className='browse'>
                {Icon('browse')}
                <p>Browse</p>
              </button>
              <button className='library'>
                {Icon('library')}
                <p>Library</p>
              </button>
            </div>
          </div>
          <div className='nav-installed'>

          </div>
          <div className='nav-you'>

          </div>
        </nav>
        {children}
    </div>
  )
}
