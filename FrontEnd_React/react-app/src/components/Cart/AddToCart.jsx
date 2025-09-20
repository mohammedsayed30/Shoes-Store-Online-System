// AddToCart.jsx
import React from 'react';
import { useCart } from './CartContext.jsx';
import styles from './AddToCart.module.css';
import NotificationPortal from '../Notification/NotificationPortal.jsx';
import { getOrCreateCartToken } from '../../utils/cartToken.js';
import { useState } from 'react';


const AddToCart = ({ product,mainFlag=false, disabled, selectedVariant=[] }) => {
 
   const token = getOrCreateCartToken();
  //get the addToCart function from the CartContext
  const { addToCart } = useCart();
  //state to manage notification message
   const [notificationMessage, setNotificationMessage] = useState('');
  //handle click event to add the product to the cart
  const handleClick = (e) => {
    //to make user select size and color before adding to cart
    if(mainFlag) {
      //to display product details to select size and color
        return;
    }
    addToCart(product, selectedVariant, token);

    // message to indicate product was added
    setNotificationMessage(''); // Clear it first
    setTimeout(() => {
     setNotificationMessage(`${product.name} added to cart!`);
    }, 10);
    
  };

  return (
    <>
    <button 
      className={`${styles.addToCartButton} ${disabled ? styles.disabled : ''}`}
      disabled={disabled} 
      onClick={handleClick}
    >
       Add to Cart
    </button>
     <NotificationPortal 
        message={notificationMessage} 
        duration={3000} 
      />
    </>
  );
};

export default AddToCart;



