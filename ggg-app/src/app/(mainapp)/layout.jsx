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
          <div className='nav-main'>
            <Image className='center logo'
              src={logo}
              style={{maxWidth: '70px', height: 'auto'}}
            />
            <div className='nav-main-buttons'>
              <Link href={Route('featured')} passHref>
                <button className={'featured'.concat(' ',pathname == Route('featured') ? ' active' : '')}>
                  {Icon('featured')}
                  Featured
                </button>
              </Link>
              <Link href={Route('browse')} passHref>
                <button className={'browse'.concat(' ',pathname == Route('browse') ? ' active' : '')}>
                  {Icon('browse')}
                  Browse
                </button>
              </Link>
              <Link href={Route('library')} passHref>      
                <button className={'library'.concat(' ',pathname == Route('library') ? ' active' : '')}>
                  {Icon('library')}
                  Library
                </button>
              </Link>
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
