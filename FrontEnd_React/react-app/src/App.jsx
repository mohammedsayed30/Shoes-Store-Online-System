import Product from "./components/product/Product.jsx";
import Header from "./components/header/Header.jsx";
import About from "./components/about/About.jsx";
import Contact from "./components/contact/contact.jsx";
import ProductDetails from "./components/productDetails/productDetails.jsx";
import Login from "./components/user/login.jsx";
import Logout from "./components/user/logout.jsx";
import Register from "./components/user/register.jsx";
import Recommendations from "./components/recommendations/recommendations.jsx";
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { CartProvider } from './components/Cart/CartContext.jsx';
import CartPage from './components/Cart/CartPage.jsx';
import CheckoutForm from './components/check_out/CheckOut.jsx';
import Messages from "./components/Messages/Messages.jsx";
//to use Log Rocket to analyize the app performance & behavior
import LogRocket from 'logrocket';
LogRocket.init('08rezw/boot-up');





function App() {
  
  return (
    <>
    <CartProvider>
        <Header/>
        <Routes>
          <Route path="/" element={<Product />} />
          <Route path="/cart" element={<CartPage />} />
          <Route path="/products" element={<Product />} />
          <Route path="/product" element={<ProductDetails />} />
          <Route path="/about" element={<About />} />
          <Route path="/contact" element={<Contact />} />
          {/* Protected routes */}
          <Route path="/recommendations" element={
            localStorage.getItem("auth_token") ?
              <Recommendations />
            :
              <Messages 
                headerMessage="You Are Not Logged In"
                textMessage="Please log in to view Your Recommendations ."
              />
          } />
           
          <Route path="/login" element={
              localStorage.getItem("auth_token") ? (
                <Messages 
                  headerMessage="You Already Logged In"
                  textMessage="You are already logged in. Please log out to switch accounts or to log in again."
                />
              ) : (
                <Login />
              )
            }  />
          <Route path="/register" element={
            localStorage.getItem("auth_token") ? (
              <Messages 
                  headerMessage="You Already Have An Account"
                  textMessage="You are already Have an Acount. Please log out to switch accounts."
                />
            ) : (
              <Register />
            )
            } />
         
          <Route 
            path="/checkout" 
            element={
              localStorage.getItem("auth_token") ? (
                <CheckoutForm />
              ) : (
                 <Messages 
                  headerMessage="You Are Not Logged In"
                  textMessage="Please log in to proceed with checkout."
                />
              )
            } 
          />
          <Route 
            path="/logout" 
            element={
              localStorage.getItem("auth_token") ? (
                <Logout />
              ) : (
                <Messages 
                  headerMessage="You Are Not Logged In"
                  textMessage="This Action Requires You To Be Logged In"
                />
              )
            } 
          />
        </Routes>
    </CartProvider>
    </>
  );

}

export default App
