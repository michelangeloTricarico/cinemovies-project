import { socialLinks } from "../database/socialLinks";

export default function Footer() {
  return (
    <footer className="bg-light border-top py-3 px-4">
      <div className="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <p className="mb-0 text-secondary">© 2026 CineMovies Spa</p>
        <div className="d-flex gap-2">
          {socialLinks.map((social) => (
            <a key={social.label} href="#" aria-label={social.label} className="d-flex align-items-center justify-content-center rounded-circle bg-dark text-white" style={{ width: "2.5rem", height: "2.5rem" }}> <i className={`bi ${social.icon}`} /></a>))}
        </div>
      </div>
    </footer>
  );
}