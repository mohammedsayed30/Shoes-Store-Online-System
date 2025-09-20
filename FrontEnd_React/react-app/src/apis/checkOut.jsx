export const sendCheckout = async (stripeToken, address) => {
  const token = localStorage.getItem('auth-token');

  const res = await fetch('http://localhost/BootUp/public/api/v1/order/checkout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json',
      'X-Guest-Token': localStorage.getItem('guest_cart_token') ,
    },
    credentials: 'include',
    body: JSON.stringify({
      stripeToken: stripeToken.toString(),
      address: address.toString()
    })
  });
  if (!res.ok) {
    const err = await res.json();
     if (res.status === 400) {
      throw new Error(err.message || 'Cart is empty'); // Use server message or default
    }
    throw new Error('Checkout failed');
  }

  return res.json();
};
