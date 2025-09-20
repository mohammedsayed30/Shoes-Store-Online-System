// src/api/cartApi.js

const BASE_URL = 'http://localhost/BootUp/public/api/v1/cart';

const headers = () => ({
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'X-Guest-Token': localStorage.getItem('guest_cart_token') || ''
});

export const fetchCart = async () => {
  const res = await fetch(`${BASE_URL}/get`, {
    method: 'GET',
    headers: headers(),
    credentials: 'include',
  });
  if (!res.ok) throw new Error(`Failed to fetch cart: ${res.status}`);
  return res.json();
};

export const addProductToCart = async (product, selectedVariant, token) => {
  const res = await fetch(`${BASE_URL}/add`, {
    method: 'POST',
    headers: {
      ...headers(),
      'X-Guest-Token': token,
    },
    credentials: 'include',
    body: JSON.stringify({
      product_id: Number(product.id),
      quantity: 1,
      size: Number(selectedVariant.size),
      color: selectedVariant.color.toString()
    }),
  });
  if (!res.ok) throw new Error(`Failed to add product: ${res.status}`);
  return res.json();
};

export const updateProductQuantity = async (id, offset) => {
  const res = await fetch(`${BASE_URL}/update`, {
    method: 'PUT',
    headers: headers(),
    credentials: 'include',
    body: JSON.stringify({ product_id: id, quantity: offset }),
  });
  if (!res.ok) throw new Error(`Failed to update quantity: ${res.status}`);
  return res.json();
};

export const deleteProduct = async (id) => {
  const res = await fetch(`${BASE_URL}/delete`, {
    method: 'DELETE',
    headers: headers(),
    credentials: 'include',
    body: JSON.stringify({ product_id: id }),
  });
  if (!res.ok) throw new Error(`Failed to delete product: ${res.status}`);
  return res.json();
};
