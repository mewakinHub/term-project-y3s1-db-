import { Route } from '@/app/route.js'
import Link from 'next/link'
import Image from 'next/image'
import logo from '@/assets/logo.png'

export default function pageStore() {
  return (
    <div className='root'>
      <nav>
        <p>nav</p>
      </nav>
      <main>
        <p>main</p>
      </main>
    </div> 
  );
}
