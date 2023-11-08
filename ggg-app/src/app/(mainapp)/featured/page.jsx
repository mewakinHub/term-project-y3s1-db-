import { Route } from '@/app/route.js'
import { Icon } from '@/assets/icon.jsx'
import Link from 'next/link'
import Image from 'next/image'

export default function page() {
  return (
    <main className='featured'>
      <div className='header'>
        <p>Featured</p>
        <div className='searchbox-wrapper'>
          <div className='inputicon-container searchicon'>
            <input type='text' name='searchstore' placeholder='Search store' maxLength='32' className='iconned'/>
            {Icon('search')}
          </div>
        </div>
      </div>
      <hr/>
    </main>
  );
}
