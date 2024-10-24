import React, { useRef, useState, useEffect } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import './Testimonials.css';
import { Navigation, Controller, Pagination, Autoplay } from 'swiper/modules';
import * as data from './Testimonials.json';

export const Testimonials = () => {
    const pagination = {
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '"></span>';
        },
    };

    const slidesData = data.slidesData;
    const swiper1Ref = useRef(null);
    const swiper2Ref = useRef(null);
    const navigationPrevRef = React.useRef(null);
    const navigationNextRef = React.useRef(null);

    const [controlledSwiper, setControlledSwiper] = useState(null);
    const [expandedIndices, setExpandedIndices] = useState([]);
    const [isMobile, setIsMobile] = useState(window.innerWidth < 768);

    useEffect(() => {
        if (swiper1Ref.current && swiper2Ref.current) {
            setControlledSwiper({
                swiper1: swiper1Ref.current,
                swiper2: swiper2Ref.current,
            });
        }

        const handleResize = () => setIsMobile(window.innerWidth < 768);
        window.addEventListener('resize', handleResize);

        return () => window.removeEventListener('resize', handleResize);
    }, [swiper1Ref.current, swiper2Ref.current]);

    const toggleExpand = (index) => {
        setExpandedIndices((prev) =>
            prev.includes(index) ? prev.filter(i => i !== index) : [...prev, index]
        );
    };

    return (
        <div className="testimonials-container full-width">
            <div className="testimonials-wrapper">
                <div className='left-side-test'>
                    <Swiper
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
                        controller={{ control: controlledSwiper?.swiper2 }}
                    >
                        {slidesData.map((slide) => (
                            <SwiperSlide key={slide.id} data-id={slide.id}>
                                <img src={slide.image} alt="Creo Element's client -" />
                            </SwiperSlide>
                        ))}
                    </Swiper>
                </div>
                <div className='right-side-test'>
                    <Swiper
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
                        controller={{ control: controlledSwiper?.swiper1 }}
                    >
                        {slidesData.map((slide, index) => (
                            <SwiperSlide key={slide.id} data-id={slide.id}>
                                <div className="testimonial-content">
                                    <h4>{slide.content.title}</h4>
                                    <p>
                                        {isMobile ? (
                                            expandedIndices.includes(index) ? (
                                                slide.content.text
                                            ) : (
                                                <>
                                                    {slide.content.text.slice(0, 100)}...
                                                    {slide.content.text.length > 100 && (
                                                        <span
                                                            onClick={() => toggleExpand(index)}
                                                            className="read-more"
                                                        >
                                                            Read More
                                                        </span>
                                                    )}
                                                </>
                                            )
                                        ) : (
                                            slide.content.text
                                        )}
                                        {expandedIndices.includes(index) && isMobile && (
                                            <span
                                                onClick={() => toggleExpand(index)}
                                                className="read-more"
                                            >
                                                Show Less
                                            </span>
                                        )}
                                    </p>
                                </div>
                            </SwiperSlide>
                        ))}
                    </Swiper>
                </div>
            </div>
        </div>
    );
};
