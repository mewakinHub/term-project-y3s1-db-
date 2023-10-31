import Image from 'next/image'
import logo from '@/assets/logo.png'

export default function Home() {
  return (
    <main>
      <div className='login-container'>
        <Image className='center logo'
          src={logo}
          style={{maxWidth: '230px', height: 'auto'}}
        />
        <p>Hello! Please login.</p>
        <form>
          <input type='text' name='email' placeholder='E-mail'/>
          <input type='text' name='password' placeholder='Password'/>
          <button type='submit' className='full'>Login</button>
        </form>
        <div className='button-container'>
          <button type="button" className='stick noaccount'>I don't have an account.</button>
        </div>
      </div>
    </main>
  );
}
