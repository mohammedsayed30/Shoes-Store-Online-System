import styles from './Header.module.css';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faShoppingCart, faUser } from '@fortawesome/free-solid-svg-icons';
import { useCart } from '../Cart/CartContext.jsx';
import { Link } from "react-router-dom";
//import { useNavigate,useState } from 'react-router-dom';

function Header() {
  // Using the useCart hook to get the total items in the cart
  const { totalItems } = useCart();
  return (
    <header>
      <div className={styles.brandUser}>
        <div className={styles.authLinks}>
          <FontAwesomeIcon icon={faUser} className={styles.userIcon} />

            {/* Conditional rendering based on authentication status */}
            {localStorage.getItem("auth_token") ? (
              <Link to="/logout" className={styles.authLink}>Logout</Link>  
            ) : (
              <>
                <Link to="/login" className={styles.authLink}>Login</Link>
                <Link to="/register" className={styles.authLink}>Register</Link>  
              </>
            )}
        </div>
     </div>
      <nav>
        <ul>
          <li>
            <Link to="/recommendations">Recommendations</Link>
          </li>
          <li>
            <Link to="/">Home</Link>
          </li>
          <li>
            <Link to="/about">About</Link>
          </li>
          <li>
            <Link to="/contact">Contact</Link>
          </li>
          <li>
            <Link to="/cart" className={styles.cartLink}>
              <FontAwesomeIcon icon={faShoppingCart} />
              {totalItems > 0 && (
                <span className={styles.cartBadge}>{totalItems}</span>
              )}
            </Link>
          </li>
        </ul>
       
      </nav>
    </header>
  );
}
export default Header;