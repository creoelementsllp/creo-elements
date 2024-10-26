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
    const [controlledSwiper, setControlledSwiper] = useState(null);
    const [expandedIndices, setExpandedIndices] = useState([]);
    const [isMobile, setIsMobile] = useState(window.innerWidth < 768);

    const handleVisibility = (entries, swiperRef) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                swiperRef.current?.autoplay?.start();
            } else {
                swiperRef.current?.autoplay?.stop();
            }
        });
    };

    useEffect(() => {
        const handleResize = () => setIsMobile(window.innerWidth < 768);
        window.addEventListener('resize', handleResize);

        // Intersection Observers for visibility control
        const observer1 = new IntersectionObserver(
            (entries) => handleVisibility(entries, swiper1Ref),
            { threshold: 0.5 }
        );

        const observer2 = new IntersectionObserver(
            (entries) => handleVisibility(entries, swiper2Ref),
            { threshold: 0.5 }
        );

        const attachObservers = () => {
            if (swiper1Ref.current?.el) {
                observer1.observe(swiper1Ref.current.el);
            }
            if (swiper2Ref.current?.el) {
                observer2.observe(swiper2Ref.current.el);
            }
        };

        // Attach once Swipers are ready
        if (swiper1Ref.current && swiper2Ref.current) {
            setControlledSwiper({
                swiper1: swiper1Ref.current,
                swiper2: swiper2Ref.current,
            });
            attachObservers();
        }

        return () => {
            window.removeEventListener('resize', handleResize);
            if (swiper1Ref.current?.el) observer1.unobserve(swiper1Ref.current.el);
            if (swiper2Ref.current?.el) observer2.unobserve(swiper2Ref.current.el);
        };
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
                        autoplay={{ delay: 10000, disableOnInteraction: true }}
                    >
                        {slidesData.map((slide) => (
                            <SwiperSlide key={slide.id} data-id={slide.id}>
                                <img src={slide.image} alt="Creo Element's client - " />
                                <div className='testimonials-title'>{slide.content.title}</div>
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
                            // delay: 5000,
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
                                    <div className='testimonials-title'>{slide.content.title}</div>
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
                                    <div className="testimonials-giver">
                                        
                                    <div className='testimonials-name'>
                                        - {slide.content.name}
                                    </div>
                                    <div className='testimonials-position'>
                                        {slide.content.designation}
                                    </div>
                                    </div>
                                </div>
                            </SwiperSlide>
                        ))}
                    </Swiper>
                </div>
            </div>
        </div>
    );
};
