import React from 'react'
import './page.css'
import Image from 'next/image'
import logo from '../assets/logo.png'

export default function Home() {
  return (
    <main>
      <div className='welcomebox'>
        <Image
          src={logo}
          style={{
            maxWidth: '25%',
            height: 'auto'
          }}
        />
        <p>Hello! Please Login.</p>
        <form>
          <input type='text' name='email' placeholder='E-mail'/>
          <input type='text' name='password' placeholder='Password'/>
          <button type='submit'>Login</button>
        </form>
        <button type="button">I don't have an account.</button>
      </div>
    </main>
  );
}
