import React, { useEffect } from 'react';
import './About.css'; // Import specific styles for About page
import { gsap } from 'gsap';
import TransitionWrapper from '../../components/TransitionWrapper';
import {Banner} from './Banner'
import {Grids} from '../../components/Grids'
import {Story} from './Story'
import {Ourteam} from './Ourteam'

function About() {



  return (
    // <TransitionWrapper>
    <div>
    <div className='about-page'>
    
    <Grids className='grid-1'/>
      <Banner />
      <Story />
      <Ourteam />
    </div>
    </div>
    // </TransitionWrapper>
  );
}

export default About;
