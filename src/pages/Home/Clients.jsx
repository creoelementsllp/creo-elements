import React, { useEffect, useRef } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/pagination';
import './Clients.css';
import { FreeMode, Pagination, Autoplay } from 'swiper/modules';


export const logos1 = [
  'https://backend.creo-elements.com/wp-content/uploads/2024/07/ATULKASBEKAR.png',
  'https://backend.creo-elements.com/wp-content/uploads/2024/02/Preeti-McConkey.jpeg',
  'https://backend.creo-elements.com/wp-content/uploads/2024/02/19022024-Revised-logo-with-straight-India-Vietnam-Star.png',
  'https://backend.creo-elements.com/wp-content/uploads/2024/10/kconcept.jpg',
  'https://backend.creo-elements.com/wp-content/uploads/2024/10/svgviewer-output-27.svg',
  'https://backend.creo-elements.com/wp-content/uploads/2024/05/peas-logo-2.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/9.jpg', //Sila
  'https://backend.creo-elements.com/wp-content/uploads/2024/10/Smasher-Logo-NoBg.png',
  'https://backend.creo-elements.com/wp-content/uploads/2024/04/United-Logo-on-CREO.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/11.jpg', //Littlethingscute
  'https://backend.creo-elements.com/wp-content/uploads/2024/04/CSP-logo.webp',
  'https://backend.creo-elements.com/wp-content/uploads/2023/09/WhatsApp-Image-2023-09-06-at-18.03.51.jpeg', //ether
  'https://backend.creo-elements.com/wp-content/uploads/2024/02/Zircon-for-CREO-website.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/10.jpg', //innershift
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/5.jpg', //project co.
  'https://backend.creo-elements.com/wp-content/uploads/2024/01/kidsandbagstore-new-logo.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/4.jpg', //doodly
];

// Second array of image URLs (for the second swiper)
export const logos2 = [
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/2.jpg', //hsbc
  'https://backend.creo-elements.com/wp-content/uploads/2024/02/svgviewer-png-output-2.png', //trupsel
  'https://backend.creo-elements.com/wp-content/uploads/2024/04/MM-Bharwada-LOGO.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/10/ALLESTATE.png',
  'https://backend.creo-elements.com/wp-content/uploads/2024/10/Ray-Logo.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/08/sleepy-tots.png',
  'https://backend.creo-elements.com/wp-content/uploads/2024/10/Symbol-Black@4x.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/09/mtbalogo-1.png',
  'https://backend.creo-elements.com/wp-content/uploads/2024/08/parinie-icon.png',
  'https://backend.creo-elements.com/wp-content/uploads/2024/06/natasha-scaled.jpg',
  'https://backend.creo-elements.com/wp-content/uploads/2023/08/social-toast.png',
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/8.jpg', //artangle90
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/7.jpg', //coolab project
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/3.jpg', // Be desi
  'https://backend.creo-elements.com/wp-content/uploads/2023/03/6.jpg', //FNQ
  'https://backend.creo-elements.com/wp-content/uploads/2023/10/CREATIVE-WINDOW.png', //360 south
];



export const Clients = () => {
  const firstSwiperRef = useRef(null);
  const secondSwiperRef = useRef(null);

  const handleVisibility = (entries, swiperRef) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        swiperRef.current?.swiper?.autoplay.start();
      } else {
        swiperRef.current?.swiper?.autoplay.stop();
      }
    });
  };

  useEffect(() => {
    const firstObserver = new IntersectionObserver(
      (entries) => handleVisibility(entries, firstSwiperRef),
      { threshold: 0.5 }
    );

    const secondObserver = new IntersectionObserver(
      (entries) => handleVisibility(entries, secondSwiperRef),
      { threshold: 0.5 }
    );

    if (firstSwiperRef.current) {
      firstObserver.observe(firstSwiperRef.current);
    }
    if (secondSwiperRef.current) {
      secondObserver.observe(secondSwiperRef.current);
    }

    return () => {
      if (firstSwiperRef.current) {
        firstObserver.unobserve(firstSwiperRef.current);
      }
      if (secondSwiperRef.current) {
        secondObserver.unobserve(secondSwiperRef.current);
      }
    };
  }, []);

  return (
    <div className="clients-container full-width" id="clients">
      <div className='clients-container-wrapper'>
        <div className='clients-swiper-wrapper'>
          <div className='firstswiper-wrapper' ref={firstSwiperRef}>
            <Swiper
              slidesPerView={5}
              spaceBetween={30}
              freeMode={true}
              loop={true}
              autoplay={{
                delay: 0,
                disableOnInteraction: false,
              }}
              speed={6000}
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
          <div className='secondswiper-wrapper' ref={secondSwiperRef}>
            <Swiper
              slidesPerView={5}
              spaceBetween={30}
              freeMode={true}
              loop={true}
              autoplay={{
                delay: 0,
                disableOnInteraction: false,
                reverseDirection: true,
              }}
              speed={6000}
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