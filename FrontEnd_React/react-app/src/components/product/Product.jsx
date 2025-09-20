import React, { useState, useEffect } from 'react';
import styles from './Product.module.css';
import { useLocation, useNavigate } from 'react-router-dom';
import AddToCart from '../Cart/AddToCart.jsx';
import ErrorMessage from '../ErrorMessage/ErrorMessage';
import { CgNametag } from 'react-icons/cg';

function Product() {
  //get the url information
  const location = useLocation();
  const navigate = useNavigate();

  const getQueryParam = (key) => {
    const params = new URLSearchParams(location.search);
    return params.get(key);
  };

  const pageFromUrl = parseInt(getQueryParam('page')) || 1;
  const [currentPage, setCurrentPage] = useState(pageFromUrl);
  const [products, setProducts] = useState([]);
  const [lastPage, setLastPage] = useState(null);
  const [error, setError] = useState(null);

  const fetchProducts = (page) => {
    fetch(`http://localhost/BootUp/public/api/v1/products?page=${page}`)
      .then(res => {
        if (!res.ok) throw new Error('Failed to fetch');
        return res.json();
      })
      .then(json => {
        setProducts(json.data);
        setLastPage(json.last_page);

        if (page > json.last_page) {
          setCurrentPage(json.last_page);
          navigate(`?page=${json.last_page}`);
        } 
        else if (page < 1) {
          setCurrentPage(1);
          navigate(`?page=1`);
        }

      })
      .catch(err => {
        setError(err.message);
       
      });
  };

  useEffect(() => {
    fetchProducts(currentPage);
    navigate(`?page=${currentPage}`);
  }, [currentPage]);

  const handleNext = () => {
    if (lastPage && currentPage < lastPage) {
      const nextPage = currentPage + 1;
      setCurrentPage(nextPage);
    }
  };

  const handlePrevious = () => {
    if (currentPage > 1) {
      const prevPage = currentPage - 1;
      setCurrentPage(prevPage);
    }
  };
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
  
 
  if (error) {
    return <ErrorMessage error={error} />;
  }

  if (!products || products.length === 0) {
    return <div className="spinner"></div>;
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

      {/* pagination */}
      <div className={styles.paginationContainer}>
        <button
          className={styles.paginationButton}
          onClick={handlePrevious}
          disabled={currentPage === 1}
        >
          Previous
        </button>
        
        <span className={styles.paginationInfo}>
          Page {currentPage} of {lastPage}
        </span>
        
        <button
          className={styles.paginationButton}
          onClick={handleNext}
          disabled={currentPage === lastPage}
        >
          Next
        </button>
    </div>
    </div>
  );
}

export default Product;
