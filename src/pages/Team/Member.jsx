import React from 'react';
import { useParams } from 'react-router-dom';
import membersData from '../../data/membersData';
import WavyText from '../../components/elements/WavyText'
import { Grids } from '../../components/Grids'
import './Member.css'


export const Member = () => {
  const { memberSlug } = useParams();
  const member = membersData.find(m => m.slug === memberSlug);

  if (!member) {
    return <h2>Member not found</h2>;
  }

  return (
    <div className="member-page">
      <Grids className='grid-1' />
      <div className="member-wrapper z-2">
        <div className="member-image">
          <img src={member.image} alt={member.name} />
        </div>
        <div className="member-content">
          <h1>{member.name}</h1>
          <p>{member.description}</p>
        </div>
      </div>
    </div>
  );
};
