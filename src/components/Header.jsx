// import React, { useState, useEffect } from 'react';
// import './Header.css';
// import { Link } from 'react-router-dom';
// import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
// // import { CreoLogo } from './elements/CreoLogo';
// import { library } from '@fortawesome/fontawesome-svg-core'
// import { fas } from '@fortawesome/free-solid-svg-icons'
// import { faTwitter, faFontAwesome, faInstagram } from '@fortawesome/free-brands-svg-icons'
// library.add(fas, faTwitter, faFontAwesome, faInstagram)

// export const Header = () => {

//   // Use vanilla JS to toggle the menu
//   useEffect(() => {
//     const hamburger = document.querySelector('.hamburger');
//     const mainMenu = document.querySelector('.main-menu');

//     const toggleMenu = () => {
//       mainMenu.classList.toggle('open');
//     };

//     const closeMenuOnClickOutside = (event) => {
//       if (mainMenu && hamburger && !mainMenu.contains(event.target) && !hamburger.contains(event.target)) {
//         mainMenu.classList.remove('open');
//       }
//     };

//     hamburger.addEventListener('click', toggleMenu);
//     document.addEventListener('click', closeMenuOnClickOutside);

//     // Cleanup listeners on component unmount
//     return () => {
//       hamburger.removeEventListener('click', toggleMenu);
//       document.removeEventListener('click', closeMenuOnClickOutside);
//     };
//   }, []);

//   return (
//     <header>
//       <button className="hamburger" aria-label="Open Menu">
//         <FontAwesomeIcon icon="fa-solid fa-bars" />
//       </button>
//       <nav aria-label="Main Navigation">
//         <ul className="main-menu">
//           <li className="menu-items">
//             <Link to="/" className="clickable">Home</Link>
//           </li>
//           <li className="menu-items has-sub-menu">
//             <span>What We Do</span>
//             <div className="sub-menu-container">
//             <ul className="sub-menu">
//               <li className="sub-menu-items"><Link to="/services/social-media" className="clickable">Social Media</Link></li>
//               <li className="sub-menu-items"><Link to="/services/web-development" className="clickable">Web Design / Development</Link></li>
//               <li className="sub-menu-items"><Link to="/services/seo" className="clickable">SEO</Link></li>
//               <li className="sub-menu-items"><Link to="/services/digital-marketing" className="clickable">Digital Marketing</Link></li>
//               <li className="sub-menu-items"><Link to="/services/branding" className="clickable">Branding</Link></li>
//               <li className="sub-menu-items"><Link to="/services/performance-marketing" className="clickable">Performance Marketing</Link></li>
//               <li className="sub-menu-items"><Link to="/services/packaging" className="clickable">Packaging</Link></li>
//               <li className="sub-menu-items"><Link to="/services/gifting-solutions" className="clickable">Gifting Solutions</Link></li>
//               <li className="sub-menu-items"><Link to="/services/print-solutions" className="clickable">Print Solutions</Link></li>
//               <li className="sub-menu-items"><Link to="/services/photography" className="clickable">Photography</Link></li>
//               <li className="sub-menu-items"><Link to="/services/pr" className="clickable">Public Relations (PR)</Link></li>
//             </ul>
//             </div>
//           </li>
//           <li className="menu-items">
//             <Link to="/about" className="clickable">About Us</Link>
//           </li>
//           <li className="menu-items">
//             <Link to="/work-with-us" className="clickable">Work With Us</Link>
//           </li>
//           <li className="menu-items">
//             <Link to="/clients" className="clickable">Our Clients</Link>
//           </li>
//           <li className="menu-items">
//             <Link to="/contact-us" className="clickable">Contact Us</Link>
//           </li>
//           <li className="menu-items">
//             <Link to="/blog" className="clickable">Blogs</Link>
//           </li>
//         </ul>
//       </nav>
//     </header>

//   );
// };

import React, { useState, useEffect, useRef } from 'react';
import './Header.css';
import { Link, NavLink } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { faTwitter, faFontAwesome, faInstagram } from '@fortawesome/free-brands-svg-icons';

