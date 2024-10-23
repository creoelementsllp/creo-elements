import React from 'react'
import './Partners.css'

export const Partners = () => {
  return (
    <div className='partners-container full-width'>
        <div className="partners-container-inner">
          <div className="partner-header">
            Affiliates & Partners
          </div>
          <div className="partner-body">
            <div className="partner">
              <img src="https://creo-elements.com/wp-content/uploads/2024/06/hostinger.png" className='partner-image'></img>
              <div className='partner-name'>Hostinger</div>
              <div className='partner-description'>Delivering high-performance web hosting solutions with exceptional support and reliability.</div>
            </div>
            
            <div className="partner">
              <img src="https://creo-elements.com/wp-content/uploads/2024/06/woocommerce.png" className='partner-image'></img>
              <div className='partner-name'>Woocommerce</div>
              <div className='partner-description'>Empowering your online presence with a versatile and customizable platform for building websites and running e-commerce stores seamlessly.</div>
            </div>
            
            <div className="partner">
              <img src="https://creo-elements.com/wp-content/uploads/2024/06/godaddy.png" className='partner-image'></img>
              <div className='partner-name'>Godaddy</div>
              <div className='partner-description'>Your go-to provider for domain registration, web hosting, and online marketing tools.</div>
            </div>
            
            <div className="partner">
              <img src="https://creo-elements.com/wp-content/uploads/2024/06/airpay.png" className='partner-image'></img>
              <div className='partner-name'>Airpay</div>
              <div className='partner-description'>Simplifying transactions with secure and seamless payment processing services.</div>
            </div>
            
            <div className="partner">
              <img src="https://creo-elements.com/wp-content/uploads/2024/06/shopify.png" className='partner-image'></img>
              <div className='partner-name'>Shopify</div>
              <div className='partner-description'>Powering your e-commerce success with robust and easy-to-use online store solutions.</div>
            </div>
          </div>
        </div>
    </div>
  )
}
