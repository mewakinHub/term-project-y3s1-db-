import React, { useState } from 'react'
import { Icon } from 'assets/icon'
import logofull from 'assets/logofull.png'
import 'styles/landing.css'
import axios from 'axios'

export default function Login() {
  
  const [inputs, setInputs] = useState({})

  const handleChange = (e) => {
    const name = e.target.name;
    const value = e.target.value;
    setInputs(values => ({...values, [name]: value}));
  }

  const handleSubmit = (e) => {
    e.preventDefault();
    axios.post('http://localhost:8888/api/', inputs);
  }

  return (
    <div className='root landing'>
      <main>
        <div className='login-container'>
          <img className='center logofull' alt='logofull'
            src={logofull}
            style={{maxWidth: '200px', height: 'auto'}}
          />
          <span className='message-container'>
            <p>Hello! Please log in.</p>
          </span>
          <form autoComplete='off' onSubmit={handleSubmit}>
            <div className='inputicon-container email'>
              <input type='text' onChange={handleChange} required name='email' placeholder='E-mail' maxLength='64' className='iconned'/>
              {Icon('mail')}
            </div>
            <div className='inputicon-container password'>
              <input type='password' onChange={handleChange} required name='password' placeholder='Password' maxLength='64' className='iconned'/>
              {Icon('key')}
            </div>
            <button className='button-wrapper' >
              <button type='submit' className='default full white'>Enter</button>
            </button>
          </form>
          <div className='button-container'>
              <div className='button-wrapper'>
                <button type="button" className='default noaccount'>Sign up</button>
              </div>
          </div>
        </div>
      </main>
    </div>
  )
}
