// BlogDetail.jsx
import React from 'react';
import { useParams } from 'react-router-dom';
import blogData from './data.json'; // Import your JSON data

export const BlogDetail = () => {
  const { blogId } = useParams(); // Get the blogId from the URL
  const blogPost = blogData.find(blog => blog.id === parseInt(blogId)); // Find the blog post by ID

  if (!blogPost) {
    return <div>Blog post not found!</div>; // Handle case where blog post doesn't exist
  }

  return (
    <div className="blog-detail">
      <h1>{blogPost.title}</h1>
      <p>{blogPost.content}</p>
      {/* Add any additional details or styling you want here */}
    </div>
  );
};
