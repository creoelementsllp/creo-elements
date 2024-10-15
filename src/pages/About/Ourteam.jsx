import React, { useRef, useEffect } from 'react';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { MotionPathPlugin } from 'gsap/MotionPathPlugin';
import './Ourteam.css';

gsap.registerPlugin(ScrollTrigger, MotionPathPlugin);

// Sample JSON data for team members
const membersData = [
  {
    name: "Naeem A Merchant",
    designation: "Co-founder",
    description: "A seasoned business professional, with over 20 years of experience navigating the online business world across various industries and geographies. Naeem brings a wealth of knowledge and expertise to the table. Known for his ability to break down complex digital concepts into clear, understandable terms, Naeem customizes his approach to fit each client’s specific needs.",
    image: 'src/assets/images/Naeem-Sir-1.webp',
  },
  {
    name: "Member 2",
    designation: "Designation 2",
    description: "Description for member 2.",
    image: 'src/assets/images/Naeem-Sir-1.webp',
  },
  {
    name: "Member 3",
    designation: "Designation 3",
    description: "Description for member 3.",
    image: 'src/assets/images/Naeem-Sir-1.webp',
  },
  {
    name: "Member 4",
    designation: "Designation 4",
    description: "Description for member 4.",
    image: 'src/assets/images/Naeem-Sir-1.webp',
  },
];

export const Ourteam = () => {
  const membersRef = useRef([]);

  useEffect(() => {
    // Set up ScrollTrigger for each member
    membersRef.current.forEach((member, index) => {
      const duration = 2; // Adjust this duration to speed up or slow down the animation

      gsap.fromTo(
        member,
        {
          opacity: 0,
          y: 0,
        },
        {
          opacity: 1,
          scrollTrigger: {
            trigger: member,
            start: "top 75%", // Start animation when the top of the member hits 75% of the viewport height
            end: "top 50%", // End when the top of the member hits 50% of the viewport height
            scrub: true, // Enables scrub animation
            // markers: true, // Optional: shows markers for debugging
          },
        }
      );
    });

    // Clean up ScrollTrigger instances on component unmount
    return () => {
      ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
    };
  }, []);

  return (
    <div className='our-team z-2'>
      <div className="ourteam-wrapper">
        <div className="ourteam-header">
          <h2>Our team</h2>
        </div>
        <div className='ourteam-content'>
          <div className="ourteam-members">
            {membersData.map((member, index) => (
              <div
                className='member'
                ref={el => (membersRef.current[index] = el)} // Store references to each member
                key={index}
              >
                <div className='member-image'>
                  <img src={member.image} alt={`Member ${index + 1}`} />
                </div>
                <div className='member-name'>
                  {member.name}
                </div>
                <div className='designation'>
                  {member.designation}
                </div>
                <div className='member-description'>
                  {member.description}
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}
