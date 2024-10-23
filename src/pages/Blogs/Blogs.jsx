import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import WavyText from '../../components/elements/WavyText';
import { Grids } from '../../components/Grids';
import './Blogs.css';
import { Blogcard } from './Blogcard';

export const Blogs = () => {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const response = await fetch('https://backend.creo-elements.com/reactblog/');
        const data = await response.json();
        setPosts(data);
      } catch (error) {
        console.error('Error fetching posts:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchPosts();
  }, []);

  if (loading) {
    return (
      <div className='blogs-page'>
        <Grids className='grid-1' />
        <div className='blogs-page-wrapper z-2'>
          <WavyText fontSize="8rem">Blogs</WavyText>
          <div className="blog-grid">
            Loading...
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className='blogs-page'>
      <Grids className='grid-1' />
      <div className='blogs-page-wrapper z-2'>
      <div className="blogs-heading">
        <WavyText fontSize="8rem">Blogs</WavyText>
        </div>
        <div className="blog-grid">
          {posts.map((post) => (
            <Blogcard
              key={post.id}
              id={post.id}
              title={post.title} // Adjusted to match your JSON
              content={post.acf_fields.blog_content} // Using ACF field
              featuredImage={post.acf_fields.featured_image} // Adjusted to your ACF featured image URL
            />
          ))}
        </div>
      </div>
    </div>
  );
};
