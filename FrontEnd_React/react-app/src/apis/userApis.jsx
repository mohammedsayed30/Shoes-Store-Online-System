
const BASE_URL = 'http://localhost/BootUp/public/api/v1/users';

const headers = () => ({
  'Content-Type': 'application/json',
    'Accept': 'application/json',
    //'X-Guest-Token': localStorage.getItem('guestToken') || ''
});

//regiter function

export const registerUser = async (userData) => {
  const res = await fetch(`${BASE_URL}/register`, {
    method: 'POST',
    headers: headers(),
    credentials: 'include',
    body: JSON.stringify(userData),
  });
  if (!res.ok) throw new Error(`Failed to register user: ${res.status}`);
  return res.json();
}

//login function
export const loginUser = async (credentials) => {
  const res = await fetch(`${BASE_URL}/login`, {
    method: 'POST',
    headers: headers(),
    credentials: 'include',
    body: JSON.stringify(credentials),
  });
  if (!res.ok) throw new Error(`Failed to login user: ${res.status}`);
  return res.json();
}