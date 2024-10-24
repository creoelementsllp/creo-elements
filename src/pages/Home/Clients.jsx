import React from 'react';
// Import Swiper React components
import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/pagination';
import './Clients.css';

import { FreeMode, Pagination, Autoplay } from 'swiper/modules';


export const logos1 = [
  'https://backend.creo-elements.com/wp-content/uploads/2024/07/ATULKASBEKAR.png',
  'http://backend.creo-elements.com/wp-content/uploads/2024/02/Preeti-McConkey.jpeg',
  'http://backend.creo-elements.com/wp-content/uploads/2024/02/19022024-Revised-logo-with-straight-India-Vietnam-Star.png',
  'http://backend.creo-elements.com/wp-content/uploads/2024/10/svgviewer-output-27.svg',
  'http://backend.creo-elements.com/wp-content/uploads/2024/05/peas-logo-2.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/9.jpg', //Sila
  'http://backend.creo-elements.com/wp-content/uploads/2024/10/Smasher-Logo-NoBg.png',
  'http://backend.creo-elements.com/wp-content/uploads/2024/04/United-Logo-on-CREO.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/11.jpg', //Littlethingscute
  'http://backend.creo-elements.com/wp-content/uploads/2024/04/CSP-logo.webp',
  'http://backend.creo-elements.com/wp-content/uploads/2023/09/WhatsApp-Image-2023-09-06-at-18.03.51.jpeg', //ether
  'http://backend.creo-elements.com/wp-content/uploads/2024/02/Zircon-for-CREO-website.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/10.jpg', //innershift
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/5.jpg', //project co.
  'http://backend.creo-elements.com/wp-content/uploads/2024/01/kidsandbagstore-new-logo.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/4.jpg', //doodly
];

// Second array of image URLs (for the second swiper)
export const logos2 = [
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/2.jpg', //hsbc
  'http://backend.creo-elements.com/wp-content/uploads/2024/02/svgviewer-png-output-2.png', //trupsel
  'http://backend.creo-elements.com/wp-content/uploads/2024/04/MM-Bharwada-LOGO.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/10/ALLESTATE.png',
  'https:/backend.creo-elements.com/wp-content/uploads/2024/10/Ray-Logo.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/08/sleepy-tots.png',
  'https:/backend.creo-elements.com/wp-content/uploads/2024/10/Symbol-Black@4x.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/09/mtbalogo-1.png',
  'https:/backend.creo-elements.com/wp-content/uploads/2024/08/parinie-icon.png',
  'http://backend.creo-elements.com/wp-content/uploads/2024/06/natasha-scaled.jpg',
  'http://backend.creo-elements.com/wp-content/uploads/2023/08/social-toast.png',
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/8.jpg', //artangle90
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/7.jpg', //coolab project
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/3.jpg', // Be desi
  'http://backend.creo-elements.com/wp-content/uploads/2023/03/6.jpg', //FNQ
  'http://backend.creo-elements.com/wp-content/uploads/2023/10/CREATIVE-WINDOW.png', //360 south
];



export const Clients = () => {
  // First array of image URLs (for the first swiper)


  return (
    <div className="clients-container full-width" id="clients">





      <div className='clients-container-wrapper'>
        {/* <h2>Trusted by over 50+ clients</h2> */}
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
