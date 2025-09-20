import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import AddToCart from '../Cart/AddToCart.jsx';
import ErrorMessage from '../ErrorMessage/ErrorMessage';
import styles from './recommendations.module.css';

function Recommendations() {
  const navigate = useNavigate();
  const token = localStorage.getItem("auth_token");
  const [products, setProducts] = useState([]);
  const [error, setError] = useState(null);
   const [loading, setLoading] = useState(true);
  const fetchProducts = () => {
     fetch(`http://localhost/BootUp/public/api/v1/recommendations`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json',
        'X-Guest-Token': localStorage.getItem('guest_cart_token') ,
     },
     credentials: 'include',
    })
      .then(res => {
        if (!res.ok) throw new Error('Failed to fetch');
        return res.json();
      })
      .then(json => {
        setProducts(json.recommendations);
        setLoading(false);
      })
      .catch(err => {
        setError(err.message);
         setLoading(false);
      });
  };

  useEffect(() => {
    fetchProducts();
  }, []);

  //handle click event
  const handleProductClick = async (productId) => {
    try {
      //go to the product details page first for user-experience
      navigate(`/product?id=${productId}`);
      if (localStorage.getItem("auth_token")) {
          // Make API request to store the user interaction for recommendation system
          await fetch(`http://localhost/BootUp/public/api/v1/store/interactions`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'Authorization': `Bearer ${localStorage.getItem("auth_token")}`
            },
            credentials: 'include',
            body: JSON.stringify({
              product_id: productId,
            })
          });
      }
    } catch (error) {
      console.error('Failed to track click:', error);
      // Navigate to home if there's an error
      navigate(`/`);
    }
  };


  if (loading) {
    return <div className="spinner"></div>;
  }
  if (products.length === 0) {
    <Messages 
                headerMessage="No Recommendations"
                textMessage="There is no recommendations availble for you know please interact with the products to know what you like."
      />
  }
  if (error) {
    return <ErrorMessage error={error} />;
  }

  


 

  return (
    <div>
      <div>
        {products.map(product => (
          <div key={product.id} className={styles.Product} 
            onClick={() => handleProductClick(product.id)} style={{ cursor: 'pointer' }} >
            <img
              className={styles.ProductImage}
              src={`http://localhost/BootUp/public/${product.image}`}
              alt={product.name}
            />
            <h4 className={styles.ProductTitle}>{product.name}</h4>
            <p className={styles.ProductContent}>Price: ${product.price}</p>
            <AddToCart product={product} mainFlag={true}/>
          </div>
        ))}
      </div>
    </div>
  );
}

export default Recommendations;