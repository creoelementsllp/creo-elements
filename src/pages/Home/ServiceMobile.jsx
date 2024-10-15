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

        gsap.to(
            rightRef.current, {
            // transform: "translateX(0vw)",
            scale: 1,
            // duration: 0.5,
            scrollTrigger: {
                trigger: serviceRef.current,
                scroller: 'body',
                start: 'top 50%',
                end: 'top -10%',
                markers: true,
                // scrub: true,
                toggleActions: 'play reverse play reverse',
            }
        }
        );

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
