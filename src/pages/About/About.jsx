import React, { useEffect , useState} from 'react';
import './About.css'; // Import specific styles for About page
import { gsap } from 'gsap';
import TransitionWrapper from '../../components/TransitionWrapper';
import {Banner} from './Banner'
import {Grids} from '../../components/Grids'
import {Story} from './Story'
import { StoryMobile } from './StoryMobile.jsx'
import {Ourteam} from './Ourteam'

function About() {
  const [isMobile, setIsMobile] = useState(window.innerWidth < 768);

  useEffect(() => {
    const handleResize = () => setIsMobile(window.innerWidth < 768);
    window.addEventListener('resize', handleResize);
    
    return () => window.removeEventListener('resize', handleResize);
  }, []);



  return (
    // <TransitionWrapper>
    <div>
    <div className='about-page'>
    
    <Grids className='grid-1'/>
      <Banner />
      {/* <Story /> */}
      {isMobile ? <StoryMobile /> : <Story />}
      <Ourteam />
    </div>
    </div>
    // </TransitionWrapper>
  );
}

export default About;
