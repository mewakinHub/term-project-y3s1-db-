"use client";

import '@/styles/mainapp.css'
import { Route } from '@/app/route.js'
import { Icon } from '@/assets/icon.jsx'
import Link from 'next/link'
import Image from 'next/image'
import logo from '@/assets/logo.png'
import pfp from '@/assets/pfp1.png'
import { usePathname } from "next/navigation";

export default function layoutMain({ children }) {

  const pathname = usePathname();

  return (
    <div className='root mainapp'>
        <nav>
          <div className='nav-wrapper'>
            <div className='nav-main'>
              <Image className='center logo'
                src={logo}
                style={{maxWidth: '70px', height: 'auto'}}
              />
              <div className='nav-main-buttons'>
                <Link href={Route('featured')} passHref className='button-wrapper'>
                  <button className={'featured'.concat(' ',pathname == Route('featured') ? ' active' : '')}>
                    {Icon('featured')}
                    Featured
                  </button>
                </Link>
                <Link href={Route('browse')} passHref className='button-wrapper'>
                  <button className={'browse'.concat(' ',pathname == Route('browse') ? ' active' : '')}>
                    {Icon('browse')}
                    Browse
                  </button>
                </Link>
                <Link href={Route('library')} passHref className='button-wrapper'>      
                  <button className={'library'.concat(' ',pathname == Route('library') ? ' active' : '')}>
                    {Icon('library')}
                    Library
                  </button>
                </Link>
              </div>
              <hr/>
            </div>
            <div className='nav-installed'>
              <div className='installed-header'>
                <p>Installed</p>
                <div className='iconbutton-wrapper'>
                  {Icon('adjust')}
                </div>
              </div>
            </div>
            <div className='nav-user'>
              <hr/>
              <div className='button-wrapper'>
                <button className='full'>
                  <div className='user-container'>
                    <Image className='pfp'
                      src={pfp}
                    />
                    <div className='user-info'>
                      <p className='username'>username</p>
                      <p className='funds'>฿0.00</p>
                    </div>
                  </div>
                </button>
              </div>
            </div>
          </div> 
        </nav>
        {children}
    </div>
  )
}
