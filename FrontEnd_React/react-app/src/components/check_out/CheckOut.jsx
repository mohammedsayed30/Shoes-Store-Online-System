import React, { useState } from 'react';
import { sendCheckout } from '../../apis/checkOut';
import { useCart } from '../Cart/CartContext';
import { useNavigate } from 'react-router-dom';
import './CheckOut.css';

const CheckoutForm = () => {
  const [stripeToken, setStripeToken] = useState('');
  const [address, setAddress] = useState('');
  const [error, setError] = useState('');
  const [successMsg, setSuccessMsg] = useState('');
  //use cart context to refresh cart after checkout
  const { refreshCart,setIsLoading,isLoading} = useCart();
  const navigate = useNavigate();


  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setSuccessMsg('');

    try {
      setIsLoading(true);
      // Await the sendCheckout call
      await sendCheckout(stripeToken, address);   
      // Only execute this if sendCheckout succeeds (no error thrown)
      setSuccessMsg('Order completed successfully!');
      // Refresh cart after successful checkout
      await refreshCart();
      setIsLoading(false);
      // Redirect to home or another page after a successful checkout
      setTimeout(() => {
         navigate('/');
      }, 4000);
    } catch (err) {
        setError(err.message);
        setIsLoading(false);
        setTimeout(() => {
        navigate('/cart');
        }, 3000); // Redirect to cart after error
    }
  };

  if(isLoading) {
    return <div className="spinner"></div>; 
  }

  return (
    <form className="checkout-form" onSubmit={handleSubmit}>
      <h2>Checkout</h2>

      <label>Stripe Token:</label>
      <input
        type="text"
        value={stripeToken}
        onChange={(e) => setStripeToken(e.target.value)}
        required
      />

      <label>Address:</label>
      <input
        type="text"
        value={address}
        onChange={(e) => setAddress(e.target.value)}
        required
      />

      <button type="submit">Checkout</button>

      {successMsg && <p className="success">{successMsg}</p>}
      {error && <p className="error">{error}</p>}
    </form>
  );
};

export default CheckoutForm;
