const Logout = () => {
  
  //localStorage.removeItem('guest_cart_token');
  //call API to invalidate session if needed
  fetch('http://localhost/BootUp/public/api/v1/user/logout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('auth-token')}`,
      'Accept': 'application/json',
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Logout failed');
    }
    return response.json();
  })

  localStorage.removeItem('auth_token');
  // Optionally redirect or refresh
  window.location.href = '/login';
};

export default Logout;