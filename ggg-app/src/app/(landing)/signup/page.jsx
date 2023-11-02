import { Route } from '@/app/route.js'
import { Icon } from '@/assets/icon.jsx'
import Link from 'next/link'
import Image from 'next/image'
import logofull from '@/assets/logofull.png'

export default function pageSignup() {
  return (
    <main>
      <div className='login-container'>
        <Image className='center logofull'
          src={logofull}
          style={{maxWidth: '200px', height: 'auto'}}
        />
        <span className='message-container'>
          <div className='back-wrapper'>
            <Link href={Route('login')} passHref className='backlink'>
              <svg className='backicon' fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                <path fill='currentColor' d="m343.152-438.5 195.739 195.739L480-183.869 183.869-480 480-776.131l58.891 58.892L343.152-521.5h432.979v83H343.152Z"/>
              </svg>
            </Link>
          </div>
          <p>Welcome!</p>
        </span>
        <form autoComplete='off'>
          <div className='inputicon-container email'>
            <input type='text' name='email' placeholder='E-mail' maxLength='64' className='iconned'/>
            {Icon('mail')}
          </div>
          <div className='inputicon-container username'>
            <input type='text' name='username' placeholder='Username' maxLength='32' className='iconned'/>
            {Icon('id')}
          </div>
          <div className='inputicon-container password'>
            <input type='password' name='password' placeholder='Password' maxLength='64' className='iconned'/>
            {Icon('key')}
          </div>
          <div className='inputicon-container password'>
            <input type='password' name='confirmpassword' placeholder='Confirm Password' maxLength='64' className='iconned'/>
            {Icon('key')}
          </div>
          <Link href={Route('featured')} passHref>
            <div className='button-wrapper'>
              <button type='submit' className='default full white'>Signup</button>
            </div>
          </Link>
        </form>
      </div>
    </main>
  );
}
