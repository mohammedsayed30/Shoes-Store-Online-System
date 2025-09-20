
import styles from './AuthMessages.module.css';

function Messages({headerMessage="", textMessage=""}) {
  return (
     <div className={styles.container}>
            <div className={styles.messageBox}>
                <h3 className={styles.title}>{headerMessage}</h3>
                <p className={styles.text}>
                    {textMessage}
                </p>
            </div>
    </div>
  );
}

export default Messages;