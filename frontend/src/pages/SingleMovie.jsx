import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import ReviewForm from "../components/ReviewForm";
import ReviewPost from "../components/ReviewPost";

export default function SingleMovie() {
  const { id } = useParams();
  const [movie, setMovie] = useState(null);

  const fetchMovie = () => {
    fetch(`${import.meta.env.VITE_API_URL}/movies/${id}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Errore nel caricamento del film");
        }
        return response.json();
      })
      .then((data) => setMovie(data))
      .catch((error) => console.error("Errore nel caricamento del film:", error));
  };

  useEffect(() => {
    fetchMovie();
  }, [id]);

  if (!movie) {
    return <p style={{ padding: "2rem" }}>Caricamento film...</p>;
  }

  return (
    <div style={{ display: "flex", flexDirection: "column", alignItems: "center" }}>
      <section style={{ padding: "2rem 1.5rem", display: "flex", justifyContent: "center" }}>
        <div
          style={{
            width: "90%",
            maxWidth: "1100px",
            backgroundColor: "#ffffff",
            borderRadius: "1.25rem",
            boxShadow: "0 8px 24px rgba(0, 0, 0, 0.08)",
            overflow: "hidden",
            display: "grid",
            gridTemplateColumns: "minmax(280px, 0.9fr) minmax(320px, 1.1fr)",
            gap: "1.5rem",
          }}
        >
          <div style={{ backgroundColor: "#f3f4f6", display: "flex", alignItems: "center", justifyContent: "center", padding: "1.5rem" }}>
            <img
              src={movie.image || "https://placehold.co/800x1200?text=CineBool"}
              alt={movie.title}
              style={{ width: "100%", maxHeight: "500px", objectFit: "contain" }}
            />
          </div>

          <div style={{ padding: "1.5rem 1.5rem 1.5rem 0", display: "flex", flexDirection: "column", gap: "0.75rem" }}>
            <div style={{ display: "flex", alignItems: "center", gap: "0.6rem", color: "#111827" }}>
              <i className="bi bi-film" style={{ fontSize: "1.2rem" }} />
              <h1 style={{ margin: 0, fontSize: "1.8rem" }}>{movie.title}</h1>
            </div>

            <div style={{ display: "flex", alignItems: "center", gap: "0.6rem", color: "#4b5563" }}>
              <i className="bi bi-star-fill" style={{ color: "#f59e0b" }} />
              <span><strong>Voto:</strong> {movie.vote}/5</span>
            </div>

            <div style={{ display: "flex", alignItems: "center", gap: "0.6rem", color: "#4b5563" }}>
              <i className="bi bi-tags" />
              <span><strong>Genere:</strong> {movie.genre}</span>
            </div>

            <div style={{ display: "flex", alignItems: "center", gap: "0.6rem", color: "#4b5563" }}>
              <i className="bi bi-calendar3" />
              <span><strong>Anno:</strong> {movie.release_year}</span>
            </div>

            <div style={{ display: "flex", alignItems: "center", gap: "0.6rem", color: "#4b5563" }}>
              <i className="bi bi-person-video" />
              <span><strong>Regista:</strong> {movie.director}</span>
            </div>

            <p style={{ margin: "0.5rem 0 0", color: "#374151", lineHeight: 1.7 }}>{movie.abstract}</p>
          </div>
        </div>
      </section>

      <ReviewForm movieId={id} onReviewAdded={fetchMovie} />

      <section style={{ width: "90%", maxWidth: "1100px", margin: "1.5rem auto 3rem", padding: "1.5rem", borderRadius: "1rem", backgroundColor: "#ffffff", boxShadow: "0 8px 20px rgba(0,0,0,0.05)" }}>
        <div style={{ display: "flex", alignItems: "center", gap: "0.75rem", marginBottom: "1rem", color: "#111827" }}>
          <i className="bi bi-chat-left-text" style={{ fontSize: "1.3rem" }} />
          <h2 style={{ margin: 0, fontSize: "1.15rem" }}>Recensioni del film</h2>
        </div>

        {movie.reviews && movie.reviews.length > 0 ? (
          movie.reviews.map((review) => (
            <ReviewPost key={review.id} review={review} onUpdate={fetchMovie} />
          ))
        ) : (
          <p style={{ color: "#4b5563", margin: 0 }}>Nessuna recensione ancora. Sii il primo a scrivere una recensione!</p>
        )}
      </section>
    </div>
  );
}