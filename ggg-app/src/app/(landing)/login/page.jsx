import { Route } from '@/app/route.js'
import { Icon } from '@/assets/icon.jsx'
import Link from 'next/link'
import Image from 'next/image'
import logofull from '@/assets/logofull.png'

export default function page() {
  return (
    <main>
      <div className='login-container'>
        <Image className='center logofull'
          src={logofull}
          style={{maxWidth: '200px', height: 'auto'}}
        />
        <span className='message-container'>
          <p>Hello! Please login.</p>
        </span>
        <form autoComplete='off'>
          <div className='inputicon-container email'>
            <input type='text' name='email' placeholder='E-mail' maxLength='64' className='iconned'/>
            {Icon('mail')}
          </div>
          <div className='inputicon-container password'>
            <input type='password' name='password' placeholder='Password' maxLength='64' className='iconned'/>
            {Icon('key')}
          </div>
          <Link href={Route('featured')} passHref>
            <div className='button-wrapper'>
              <button type='submit' className='default full white'>Login</button>
            </div>
          </Link>
        </form>
        <div className='button-container'>
          <Link href={Route('signup')} passHref>
            <div className='button-wrapper'>
              <button type="button" className='default noaccount'>I don't have an account.</button>
            </div>
          </Link>
        </div>
      </div>
    </main>
  );
}
