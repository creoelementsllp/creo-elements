import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig(({ command }) => {
  const isBuild = command === 'build';

  return {
    base: isBuild ? '/react/build/' : '/', // Use '/react/build/' for production, '/' for dev
    build: {
      outDir: isBuild ? 'C:/Users/vinay/OneDrive/Desktop/React Trials/creo-elements/react/build' : 'dist', // Change the output directory only for production
    },
    plugins: [react()], // Add the React plugin here
    
  };
});
