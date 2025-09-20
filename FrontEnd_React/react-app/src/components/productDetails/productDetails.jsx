import React, { useEffect, useState } from 'react';
import AddToCart from '../Cart/AddToCart.jsx';
import styles from './ProductDetails.module.css';
import ErrorMessage from '../ErrorMessage/ErrorMessage';

import { useLocation } from 'react-router-dom';

function ProductDetails() {
  const location = useLocation();
  const getQueryParam = (key) => {
    const params = new URLSearchParams(location.search);
    return params.get(key);
  };

  const productId = getQueryParam('id');
  const [product, setProduct] = useState(null);
  const [selectedSize, setSelectedSize] = useState(null);
  const [selectedColor, setSelectedColor] = useState(null);
  //set product variation 
  const [productVariants, setProductVariants] = useState([]);
  const [error, setError] = useState(null);

  //fetch product details from the API
  useEffect(() => {
    if (!productId) {
      setError('No product ID found');
      return;
    }

    fetch(`http://localhost/BootUp/public/api/v1/products/${productId}`)
      .then(res => {
        if (!res.ok) throw new Error('Failed to fetch product');
        return res.json();
      })
      .then(json => {
        setProduct(json); 
      })
      .catch(err => {
        setError(err.message);
        
      });
  }, [productId]);

//fetch product variations from the API
  useEffect(() => {
    if (!productId) {
      setError('No product ID found for variations');
      return;
    }

    fetch(`http://localhost/BootUp/public/api/v1/products/${productId}/variants`)
      .then(res => {
        if (!res.ok) throw new Error('Failed to fetch product variations');
        return res.json();
      })
       .then(data => {
        // Transform API response to match our structure
        setProductVariants(data.variations);
      })
      .catch(err => {
        setError(err.message);
      });
  }, [productId]);


  // Handle error state

  if (error) {
    return <ErrorMessage error={error} />;
  }

  
   // Get available colors for selected size
  const availableColors = selectedSize 
    ? productVariants.find(v => v.size == selectedSize)?.colors || []
    : [];

const isAddToCartDisabled = !selectedSize || !selectedColor;

  
  if(product) {
   return (
      <div className={styles.container}>
        <h2 className={styles.title}>{product.name}</h2>
        <img
          src={`http://localhost/BootUp/public/${product.image}`}
          alt={product.name}
          className={styles.image}
        />
        <p className={styles.description}>{product.description}</p>
        <p className={styles.price}>Price: ${product.price}</p>

        {/* Size Selector */}
      <div className={styles.selector}>
        <label htmlFor="size">Size:</label>
        <select 
          id="size"
          value={selectedSize || ''}
          onChange={(e) => {
            setSelectedSize(e.target.value);
            setSelectedColor(null); // Reset color when size changes
          }}
        >
          <option value="">Select size</option>
          {productVariants.map(variant => (
            <option 
              key={variant.size} 
              value={variant.size}
              disabled={variant.stock <= 0}
            >
              {variant.size} {variant.stock <= 0 ? '(Out of stock)' : ''}
            </option>
          ))}
        </select>
      </div>


       {/* Color Selector (only shows when size is selected) */}
        {selectedSize && (
        <div className={styles.selector}>
          <label htmlFor="color">Color:</label>
          <select
            id="color"
            value={selectedColor || ''}
            onChange={(e) => setSelectedColor(e.target.value)}
          >
            <option value="">Select color</option>
            {availableColors.map(color => (
              <option key={color} value={color}>
                {color}
              </option>
            ))}
          </select>
        </div>
      )}

      <AddToCart product={product}
        disabled={isAddToCartDisabled}
        selectedVariant={{
          size: selectedSize,
          color: selectedColor
        }}
        />
    </div>
  )};
}

export default ProductDetails;
