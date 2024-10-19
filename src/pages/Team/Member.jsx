import React from 'react';
import { useParams } from 'react-router-dom';
import membersData from '../../data/membersData';

export const Member = () => {
  const { memberSlug } = useParams();
  const member = membersData.find(m => m.slug === memberSlug);

  if (!member) {
    return <h2>Member not found</h2>;
  }

  return (
    <div className="member-page">
      <h1>{member.name}</h1>
      <img src={member.image} alt={member.name} />
      <p>{member.description}</p>
    </div>
  );
};