library.add(fas, faTwitter, faFontAwesome, faInstagram);

const servicesLinks = [
  { to: '/services/social-media', label: 'Social Media' },
  { to: '/services/web-development', label: 'Web Design / Development' },
  { to: '/services/seo', label: 'SEO' },
  { to: '/services/digital-marketing', label: 'Digital Marketing' },
  { to: '/services/branding', label: 'Branding' },
  { to: '/services/performance-marketing', label: 'Performance Marketing' },
  { to: '/services/packaging', label: 'Packaging' },
  { to: '/services/gifting-solutions', label: 'Gifting Solutions' },
  { to: '/services/print-solutions', label: 'Print Solutions' },
  { to: '/services/photography', label: 'Photography' },
  { to: '/services/pr', label: 'Public Relations (PR)' },
];

const primaryLinks = [
  { to: '/', label: 'Home' },
  { to: '/about', label: 'About Us' },
  { to: '/work-with-us', label: 'Work With Us' },
  { to: '/clients', label: 'Our Clients' },
  { to: '/contact-us', label: 'Contact Us' },
  { to: '/blog', label: 'Blogs' },
];

export const Header = () => {
  const [menuOpen, setMenuOpen] = useState(false);
  const [mobileServicesOpen, setMobileServicesOpen] = useState(false);
  const navRef = useRef(null);
  const hamburgerRef = useRef(null);

  useEffect(() => {
    const closeOnClickOutside = (event) => {
      if (
        navRef.current &&
        hamburgerRef.current &&
        !navRef.current.contains(event.target) &&
        !hamburgerRef.current.contains(event.target)
      ) {
        setMenuOpen(false);
        setMobileServicesOpen(false);
      }
    };
    document.addEventListener('click', closeOnClickOutside);
    return () => document.removeEventListener('click', closeOnClickOutside);
  }, []);

  useEffect(() => {
    document.body.classList.toggle('nav-open', menuOpen);
    return () => document.body.classList.remove('nav-open');
  }, [menuOpen]);

  const closeAll = () => {
    setMenuOpen(false);
    setMobileServicesOpen(false);
  };

  return (
    <header className={menuOpen ? 'is-open' : ''}>
      {/* <Link to="/" className="header-brand" onClick={closeAll}>
        Creo Elements
      </Link> */}

      <button
        ref={hamburgerRef}
        className="hamburger"
        aria-label={menuOpen ? 'Close Menu' : 'Open Menu'}
        aria-expanded={menuOpen}
        onClick={() => setMenuOpen((open) => !open)}
      >
        <span className="hamburger-bar" />
        <span className="hamburger-bar" />
        <span className="hamburger-bar" />
      </button>

      <nav aria-label="Main Navigation" ref={navRef}>
        <ul className={`main-menu ${menuOpen ? 'open' : ''}`}>
          <li className="menu-items">
            <NavLink to="/" end className="clickable" onClick={closeAll}>Home</NavLink>
          </li>

          <li className={`menu-items has-sub-menu ${mobileServicesOpen ? 'sub-open' : ''}`}>
            <button
              type="button"
              className="clickable sub-menu-trigger"
              onClick={() => setMobileServicesOpen((open) => !open)}
              aria-expanded={mobileServicesOpen}
            >
              What We Do
              <svg className="sub-menu-caret" width="10" height="6" viewBox="0 0 10 6" fill="none">
                <path d="M1 1L5 5L9 1" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" />
              </svg>
            </button>
            <div className="sub-menu-container">
              <ul className="sub-menu">
                {servicesLinks.map((item) => (
                  <li className="sub-menu-items" key={item.to}>
                    <Link to={item.to} className="clickable" onClick={closeAll}>{item.label}</Link>
                  </li>
                ))}
              </ul>
            </div>
          </li>

          {primaryLinks.slice(1).map((item) => (
            <li className="menu-items" key={item.to}>
              <NavLink to={item.to} className="clickable" onClick={closeAll}>{item.label}</NavLink>
            </li>
          ))}
        </ul>
      </nav>
    </header>
  );
};