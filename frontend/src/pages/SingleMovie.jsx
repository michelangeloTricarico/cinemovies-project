import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import ReviewForm from "../components/ReviewForm";
import ReviewPost from "../components/ReviewPost";

export default function SingleMovie() {
  const { id } = useParams();
  const [movie, setMovie] = useState(null);

  // Variables for set if user is logged or not for review
  const isLoggedIn = false;

  const fetchMovie = () => {
    fetch(`${import.meta.env.VITE_API_URL}/movies/${id}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Errore nel caricamento del film");
        }
        return response.json();
      })
      .then((data) => setMovie(data.results))
      .catch((error) => console.error("Errore nel caricamento del film:", error));
  };

  useEffect(() => {
    fetchMovie();
  }, [id]);

  if (!movie) {
    return <p style={{ padding: "2rem" }}>Caricamento film...</p>;
  }

  const averageVote =
    movie.reviews && movie.reviews.length > 0
      ? movie.reviews.reduce((sum, review) => sum + review.rating, 0) / movie.reviews.length
      : null;

  return (
    <div className="d-flex flex-column align-items-center">
      <section className="container py-5 d-flex justify-content-center">
        <div className="card rounded-4 overflow-hidden w-100" style={{ maxWidth: "1100px" }}>
          <div className="row g-0">
            <div className="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
              <img
                src={movie.poster ? `${import.meta.env.VITE_API_URL.replace('/api', '')}/storage/${movie.poster}` : "https://placehold.co/800x1200?text=CineBool"}
                alt={movie.title}
                className="img-fluid"
                style={{ maxHeight: "500px", objectFit: "contain" }}
              />
            </div>

            <div className="col-md-7 p-4 d-flex flex-column gap-2">
              <div className="d-flex align-items-center gap-2 text-dark">
                <i className="bi bi-film fs-4" />
                <h1 className="m-0 fs-2">{movie.title}</h1>
              </div>

              <div className="d-flex align-items-center gap-2 text-secondary">
                <i className="bi bi-star-fill text-warning" />
                <span><strong>Voto:</strong> {averageVote !== null ? `${averageVote.toFixed(1)}/5` : "Nessun voto"}</span>
              </div>

              <div className="d-flex align-items-center gap-2 text-secondary">
                <i className="bi bi-tags" />
                <span><strong>Genere:</strong> {movie.genre}</span>
              </div>

              <div className="d-flex align-items-center gap-2 text-secondary">
                <i className="bi bi-calendar3" />
                <span><strong>Anno:</strong> {movie.release_date}</span>
              </div>

              <div className="d-flex align-items-center gap-2 text-secondary">
                <i className="bi bi-person-video" />
                <span><strong>Regista:</strong> {movie.director ? `${movie.director.first_name} ${movie.director.last_name}` : "N/D"}</span>

                {movie.director && (
                  <div className="dropdown">
                    <button className="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Altre info </button>
                    <ul className="dropdown-menu p-3" style={{ minWidth: "260px" }}>
                      <li className="mb-2">
                        <strong>Data di nascita:</strong> {movie.director.birth_date || "N/D"}
                      </li>
                      <li>
                        <strong>Biografia:</strong> {movie.director.biography || "Nessuna biografia disponibile."}
                      </li>
                    </ul>
                  </div>
                )}
              </div>

              <p className="mt-2 mb-0 text-secondary" style={{ lineHeight: 1.7 }}>{movie.description}</p>
            </div>
          </div>
        </div>
      </section>

      {isLoggedIn && <ReviewForm movieId={id} onReviewAdded={fetchMovie} />}

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