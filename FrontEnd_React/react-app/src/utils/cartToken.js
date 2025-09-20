export const getOrCreateCartToken = () => {
  let token = localStorage.getItem('guest_cart_token');
  if (!token) {
    token = crypto.randomUUID(); // or `Date.now().toString(36)` for simpler ID
    localStorage.setItem('guest_cart_token', token);
  }
  return token;
};