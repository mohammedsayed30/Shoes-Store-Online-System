// src/components/Login.jsx

import React, { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import { loginUser } from "../../apis/userApis"; // Adjust the import based on your API structure
import "./login.css";

function Login() {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({ email: "", password: "" });
  const [error, setError] = useState("");

  const handleChange = (e) => {
    setFormData((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    try {
        const response = await loginUser(formData);
        if (response.error) {
            setError(response.error);
            return;
        }
      
       // Store the token locally
       localStorage.setItem("auth_token", response.token);
       navigate("/"); // Redirect to home page after successful login
    } catch (err) {
      setError(err.message);
    }
   
  };

  return (
    <div className="login-container">
      <div className="login-box">
        <h2 className="login-title">Login to Your Account</h2>

        {error && <p className="login-error">{error}</p>}

        <form onSubmit={handleSubmit} className="login-form">
          <div className="form-group">
            <label>Email</label>
            <input
              type="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
              required
            />
          </div>

          <div className="form-group">
            <label>Password</label>
            <input
              type="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
              required
            />
          </div>

          <button type="submit" className="login-button">
            Login
          </button>
        </form>

        <p className="register-link">
          Don’t have an account?{" "}
          <Link to="/register">Create new account</Link>
        </p>
      </div>
    </div>
  );
}

export default Login;
