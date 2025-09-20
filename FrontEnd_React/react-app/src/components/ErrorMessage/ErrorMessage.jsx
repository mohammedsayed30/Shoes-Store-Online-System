 import styles from './ErrorMessage.module.css';
 
 export default function ErrorMessage({ error }) {
 
    return( 
       <div className={styles.errorBanner}>
           Error: {error.message || String(error)}
       </div>
    )
 }