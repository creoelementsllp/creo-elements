// Blog.jsx
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

export const Blogcard = ({ id, title, content, featuredImage }) => {
  const [imageUrl, setImageUrl] = useState(null);

  useEffect(() => {
    const fetchImage = async () => {
      if (featuredImage) {
        try {
          const response = await fetch(`https://backend.creo-elements.com/wp-json/wp/v2/media/${featuredImage}`);
          const imageData = await response.json();
          setImageUrl(imageData.source_url);
        } catch (error) {
          console.error('Error fetching image:', error);
          setImageUrl('default-image-url.jpg'); // Fallback if fetching fails
        }
      } else {
        setImageUrl('default-image-url.jpg'); // Fallback if no image
      }
    };

    fetchImage();
  }, [featuredImage]);

  return (
    <div className="blog-card">
      <Link to={`/blog/${id}`}>
        {imageUrl && <img src={imageUrl} alt={title} className="blog-featured-image" />}
        <h2 dangerouslySetInnerHTML={{ __html: title }} />
      </Link>
      <p dangerouslySetInnerHTML={{ __html: content }} />
    </div>
  );
};
