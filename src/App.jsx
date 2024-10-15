import React, { useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, useLocation } from 'react-router-dom';
import Home from './pages/Home/Home';
import About from './pages/About/About';
import { Header } from './components/Header';
import Footer from './components/Footer';
import './App.css';
import Cursor from './components/Cursor';
import {Service} from './pages/Services/Service';
import { CreoLogo } from './components/elements/CreoLogo';
import { WorkWithUS } from './pages/Work With Us/WorkWithUS';
import { ContactUS } from '/src/pages/Contact Us/ContactUs.jsx';
import { Blogs } from './pages/Blogs/Blogs'
import { BlogDetail } from './pages/Blogs/BlogDetail'; // Import your BlogDetail component



function App() {
  const location = useLocation();

  useEffect(() => {
    const hash = location.hash;
    if (hash) {
      const elementId = hash.replace("#", "");
      const scrollToHashElement = () => {
        const element = document.getElementById(elementId);
        if (element) {
          element.scrollIntoView({ behavior: "smooth" });  // Use scrollIntoView instead of undefined scrollToElement
        } else {
          setTimeout(scrollToHashElement, 100);
        }
      };
      scrollToHashElement();
    } else {
      window.scrollTo(0, 0);
    }
  }, [location]);
  

  return (
    <div>
      <Cursor />
      
      {location.pathname !== "/" && <CreoLogo />}
      <Header />
      <Routes location={location}>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/work-with-us" element={<WorkWithUS />} />
        <Route path="/contact-us" element={<ContactUS />} />
        <Route path="/blog" element={<Blogs />} />
        <Route path="/blog/:blogId" element={<BlogDetail />} />
        {/* Updated route to use serviceSlug */}
        <Route path="/services/:serviceSlug" element={<Service />} />
      </Routes>
      <Footer />
    </div>
  );
}

export default App;
