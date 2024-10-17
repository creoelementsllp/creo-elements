import React from 'react'
import Service from './Service'
import { Grids } from '../../components/Grids'

export const Services = () => {
    return (


        <div className='services_section'>
            <Grids className='grid-1' />

            <div className='section_heading' style={{ zIndex: 2 }}>Services</div>

            <div className='services_container' style={{ zIndex: 2 }}>
                <Service
                    title="Social Media"
                    description="In today's digital world, social media is a powerful tool for brands to connect with customers, build brand awareness, and drive sales. But managing a successful social media presence requires more than just posting occasionally. This is where social media services for brands come in."
                    image="/images/social-media.webp"
                    link="/services/web-development"
                    id="social-media"
                />


                <Service
                    title="Social Media"
                    description="In today's digital world, social media is a powerful tool for brands to connect with customers, build brand awareness, and drive sales. But managing a successful social media presence requires more than just posting occasionally. This is where social media services for brands come in."
                    image="/images/social-media.webp"
                    link="/services/web-development"
                    id="web-design"
                />
                <Service
                    title="Social Media"
                    description="In today's digital world, social media is a powerful tool for brands to connect with customers, build brand awareness, and drive sales. But managing a successful social media presence requires more than just posting occasionally. This is where social media services for brands come in."
                    image="/images/social-media.webp"
                    link="/services/web-development"
                    id="social-media"
                />


                <Service
                    title="Social Media"
                    description="In today's digital world, social media is a powerful tool for brands to connect with customers, build brand awareness, and drive sales. But managing a successful social media presence requires more than just posting occasionally. This is where social media services for brands come in."
                    image="/images/social-media.webp"
                    link="/services/web-development"
                    id="web-design"
                />

            </div>
        </div>
    )
}
