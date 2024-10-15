import React from 'react';
import { Grids } from '../../components/Grids';
import WavyText from '../../components/elements/WavyText';
import './Blogs.css';
import { Blog, Blogcard } from './Blog';
import blogData from './data.json'; // Adjust the path if necessary

export const Blogs = () => {
    return (
        <div>
            <div className='blogs-page'>
                <Grids className='grid-1' />
                <div className='blogs-page-wrapper z-2'>
                    <WavyText fontSize="8rem">Blogs</WavyText>
                    {blogData.map(blog => (
                        <Blogcard id={blog.id} title={blog.title} content={blog.content} />
                    ))}
                </div>
            </div>
        </div>
    );
}