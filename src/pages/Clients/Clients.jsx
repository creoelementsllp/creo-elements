import React, { useState, useEffect } from 'react';
import '../Home/Home.css';
import { logos1, logos2 } from '../Home/Clients';
import { Grids } from '../../components/Grids';
import './Clients.css';
import WavyText from '../../components/elements/WavyText';

export const ClientPage = () => {
  useEffect(() => {
    const handleResize = () => setIsMobile(window.innerWidth < 768);
    window.addEventListener('resize', handleResize);
    
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  const [isMobile, setIsMobile] = useState(window.innerWidth < 768);

  // Join logos1 and logos2
  const combinedLogos = [...logos1, ...logos2]; // You can also use logos1.concat(logos2)

  return (
    <div className="clients-page">
      <Grids className='grid-1' />
      <div className='clients-wrapper'>
        <div className="client-banner z-2">
          {isMobile ? (
            <WavyText fontSize={'3rem'}>Our Clients</WavyText>
          ) : (
            <WavyText fontSize={'8rem'}>Our Clients</WavyText>
          )}
        </div>

        {/* Render combined logos */}
        <div className="logos-wrapper z-2">
          {combinedLogos.map((logo, index) => (
            <img key={index} src={logo} alt={`Client logo ${index + 1}`} className="client-logo" />
          ))}
        </div>

      </div>
    </div>
  );
};
