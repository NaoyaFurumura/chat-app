import { type RouteConfig, route } from "@react-router/dev/routes";

export default [
  route("/login", "./pages/login/login.tsx"),
  route("/", "./pages/Home/Home.tsx"),
] satisfies RouteConfig;
