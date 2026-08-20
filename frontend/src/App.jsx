import { useState } from 'react'
import {BrowserRouter, Routes, Route} from 'react-router-dom'
import { Navigate } from 'react-router-dom'
import Home from './pages/Home'
import SingleMovie from './pages/SingleMovie'
import DefaultLayout from './layout/Layout'
import Login from './pages/Login'
import Registration from './pages/Registration'
import './App.css'

function App() {

  return (
    <>
        <BrowserRouter>
          <Routes>
            <Route element={<DefaultLayout/>}>
              <Route path="/" element={<Navigate to="/movies" />} />
              <Route path="/movies" element={<Home/>} />
              <Route path="/login" element={<Login/>} />
              <Route path="/register" element={<Registration/>} />
              <Route path="/movies/:id" element={<SingleMovie/>} />
              <Route path="/404" element={<div className='m-auto mt-4 mb-4 text-center'><h1>404 Error</h1><p>Page not found</p></div>} />
            </Route>
          </Routes>
        </BrowserRouter>
    </>
  )
}

export default App
