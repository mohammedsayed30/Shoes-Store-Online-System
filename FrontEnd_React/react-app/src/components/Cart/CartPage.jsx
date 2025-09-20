// CartPage.js
import { Link, useNavigate  } from 'react-router-dom';
import styles from './CartPage.module.css';
import { useCart } from '../Cart/CartContext';
import NotificationPortal from '../Notification/NotificationPortal.jsx';
import { useEffect } from 'react';

const CartPage = () => {
  const navigate = useNavigate();
  //get the cart content from CartContext
  const { cart, totalItems, totalPrice, isLoading, updateQuantity, removeItem,setIsLoading, notificationMessage ,setNotificationMessage } 
  = useCart();
  

  useEffect(() => {
    // Clear notification message when cart page loads
    if (notificationMessage) {
      setNotificationMessage('');
    }
  }, []);

  //spinner loading
  if (isLoading) {
    return <div className="spinner"></div>;
  }
 

  //sort cart items (first by added latest)
  // const sortedCart = [...cart].sort((a, b) =>
  //     new Date(b.created_at) - new Date(a.created_at)
  // );

  //handle the check out
  const handleCheckout = () => {
    const token = localStorage.getItem("auth_token");

    if (!token) {
      // Not logged in, redirect to login
      navigate("/login");
    } else {
      // User is logged in, go to checkout page
      navigate("/checkout"); // Replace with your real checkout route
    }
  };

  return (
    <div className={styles.cartContainer}>
      <h2>Your Shopping Cart</h2>

      {totalItems === 0 ? (
        <div className={styles.emptyCart}>
          <p>Your cart is empty</p>
          <Link to="/" className={styles.continueShopping}>
            Continue Shopping
          </Link>
        </div>
      ) : (
        <>
          <div className={styles.cartItems}>
            {cart.map(item => (
              <div key={item.id} className={styles.cartItem}>
                <img
                  src={`http://localhost/BootUp/public/${item.attributes.image}`}
                  alt={item.name}
                  className={styles.cartItemImage}
                  onError={(e) => {
                    e.target.src = '/placeholder.jpg';
                    e.target.onerror = null;
                  }}
                />

                <div className={styles.itemDetails}>
                  <h3>{item.name}</h3>
                  <p>Price: ${parseFloat(item.price).toFixed(2)}</p>
                </div>

                <div className={styles.quantityControls}>
                  <button
                      aria-label="Decrease quantity"
                      onClick={() => {
                        if (item.quantity > 1) updateQuantity(item.id, -1);
                      }}
                  >−</button>

                  <span>{item.quantity}</span>

                  <button onClick={() => updateQuantity(item.id,1)}>+</button>
                   
                </div>
                 
                <button className={styles.removeButton} onClick={() => removeItem(item.id)}>
                  Remove
                </button>
                <div className={styles.itemTotal}>
                  ${(item.price * item.quantity).toFixed(2)}
                </div>
              </div>
            ))}
            
          </div>

          <div className={styles.cartSummary}>
            <h3>Total: ${totalPrice.toFixed(2)}</h3>
            <button className={styles.checkoutButton} onClick={()=>handleCheckout()}>Proceed to Checkout</button>
          </div>
        </>
      )}
      {notificationMessage && (
                <NotificationPortal 
                  message={notificationMessage} 
                  duration={3000} 
                />
      )}
    </div>
  );
};

export default CartPage;
