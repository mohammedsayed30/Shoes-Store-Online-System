// CartContext.js
import React, { createContext, useState, useEffect, useContext } from 'react';

import { fetchCart,addProductToCart,updateProductQuantity, deleteProduct} from '../../apis/cartApis';


const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState([]);
  const [totalItems, setTotalItems] = useState(0);
  const [totalPrice, setTotalPrice] = useState(0);
  const [isLoading, setIsLoading] = useState(true);
  const [notificationMessage, setNotificationMessage] = useState('');

  // resuable function to fetch cart data
 const refreshCart = async () => {
  try {
    const data = await fetchCart();
    setCart(data.data.cart || []);
    setTotalItems(data.data.totalItems || 0);
    setTotalPrice(data.data.totalPrice || 0);
  } catch (err) {
    console.error('Error fetching cart:', err);
  }
};
//when the component mounts, fetch the cart data
  useEffect(() => {
    refreshCart().finally(() => setIsLoading(false)) ;
  }, []);

const addToCart = (product, selectedVariant, token) => {
  setIsLoading(true);
  addProductToCart(product, selectedVariant, token)
    .then(() => refreshCart())
    .then(() => {
      setNotificationMessage('');
      setTimeout(() => {
        setNotificationMessage('Product added successfully to the cart!');
      }, 10);
    })
    .finally(() => setIsLoading(false))
    .catch(err => console.error('add product failed:', err));
};

const updateQuantity = (id, offset) => {
  setIsLoading(true);
  updateProductQuantity(id, offset)
    .then(() => refreshCart())
    .then(() => {
      setNotificationMessage('');
      setTimeout(() => {
        setNotificationMessage('Product Quantity updated successfully!');
      }, 10);
    })
    .catch(err => {
      console.error('Update quantity failed:', err);
      setNotificationMessage('Failed to update product quantity.');
    })
    .finally(() => setIsLoading(false));
};

const removeItem = (id) => {
  setIsLoading(true);
  deleteProduct(id)
    .then(() => refreshCart())
    .then(() => {
      setNotificationMessage('');
      setTimeout(() => {
        setNotificationMessage('Product removed from the cart successfully!');
      }, 10);
    })
    .finally(() => setIsLoading(false))
    .catch(err => console.error('remove product failed:', err));
};

  // Provide cart context to children components
  return (
    <CartContext.Provider
      value={{
        cart,
        totalItems,
        totalPrice,
        isLoading,
        setIsLoading,
        addToCart,
        updateQuantity,
        removeItem,
        notificationMessage,
        setNotificationMessage,
        refreshCart
      }}
    >
      {children}
    </CartContext.Provider>
  );
};





export const useCart = () => useContext(CartContext);
