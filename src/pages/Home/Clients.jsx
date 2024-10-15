import React from 'react';
// Import Swiper React components
import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/pagination';
import './Clients.css';

import { FreeMode, Pagination, Autoplay } from 'swiper/modules';

export const Clients = () => {
  // First array of image URLs (for the first swiper)
  const logos1 = [
    'https://via.placeholder.com/150x80?text=Logo+1',
    'https://via.placeholder.com/150x80?text=Logo+2',
    'https://via.placeholder.com/150x80?text=Logo+3',
    'https://via.placeholder.com/150x80?text=Logo+4',
    'https://via.placeholder.com/150x80?text=Logo+5',
    'https://via.placeholder.com/150x80?text=Logo+6',
    'https://via.placeholder.com/150x80?text=Logo+7',
    'https://via.placeholder.com/150x80?text=Logo+8',
    'https://via.placeholder.com/150x80?text=Logo+9',
    'https://via.placeholder.com/150x80?text=Logo+10',
  ];

  // Second array of image URLs (for the second swiper)
  const logos2 = [
    'https://via.placeholder.com/150x80?text=Logo+1',
    'https://via.placeholder.com/150x80?text=Logo+2',
    'https://via.placeholder.com/150x80?text=Logo+3',
    'https://via.placeholder.com/150x80?text=Logo+4',
    'https://via.placeholder.com/150x80?text=Logo+5',
    'https://via.placeholder.com/150x80?text=Logo+6',
    'https://via.placeholder.com/150x80?text=Logo+7',
    'https://via.placeholder.com/150x80?text=Logo+8',
    'https://via.placeholder.com/150x80?text=Logo+9',
    'https://via.placeholder.com/150x80?text=Logo+10',
  ];

  return (
    <div className="clients-container" id="clients">





      <div className='clients-container-wrapper'>
        <h2>Trusted by over 1000+ companies</h2>
        <div className='clients-swiper-wrapper'>
          <div className='firstswiper-wrapper'>
            {/* First Swiper: Left to Right (Normal Direction) */}
            <Swiper
              slidesPerView={5} // Number of logos visible at once
              spaceBetween={30} // Space between each logo
              freeMode={true}
              loop={true} // Infinite loop
              autoplay={{
                delay: 0,
                disableOnInteraction: false,
              }}
              speed={6000} // Scrolling speed
              modules={[FreeMode, Pagination, Autoplay]}
              className="mySwiper"
            >
              {logos1.map((logo, index) => (
                <SwiperSlide key={index}>
                  <img src={logo} alt={`Logo ${index + 1}`} />
                </SwiperSlide>
              ))}
            </Swiper>
          </div>
          <div className='secondswiper-wrapper'>
            {/* Second Swiper: Right to Left (Opposite Direction) */}
            <Swiper
              slidesPerView={5} // Number of logos visible at once
              spaceBetween={30} // Space between each logo
              freeMode={true}
              loop={true} // Infinite loop
              autoplay={{
                delay: 0,
                disableOnInteraction: false,
                reverseDirection: true, // Reverse the direction
              }}
              speed={6000} // Scrolling speed
              modules={[FreeMode, Pagination, Autoplay]}
              className="mySwiper reverseSwiper"
            >
              {logos2.map((logo, index) => (
                <SwiperSlide key={index}>
                  <img src={logo} alt={`Alt Logo ${index + 1}`} />
                </SwiperSlide>
              ))}
            </Swiper>
          </div>
        </div>
      </div>
    </div>
  );
};
