import { useAuth0 } from "@auth0/auth0-react";

export default function Home() {
  const { logout } = useAuth0();
  return (
    <div>
      <h1>ホーム</h1>
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
