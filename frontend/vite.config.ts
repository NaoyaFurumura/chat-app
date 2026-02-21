import { defineConfig } from "vite";
import { reactRouter } from "@react-router/dev/vite";

const backendUrl = process.env.BACKEND_URL ?? "http://localhost:8000";

export default defineConfig({
  plugins: [reactRouter()],
  server: {
    host: true,
    port: 3000,
    proxy: {
      "/api": { target: backendUrl, changeOrigin: true },
      "/sanctum": { target: backendUrl, changeOrigin: true },
    },
  },
});
