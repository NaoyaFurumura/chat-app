import { useAuth0 } from "@auth0/auth0-react";
import { useAuthFetch } from "../../features/Auth/index.js";

export default function Home() {
  const { logout } = useAuth0();
  const { authFetch } = useAuthFetch();
  const handleTest = async () => {
    try {
      const response = await authFetch("/api/test");
      const data = await response.json();
      alert(data.message);
    } catch (error) {
      console.error("APIリクエストエラー:", error);
      alert("APIリクエストに失敗しました");
    }
  };
  return (
    <div>
      <h1>ホーム</h1>
      <button onClick={handleTest}> test </button>
      <button
        onClick={() =>
          logout({
            logoutParams: {
              returnTo: window.location.origin,
            },
          })
        }
      >
        ログアウト
      </button>
    </div>
  );
}
