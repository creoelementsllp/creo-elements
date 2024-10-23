import React, { useState } from 'react';
import { Grids } from '../../components/Grids';
import WavyText from '../../components/elements/WavyText';
import './WorkWithUs.css';

export const WorkWithUS = () => {

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
        phone: '',
        cv: null, // Added to store the CV file
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleFileChange = (e) => {
        setFormData({
            ...formData,
            cv: e.target.files[0] // Store the file object
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        // Create a FormData object to handle text and file data
        const formDataObject = new FormData();
        formDataObject.append('name', formData.name);
        formDataObject.append('help', formData.help);
        formDataObject.append('budget', formData.budget);
        formDataObject.append('website', formData.website);
        formDataObject.append('cv', formData.cv); // Attach the file

        try {
            const response = await fetch('https://backend.creo-elements.com/wp-json/custom/v1/application-submit', {
                method: 'POST',
                body: formDataObject, // Use FormData object for file uploads
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

    return (
        <div>
            <div className='contact-page'>
                <Grids className='grid-1' />

                <div className='contact-page-wrapper z-2'>
                    <div className="page-title">
                        <WavyText fontSize="8rem">Work With Us</WavyText>
                    </div>
                    <form onSubmit={handleSubmit} className="contact-form">
                        <label htmlFor="name">Hello my name is</label>
                        <input
                            type="text"
                            name="name"
                            placeholder="Your Name"
                            value={formData.name}
                            onChange={handleChange}
                            required
                        />

                        <label htmlFor="help">My Email is</label>
                        <input
                            type="email"
                            name="help"
                            placeholder="your@emailaddress.com"
                            value={formData.help}
                            onChange={handleChange}
                            required
                        />

                        <label htmlFor="budget">My Phone Number is</label>
                        <input
                            type="text"
                            name="budget"
                            placeholder="+91 1234567890"
                            value={formData.budget}
                            onChange={handleChange}
                            required
                        />

                        <label htmlFor="industry">I want to work as a</label>
                        <select
                            name="website"
                            value={formData.website}
                            onChange={handleChange}
                        >
                            <option value="graphic designer">
                                Graphic Designer
                            </option>
                            <option value="operation manager">
                                Operations Manager
                            </option>
                            <option value="social media manager">
                                Social Media Manager
                            </option>
                            <option value="web designer">
                                Web Designer
                            </option>
                        </select>

                        <label htmlFor="cv">Upload your CV</label>
                        <input
                            type="file"
                            name="cv"
                            accept=".pdf,.doc,.docx"
                            onChange={handleFileChange}
                            required
                        />

                        <div className='submit-button'>
                            <button type="submit" className='callback-button clickable'>Apply here</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};
