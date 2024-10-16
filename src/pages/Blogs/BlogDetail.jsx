// BlogDetail.jsx
import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

export const BlogDetail = () => {
  const { blogId } = useParams();
  const [blogPost, setBlogPost] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPostDetail = async () => {
      try {
        const response = await fetch(`https://backend.creo-elements.com/wp-json/wp/v2/posts/${blogId}`);
        const data = await response.json();
        setBlogPost(data);
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

  return (
    <div className="blog-detail">
      <h1 dangerouslySetInnerHTML={{ __html: blogPost.title.rendered }} />
      <div dangerouslySetInnerHTML={{ __html: blogPost.content.rendered }} />
    </div>
  );
};
