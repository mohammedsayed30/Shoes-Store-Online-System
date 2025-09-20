// components/NotificationPortal.js
import { createPortal } from 'react-dom';
import { useState, useEffect } from 'react';
import styles from './Notification.module.css';
const NotificationPortal = ({ message, duration = 3000 }) => {
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    if (message) {
      setIsVisible(true);
      const timer = setTimeout(() => setIsVisible(false), duration);
      return () => clearTimeout(timer);
    }
  }, [message, duration]);

  if (!isVisible) return null;

  return createPortal(
    <div className={styles.notification}>
      {message}
    </div>,
    document.body
  );
};

export default NotificationPortal;