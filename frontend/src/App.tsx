import { useState } from "react";
import axios from "axios";
import reactLogo from "./assets/react.svg";
import viteLogo from "/vite.svg";
import "./App.css";

function App() {
  const [count, setCount] = useState(0);
  const [apiMessage, setApiMessage] = useState<string | null>(null);
  const [apiError, setApiError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  const fetchApi = async () => {
    setLoading(true);
    setApiMessage(null);
    setApiError(null);
    try {
      const res = await axios.get("/api/test");
      setApiMessage(res.data.message);
    } catch (e) {
      setApiError(
        "API呼び出し失敗: " + (e instanceof Error ? e.message : String(e)),
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <div>
        <a href="https://vite.dev" target="_blank">
          <img src={viteLogo} className="logo" alt="Vite logo" />
        </a>
        <a href="https://react.dev" target="_blank">
          <img src={reactLogo} className="logo react" alt="React logo" />
        </a>
      </div>
      <h1>Vite + React</h1>
      <div className="card">
        <button onClick={() => setCount((count) => count + 1)}>
          count is {count}
        </button>
        <p>
          Edit <code>src/App.tsx</code> and save to test HMR
        </p>
      </div>
      <div className="card">
        <button onClick={fetchApi} disabled={loading}>
          {loading ? "送信中..." : "バックエンドAPIを叩く"}
        </button>
        {apiMessage && (
          <p style={{ color: "green" }}>レスポンス: {apiMessage}</p>
        )}
        {apiError && <p style={{ color: "red" }}>{apiError}</p>}
      </div>
      <p className="read-the-docs">
        Click on the Vite and React logos to learn more
      </p>
    </>
  );
}

export default App;
