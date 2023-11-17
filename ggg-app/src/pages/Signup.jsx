import React, { useState } from 'react'
import { Icon } from 'assets/icon'
import logofull from 'assets/logofull.png'
import 'styles/landing.css'
import axios from 'axios'
import { Link, useNavigate } from 'react-router-dom'

export default function Login() {

  const navigate = useNavigate();
  
  const [inputs, setInputs] = useState({})

  const handleChange = (e) => {
    const name = e.target.name;
    const value = e.target.value;
    setInputs(values => ({...values, [name]: value}));
  }

  const handleSubmit = (e) => {
    e.preventDefault();
    axios.post('http://localhost:80/api/addUser.php', inputs);
  }

  return (
    <div className='root landing'>
      <main>
        <div className='login-container'>
          <img className='center logofull'
            src={logofull}
            style={{maxWidth: '200px', height: 'auto'}}
          />
          <span className='message-container'>
            <div className='back-wrapper'>
              <button className='backlink' onClick={() => navigate(-1)}>
                <svg className='backicon' fill='none' xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                  <path fill='currentColor' d="m343.152-438.5 195.739 195.739L480-183.869 183.869-480 480-776.131l58.891 58.892L343.152-521.5h432.979v83H343.152Z"/>
                </svg>
              </button>
            </div>
            <p>Sign up</p>
          </span>
          <form autoComplete='off' onSubmit={handleSubmit}>
            <div className='inputicon-container email'>
              <input type='text' onChange={handleChange} required name='email' placeholder='E-mail' maxLength='64' className='iconned'/>
              {Icon('mail')}
            </div>
            <div className='inputicon-container username'>
              <input type='text' onChange={handleChange} required name='username' placeholder='Username' maxLength='32' className='iconned'/>
              {Icon('id')}
            </div>
            <div className='inputicon-container password'>
              <input type='password' onChange={handleChange} required name='password' placeholder='Password' maxLength='64' className='iconned'/>
              {Icon('key')}
            </div>
            <div className='inputicon-container password'>
              <input type='password' onChange={handleChange} required name='confirmpassword' placeholder='Confirm Password' maxLength='64' className='iconned'/>
              {Icon('key')}
            </div>
            <button className='button-wrapper' >
              <button type='submit' className='default full white'>Enter</button>
            </button>
          </form>
        </div>
      </main>
    </div>
  )
}
