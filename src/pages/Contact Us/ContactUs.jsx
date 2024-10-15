import React from 'react'
import { Grids } from '../../components/Grids';
import WavyText from '../../components/elements/WavyText'
import './ContactUs.css'

export const ContactUS = () => {
    return (
        // <TransitionWrapper>
        <div>
            <div className='contact-page'>

                <Grids className='grid-1' />

                <div className='contact-page-wrapper z-2'>
                    <WavyText fontSize="8rem">Contact Us</WavyText>

                    






                </div>
            </div>
        </div>
        // </TransitionWrapper>
    );
}
