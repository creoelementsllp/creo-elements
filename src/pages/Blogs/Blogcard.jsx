import React from 'react';
import { Link } from 'react-router-dom';

export const Blogcard = ({ id, title, content, featuredImage }) => {
  return (
    <div className="blog-card">
      <Link to={`/blog/${id}`}>
        {featuredImage && <img src={featuredImage} alt={title} className="blog-featured-image" />} 
        <h2 dangerouslySetInnerHTML={{ __html: title }} />
      </Link>
      <p dangerouslySetInnerHTML={{ __html: content }} />
    </div>
  );
};
