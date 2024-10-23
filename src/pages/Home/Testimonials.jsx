import React, { useRef, useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import './Testimonials.css';
import { Navigation, Controller, Pagination ,Autoplay} from 'swiper/modules';
import * as data from './Testimonials.json';


export const Testimonials = () => {
    // Single JSON list for both Swipers

    const pagination = {
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' +  '</span>';
        },
      };

    const slidesData = data.slidesData;
    // Refs for both Swipers
    const swiper1Ref = useRef(null);
    const swiper2Ref = useRef(null);



    const navigationPrevRef = React.useRef(null)
    const navigationNextRef = React.useRef(null)


    // State to control when the controllers are set
    const [controlledSwiper, setControlledSwiper] = useState(null);

    useEffect(() => {
        if (swiper1Ref.current && swiper2Ref.current) {
            setControlledSwiper({
                swiper1: swiper1Ref.current,
                swiper2: swiper2Ref.current,
            });
        }
    }, [swiper1Ref.current, swiper2Ref.current]);

    return (
        <div className="testimonials-container full-width">




            <div className="testimonials-wrapper">
                <div className='left-side-test'>
                    {/* First Swiper with Testimonials */}
                    <Swiper
                        // navigation={true}
                        // loop={true}
                        
                        effect='coverflow'
                        grabCursor={true}
                        centeredSlides={true}
                        slidesPerView={2}
                        coverflowEffect={{
                            rotate: 0,
                            stretch: 0,
                            depth: 50,
                            modifier: 6,
                            slideShadows: false,

                        }}
                        modules={[Navigation, Controller]}
                        className="mySwiper"
                        onSwiper={(swiper) => {
                            swiper1Ref.current = swiper;
                        }}
                        controller={{ control: controlledSwiper?.swiper2 }} // Control second swiper
                    >
                        {slidesData.map((slide) => (
                            <SwiperSlide key={slide.id} data-id={slide.id}>
                                <img src={slide.image} alt="Creo Element's client -" />
                                {/* {slide.testimonial} */}
                            </SwiperSlide>
                        ))}
                    </Swiper>
                </div>
                <div className='right-side-test'>
                    {/* Second Swiper with Reviewer Names */}
                    <Swiper
                        // loop={true}
                        // navigation={{
                        //     // Both prevEl & nextEl are null at render so this does not work
                        //     prevEl: navigationPrevRef.current,
                        //     nextEl: navigationNextRef.current,
                        // }}
                       
        pagination={pagination}
                        direction='vertical'
                        modules={[Navigation, Controller, Pagination, Autoplay]}
                        className="mySwiper2"
                        autoplay={{
          delay: 5000,
          disableOnInteraction: true,
        }}
                        onSwiper={(swiper) => {
                            swiper2Ref.current = swiper;
                        }}
                        controller={{ control: controlledSwiper?.swiper1 }} // Control first swiper
                    >
                        {slidesData.map((slide) => (
                            <SwiperSlide key={slide.id} data-id={slide.id}>
                            <div className="testimonial-content">
                                <h4>
                                    {slide.content.title}</h4>
                                <p>
                                    {slide.content.text}</p>
                            </div>
                            </SwiperSlide>
                        ))}
                    </Swiper>
                </div>
            </div>





        </div>
    );
};
