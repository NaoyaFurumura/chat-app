import { useAuth0 } from "@auth0/auth0-react";
import { useEffect } from "react";
import { useNavigate } from "react-router";

export default function Login() {
  const { loginWithRedirect, isLoading, isAuthenticated } = useAuth0();
  const navigate = useNavigate();

  useEffect(() => {
    if (isAuthenticated) {
      navigate("/");
    }
  }, [isAuthenticated, navigate, isLoading]);

  return (
    <div>
      <h1>ログイン</h1>
      <button onClick={() => loginWithRedirect()}>
        メールアドレスでログイン
      </button>
    </div>
  );
}
