import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
  base: '/react/build/', // Prefix all paths with /react/build/
  build: {
    outDir: 'C:/Users/vinay/OneDrive/Desktop/React Trials/creo-elements/react/build', // Specify the output directory (relative path)
  },
  plugins: [react()], // Add the React plugin here
})
