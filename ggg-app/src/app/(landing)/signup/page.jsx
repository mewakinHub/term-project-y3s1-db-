import { Route } from '@/app/route.js'
import Link from 'next/link'
import Image from 'next/image'
import logo from '@/assets/logo.png'

export default function pageSignup() {
  return (
    <div className='root'>
      <main>
        <div className='login-container'>
          <Image className='center logo'
            src={logo}
            style={{maxWidth: '200px', height: 'auto'}}
          />
          <p>Welcome!</p>
          <form autoComplete='off'>
            <div className='inputicon-container email'>
              <input type='text' name='email' placeholder='E-mail' maxLength='64' className='iconned'/>
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M22 7.535v9.465a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-9.465l9.445 6.297l.116 .066a1 1 0 0 0 .878 0l.116 -.066l9.445 -6.297z" stroke-width="0" fill="currentColor" />
                <path d="M19 4c1.08 0 2.027 .57 2.555 1.427l-9.555 6.37l-9.555 -6.37a2.999 2.999 0 0 1 2.354 -1.42l.201 -.007h14z" stroke-width="0" fill="currentColor" />
              </svg>
            </div>
            <div className='inputicon-container username'>
              <input type='text' name='username' placeholder='Username' maxLength='32' className='iconned'/>
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M15 8l2 0" />
                <path d="M15 12l2 0" />
                <path d="M7 16l10 0" />
              </svg>
            </div>
            <div className='inputicon-container password'>
              <input type='password' name='password' placeholder='Password' maxLength='64' className='iconned'/>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20" viewBox="0 -960 960 960" width="20">
                <path d="M288-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T48-480q0-100 70-170t170-70q78 0 140.5 46.5T516-552h324l72 72-132 159-84-87-72 72-72-72h-36q-24 75-86.925 121.5Q366.149-240 288-240Z" fill="currentColor"/>
              </svg>
            </div>
            <div className='inputicon-container password'>
              <input type='password' name='confirmpassword' placeholder='Confirm Password' maxLength='64' className='iconned'/>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20" viewBox="0 -960 960 960" width="20">
                <path d="M288-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T48-480q0-100 70-170t170-70q78 0 140.5 46.5T516-552h324l72 72-132 159-84-87-72 72-72-72h-36q-24 75-86.925 121.5Q366.149-240 288-240Z" fill="currentColor"/>
              </svg>
            </div>
            <Link href={Route('store')} passHref>
              <button type='submit' className='full white'>Signup</button>
            </Link>
          </form>
        </div>
      </main>
    </div>
  );
}
