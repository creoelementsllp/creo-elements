import React from 'react';
import { motion } from 'framer-motion';

const TransitionWrapper = ({ children }) => {
  return (
    <motion.div
      initial={{ opacity: 0}}
      animate={{ opacity: 1 , duration: 1.5 ,}}
      exit={{
        x: '100%',
        transition: { duration: 0.5}, // Delay to start sliding after scaling
      }}
    >
      {children}
    </motion.div>
  );
};

export default TransitionWrapper;
