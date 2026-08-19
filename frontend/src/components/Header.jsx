import { Link, useNavigate } from "react-router-dom";

export default function Header() {
  const navigate = useNavigate();
  const isLoggedIn = localStorage.getItem("user") !== null;

  const handleLogout = () => {
    localStorage.removeItem("user");
    navigate("/login");
  };

  return (
    <header style={{ backgroundColor: "#f8fafc", padding: "1rem 1.5rem", borderBottom: "1px solid #e5e7eb" }}>
      <nav style={{ display: "flex", justifyContent: "space-between", alignItems: "center", maxWidth: "1000px", margin: "0 auto" }}>
        <a href="/" style={{ textDecoration: "none" }}>
          <img src={"Cine_movies_logo.png"} alt="CineMovies" style={{height: "45px",width: "auto",display: "block"}}/>
        </a>
        <div style={{ display: "flex", gap: "1rem" }}>
          <a href="/movies" style={{ color: "#374151", textDecoration: "none" }}>
            Home
          </a>
          <a href="#chi-siamo" style={{ color: "#374151", textDecoration: "none" }}>
            Chi Siamo
          </a>
          {isLoggedIn ? (
            <button
              type="button"
              onClick={handleLogout}
              style={{ color: "#374151", background: "none", border: "none", cursor: "pointer", fontSize: "1rem", display: "flex", alignItems: "center", gap: "6px" }}
            >
              <i className="bi bi-box-arrow-right"></i>
              Logout
            </button>
          ) : (
            <Link to="/login" style={{ color: "#374151", textDecoration: "none", display: "flex", alignItems: "center", gap: "6px" }}>
              <i className="bi bi-box-arrow-in-right"></i>
              Login
            </Link>
          )}
        </div>
      </nav>
    </header>
  );
}