import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import WavyText from '../../components/elements/WavyText';
import { Grids } from '../../components/Grids';
import './Blogs.css';

export const BlogDetail = () => {
  const { blogId } = useParams();
  const [blogPost, setBlogPost] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPostDetail = async () => {
      try {
        const response = await fetch(`https://backend.creo-elements.com/reactblog/`);
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        
        // Find the specific post using the blogId
        const post = data.find(item => item.id === parseInt(blogId));
        setBlogPost(post);
      } catch (error) {
        console.error('Error fetching blog post:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchPostDetail();
  }, [blogId]);

  if (loading) {
    return <div>Loading...</div>;
  }

  if (!blogPost) {
    return <div>Blog post not found!</div>;
  }

  // Extracting data from the blogPost object
  const { title, acf_fields, yoast_meta, link } = blogPost;

  // Adjust title with manual line breaks
  const addManualBreaks = (text, charsPerLine = 15) => {
    const words = text.split(' ');
    let line = '';
    let result = '';
    words.forEach(word => {
      if ((line + word).length > charsPerLine) {
        result += line.trim() + '<br>';
        line = word + ' ';
      } else {
        line += word + ' ';
      }
    });
    return result + line.trim();
  };

  const formattedTitle = addManualBreaks(title, 35); // Adjust charsPerLine for 8rem

  return (
    <div className="blog-detail">
      <Grids className='grid-1' />
      <div className='z-2 blog-page-wrapper'>
        {/* Use dangerouslySetInnerHTML within WavyText */}
        <div className="title-wrapper">

        <WavyText fontSize="4rem">
          {formattedTitle }
        </WavyText>
        </div>

        {acf_fields.featured_image && (
          <img src={acf_fields.featured_image} alt={title} />
        )}

        
        <div dangerouslySetInnerHTML={{ __html: acf_fields.blog_content }} />
      </div>
    </div>
  );
};
