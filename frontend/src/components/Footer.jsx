export default function Footer() {
  const socialLinks = [
    { label: "Facebook", icon: "bi-facebook" },
    { label: "Instagram", icon: "bi-instagram" },
    { label: "X", icon: "bi-twitter-x" },
    { label: "TikTok", icon: "bi-tiktok" },
  ];

  return (
    <footer style={{ backgroundColor: "#f8fafc", borderTop: "1px solid #e5e7eb", padding: "1.25rem 1.5rem" }}>
      <div style={{ maxWidth: "1000px", margin: "0 auto", display: "flex", justifyContent: "space-between", alignItems: "center", flexWrap: "wrap", gap: "1rem" }}>
        <p style={{ margin: 0, color: "#374151", fontSize: "0.95rem" }}>© 2026 CineMovies Spa</p>

        <div style={{ display: "flex", gap: "0.75rem" }}>
          {socialLinks.map((social) => (
            <a 
              key={social.label}
              href="#"
              aria-label={social.label}
              style={{
                width: "2.5rem",
                height: "2.5rem",
                borderRadius: "50%",
                backgroundColor: "#111827",
                color: "#ffffff",
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                textDecoration: "none",
              }}
            >
              <i className={`bi ${social.icon}`} />
            </a>
          ))}
        </div>
      </div>
    </footer>
  );
}