export default function Header() {
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
          <button type="button" style={{ color: "#374151", background: "none", border: "none", cursor: "pointer", fontSize: "1rem", display: "flex", alignItems: "center", gap: "6px" }}>
            <i className="bi bi-box-arrow-in-right"></i>
            Login
          </button>
        </div>
      </nav>
    </header>
  );
}