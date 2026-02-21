import { type RouteConfig, layout, route } from "@react-router/dev/routes";

export default [
  route("/login", "./pages/login/login.tsx"),
  layout('./features/Auth/AuthGuard.tsx', [
     route("/", "./pages/Home/Home.tsx")
  ])
] satisfies RouteConfig;
