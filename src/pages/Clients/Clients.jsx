import React, { useState, useEffect } from 'react';
import '../Home/Home.css';
import { Testimonials } from '../Home/Testimonials';
import { Clients } from '../Home/Clients';
import { Partners } from '../Home/Partners';
import { Grids } from '../../components/Grids'
import './Clients.css'
import WavyText from '../../components/elements/WavyText'

export const ClientPage = () => {

  useEffect(() => {
    const handleResize = () => setIsMobile(window.innerWidth < 768);
    window.addEventListener('resize', handleResize);
    
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  return (
    <div className="clients-page">

<Grids className='grid-1' />
    <div className='clients-wrapper'>
    <div className="client-banner z-2">
      <WavyText fontSize={ '8rem' }>Our Clients</WavyText>

    </div>
      
      <Clients />
    </div>
    </div>
  );
};

