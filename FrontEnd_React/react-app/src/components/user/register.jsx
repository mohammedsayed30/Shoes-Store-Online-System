// src/components/Register.jsx

import React, { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import "./Register.css";
import { registerUser } from "../../apis/userApis"; // Adjust the import based on your API structure
function Register() {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    mobile: "",
    password: "",
    password_confirmation: "",
  });
  const [error, setError] = useState("");

  const handleChange = (e) => {
    setFormData((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");

    try {
      const response = await registerUser(formData);
      if (response.error) {
        setError(response.error);
        return;
      }
      
      navigate("/login"); // Redirect to login page after successful registration
    } catch (err) {
      setError(err.message);
    }
  };

  return (
    <div className="register-container">
      <div className="register-box">
        <h2 className="register-title">Create Account</h2>

        {error && <p className="register-error">{"failed registeration"}</p>}

        <form onSubmit={handleSubmit} className="register-form">
          <div className="form-group">
            <label>Name</label>
            <input type="text" name="name" value={formData.name} onChange={handleChange} required />
          </div>

          <div className="form-group">
            <label>Email</label>
            <input type="email" name="email" value={formData.email} onChange={handleChange} required />
          </div>

          <div className="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" value={formData.mobile} onChange={handleChange} required />
          </div>

          <div className="form-group">
            <label>Password</label>
            <input type="password" name="password" value={formData.password} onChange={handleChange} required />
          </div>

          <div className="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" value={formData.password_confirmation} onChange={handleChange} required />
          </div>

          <button type="submit" className="register-button">Register</button>
        </form>

        <p className="login-link">
          Already have an account? <Link to="/login">Login here</Link>
        </p>
      </div>
    </div>
  );
}

export default Register;
