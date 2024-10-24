import React, { useState, useEffect } from 'react';
import { Grids } from '../../components/Grids';
import WavyText from '../../components/elements/WavyText';
import './ContactUs.css';

export const ContactUS = () => {
    const [formData, setFormData] = useState({
        name: '',
        help: '',
        budget: '',
        deadline: '',
        brand: '',
        industry: '',
        website: '',
        website_url: '',
        email: '',
        phone: ''
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await fetch('https://backend.creo-elements.com/wp-json/custom/v1/forminator-submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();
            if (response.ok) {
                alert('Form submitted successfully!');
            } else {
                alert('Failed to submit form: ' + result);
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('There was an error submitting the form. Please try again.');
        }
    };

    const [isMobile, setIsMobile] = useState(window.innerWidth < 768);

    useEffect(() => {
      const handleResize = () => setIsMobile(window.innerWidth < 768);
      window.addEventListener('resize', handleResize);
      
      return () => window.removeEventListener('resize', handleResize);
    }, []);

    return (
        <div>
            <div className='contact-page'>
                <Grids className='grid-1' />

                <div className='contact-page-wrapper z-2'>
                    <div className="page-title">
                        
                    {isMobile? <WavyText fontSize="3rem" text="Contact Us" /> : <WavyText fontSize="8rem">Contact Us</WavyText>}
                    </div>
                    <form onSubmit={handleSubmit} className="contact-form">
                    <label for="name">Hello my name is</label>
                        <input
                            type="text"
                            name="name"
                            placeholder="Your Name"
                            value={formData.name}
                            onChange={handleChange}
                            required
                        />
                        
                    <label for="help">I'm looking for help with </label>
                        <input
                            type="text"
                            name="help"
                            placeholder="Website, branding, social media"
                            value={formData.help}
                            onChange={handleChange}
                            required
                        />

                    <label for="budget">My budget is </label>
                        <input
                            type="text"
                            name="budget"
                            placeholder="Your Budget"
                            value={formData.budget}
                            onChange={handleChange}
                            required
                        />
                        
                    <label for="deadline">And i need it by</label>
                        <input
                            type="text"
                            name="deadline"
                            placeholder="next month, 1 week"
                            value={formData.deadline}
                            onChange={handleChange}
                            required
                        />
                        
                    <label for="brand">My brand name is</label>
                        <input
                            type="text"
                            name="brand"
                            placeholder="Brand Name"
                            value={formData.brand}
                            onChange={handleChange}
                            required
                        />
                        
                    <label for="industry">which is into</label>
                        <input
                            type="text"
                            name="industry"
                            placeholder="the industry"
                            value={formData.industry}
                            onChange={handleChange}
                            required
                        />
                        
                        <select
                            name="website"
                            // placeholder="Do you have a website?"
                            value={formData.website}
                            onChange={handleChange}
                        >
                            <option value="yes">
                                I have a website
                            </option>
                            <option value="no">
                                I don't have a website
                            </option>
                        </select>
                        
                    <label for="website_url">It's on</label>
                        <input
                            type="url"
                            name="website_url"
                            placeholder="yourwebsite.com"
                            value={formData.website_url}
                            onChange={handleChange}
                        />
                        
                    <label for="email">Please contact me at</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            value={formData.email}
                            onChange={handleChange}
                            required
                        />
                    <label for="email">and</label>
                        <input
                            type="text"
                            name="phone"
                            placeholder="Phone"
                            value={formData.phone}
                            onChange={handleChange}
                            required
                        />
                        <div className='submit-button'>
                            <button type="submit" className='callback-button clickable'>Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};
