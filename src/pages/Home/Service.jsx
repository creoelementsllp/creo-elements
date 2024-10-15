import React, { useRef, useEffect } from 'react';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';


// Register the ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

import PropTypes from 'prop-types'
import './Service.css'

export const Service = ({ title, description, image, link, id }) => {

    const leftRef = useRef(null);
    const rightRef = useRef(null);
    const serviceRef = useRef(null);
    useEffect(() => {

        const isMobile = window.innerWidth < 768;

        // Different GSAP animations for mobile and desktop
        if (isMobile) {
            // Mobile-specific GSAP animation
            gsap.to(rightRef.current, {
                scale: 1,
                left: '-100%',
                opacity: 1,
                duration: 0.8,
                scrollTrigger: {
                    trigger: serviceRef.current,
                    scroller: 'body',
                    start: '50% 70%', // Trigger point for mobile
                    end: '50% -10%',
                    // markers: true,
                    // toggleActions: 'play reverse play reverse',
                    scrub: true
                },
            });
        } else {
            // Desktop-specific GSAP animation
            gsap.to(rightRef.current, {
                scale: 1,
                opacity: 1,
                duration: 1,
                scrollTrigger: {
                    trigger: serviceRef.current,
                    scroller: 'body',
                    start: 'top 50%', // Trigger point for desktop
                    end: 'top -10%',
                    // markers: true,   
                    toggleActions: 'play reverse play reverse',
                },
            });
        }

    });



    return (
        <div ref={serviceRef} id={id} className="service">
            <div className="left" ref={leftRef}>
                <div className='service-text'>
                    <a href={link}>
                        <h1>{title}</h1>
                    </a>
                    <p>{description}</p>
                </div>
            </div>
            <div className="right" ref={rightRef}>
                <div className='service-image'>
                    <img src={image} alt={title} />
                </div>
            </div>
        </div>
    )
}

Service.propTypes = {
    title: PropTypes.string.isRequired,
    description: PropTypes.string.isRequired,
    image: PropTypes.string.isRequired,
    link: PropTypes.string.isRequired,
    id: PropTypes.string.isRequired
}

export default Service
