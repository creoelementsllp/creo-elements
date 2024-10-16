// Blogs.jsx
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import WavyText from '../../components/elements/WavyText';
import './Blogs.css';
import { Blogcard } from './Blogcard'

export const Blogs = () => {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const response = await fetch('https://backend.creo-elements.com/wp-json/wp/v2/posts');
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
    return <div>Loading...</div>;
  }

  return (
    <div className='blogs-page'>
      <div className='blogs-page-wrapper z-2'>
        <WavyText fontSize="8rem">Blogs</WavyText>
        <div className="blog-grid">
          {posts.map((post) => (
            <Blogcard
              key={post.id}
              id={post.id}
              title={post.title.rendered}
              content={post.excerpt.rendered}
              featuredImage={post.featured_media}
            />
          ))}
        </div>
      </div>
    </div>
  );
};
