import React, { useState, useEffect } from 'react';
import './Home.css';
import { Banner } from './Banner';
import { BannerMobile } from './BannerMobile';
import { Threesixty } from './Threesixty';
import { About } from './About';
import { Services } from './Services';
import { Testimonials } from './Testimonials';
import { Clients } from './Clients';
import { Partners } from './Partners';

function Home({ updaters }) {
  const [isMobile, setIsMobile] = useState(window.innerWidth < 825);

  useEffect(() => {
    const handleResize = () => setIsMobile(window.innerWidth < 825);
    window.addEventListener('resize', handleResize);
    
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  return (
    <div className='homepage'>
    <head>
    <meta name="descripition" content="Your partner for enhancing online presence and business growth through digital marketing strategies" />
    </head>
      {isMobile ? <BannerMobile /> : <Banner updaters={updaters} />}
      <Threesixty />
      <About />
      <Services/>
      <Testimonials />
      <Clients />
      <Partners />
    </div>
  );
}

export default Home;
