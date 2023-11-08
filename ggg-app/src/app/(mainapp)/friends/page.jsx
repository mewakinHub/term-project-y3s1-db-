import { Route } from '@/app/route.js'
import { Icon } from '@/assets/icon.jsx'
import Link from 'next/link'
import Image from 'next/image'

export default function page() {
  return (
    <main>
      <div className='header'>
        <p>Friends</p>
        <div className='searchbox-wrapper hidden'>
          <div className='inputicon-container searchicon'>
            <input type='text' name='search' placeholder='Search' maxLength='32' className='iconned'/>
            {Icon('search')}
          </div>
        </div>
      </div>
    </main>
  );
}
