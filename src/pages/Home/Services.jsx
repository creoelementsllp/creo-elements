import React, { useState , useEffect } from 'react'
import Service from './Service'
import { Grids } from '../../components/Grids'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas ,faArrowRight, faArrowLeft} from '@fortawesome/free-solid-svg-icons'
import { faTwitter, faFontAwesome} from '@fortawesome/free-brands-svg-icons'

library.add(faArrowRight);


const servicesData = [
    {
        title: "Social Media",
        image: "/images/social-media.webp",
        description: "In today's digital world, social media is a powerful tool for brands to connect with customers, build brand awareness, and drive sales. But managing a successful social media presence requires more than just posting occasionally. This is where social media services for brands come in.",
        link: "/services/social-media"
    },
    {
        title: "Web Development",
        image: "/images/web-design.webp",
        description: "Your website is your digital handshake. In today's online world, it's the first impression you make on potential customers. We go beyond just creating virtual storefronts at CREO Elements. We craft websites that embody your brand's DNA, reflecting your values and dedication to quality. Unforgettable user experiences are our specialty. We'll bring your digital vision to life, ensuring every visitor leaves with a positive impression.",
        link: "/services/web-development"
    },
    {
        title: "SEO",
        image: "/images/seo.webp",
        description: "SEO stands for Search Engine Optimization. It's the ongoing process of optimizing your website and online presence to improve its visibility in search engine results pages (SERPs) for relevant keywords. The higher you rank, the more likely potential customers are to discover your brand.",
        link: "/services/seo"
    },
    {
        title: "Digital Marketing",
        image: "/images/digital-marketing.webp",
        description: "Imagine a world where potential customers can't find your brand online. In today's digital landscape, that's a harsh reality for businesses without a strong digital marketing strategy.",
        link: "/services/digital-marketing"
    },
    {
        title: "Branding",
        image: "/images/branding.webp",
        description: "Your brand is your identity. It's the essence of what makes your company unique and the emotional connection you forge with your customers. Branding is a comprehensive strategy encompassing everything from your visual identity to messaging.",
        link: "/services/branding"
    },
    {
        title: "Performance Marketing",
        image: "/images/target-marketing.webp",
        description: "Performance marketing is all about maximizing your return on investment (ROI) by focusing on marketing activities that deliver measurable results.",
        link: "/services/performance-marketing"
    },
    {
        title: "Packaging",
        image: "/images/packaging.webp",
        description: "Your packaging is more than just a box. It's a silent salesperson, a brand ambassador on every shelf, and a crucial element in the customer experience.",
        link: "/services/packaging"
    },
    {
        title: "Gifting Solutions",
        image: "/images/gifting-solutions.webp",
        description: "CREO Elements takes the guesswork out of gifting with our Corporate Gifting Service. We handle everything, from selecting thoughtful gifts that align with your brand to personalized messaging and seamless delivery.",
        link: "/services/gifting-solutions"
    },
    {
        title: "Print Solutions",
        image: "/images/print-solutions.webp",
        description: "Make a lasting impression across all touch points with our one-stop shop for premium printing solutions.",
        link: "/services/print-solutions"
    },
    {
        title: "Photography",
        image: "/images/photography.webp",
        description: "Visuals are powerful storytellers. In today's digital age, high-quality photos and videos are essential for capturing attention, building brand identity, and driving sales.",
        link: "/services/photography"
    },
    {
        title: "Public Relations (PR)",
        image: "/images/pr.webp",
        description: "PR involves crafting messages that get people to trust and recognize the brand. It uses various tools to spread awareness and shape how the public sees the company.",
        link: "/services/pr"
    },
];

export const Services = () => {
    const [activeService, setActiveService] = useState(0);
    const [isInteracted, setIsInteracted] = useState(false);

    const handleClick = (index) => {
        setActiveService(index);
        setIsInteracted(true); // Stop the loop on user interaction
    };

    const handlePrevious = () => {
        setActiveService((prev) => (prev === 0 ? servicesData.length - 1 : prev - 1));
        setIsInteracted(true); // Stop the loop on button click
    };

    const handleNext = () => {
        setActiveService((prev) => (prev + 1) % servicesData.length);
        setIsInteracted(true); // Stop the loop on button click
    };

    useEffect(() => {
        if (isInteracted) return; // Stop the loop if there's any user interaction

        const interval = setInterval(() => {
            setActiveService((prev) => (prev + 1) % servicesData.length);
        }, 3000); // Change service every 3 seconds

        return () => clearInterval(interval); // Clean up the interval on component unmount
    }, [isInteracted]);

    return (
        <div className="services-wrapper full-width">
            <div className="services-navigation">
                <button onClick={handlePrevious} className='callback-button'><FontAwesomeIcon icon={faArrowLeft} /></button>
            </div>
            <div className="services">
                {servicesData.map((service, index) => (
                    <div
                        key={index}
                        className={`service ${activeService === index ? "active" : ""}`}
                        onClick={() => handleClick(index)}
                    >
                        <div className="service-image">
                            <img src={service.image} alt={service.title} />
                        </div>
                        <div className="service-title">
                            {activeService === index ? (
                                <a href={service.link} className='clickable' style={{color: "#3eb8a2"}}>{service.title}</a>
                            ) : (
                                service.title
                            )}
                        </div>
                        <div
                            className="service-description"
                            style={{ fontSize: activeService === index ? "1rem" : "0rem" }}
                        >
                            {service.description}
                        </div>
                    </div>
                ))}
            </div>
            
            <button onClick={handleNext} className='callback-button'><FontAwesomeIcon icon={faArrowRight} /></button>
        </div>
    );
};