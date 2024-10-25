import React, { useState, useEffect } from 'react';
import '../Home/Home.css';
import { logos1, logos2 } from '../Home/Clients';
import { Grids } from '../../components/Grids';
import './Clients.css';
import WavyText from '../../components/elements/WavyText';

export const ClientPage = () => {
  useEffect(() => {
    const handleResize = () => setIsMobile(window.innerWidth < 825);
    window.addEventListener('resize', handleResize);
    
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  const [isMobile, setIsMobile] = useState(window.innerWidth < 825);

  // Get the first half and second half of logos1 and logos2
  const halfIndex1 = Math.ceil(logos1.length / 2);
  const halfIndex2 = Math.ceil(logos2.length / 2);

  const firstHalfLogos = [...logos1.slice(0, halfIndex1), ...logos2.slice(0, halfIndex2)];
  const secondHalfLogos = [...logos1.slice(halfIndex1), ...logos2.slice(halfIndex2)];

  // Combine them in the desired order
  const combinedLogos = [...firstHalfLogos, ...secondHalfLogos];

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
