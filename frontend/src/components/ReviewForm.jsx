import { useState } from "react";
import { useNavigate } from "react-router-dom";

export default function ReviewForm({ movieId }) {
  const navigate = useNavigate();
  const user = JSON.parse(localStorage.getItem("user"));

  const [vote, setVote] = useState("");
  const [text, setText] = useState("");
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = (event) => {
    event.preventDefault();
    setError("");
    setSuccess("");

    if (!text.trim()) {
      setError("Il testo della recensione è obbligatorio.");
      return;
    }

    const voteNumber = Number(vote);
    if (Number.isNaN(voteNumber) || voteNumber < 1 || voteNumber > 5) {
      setError("Il voto deve essere tra 1 e 5.");
      return;
    }

    setLoading(true); //When a new request is sent to server for the review posted

    fetch(`${import.meta.env.VITE_API_URL}/movies/${movieId}/reviews`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ user_id: user.id, rating: voteNumber, comment: text }),
    })
      .then((response) => response.json())
      .then((data) => {
        setLoading(false);

        if (data.success) {
          navigate(0);
        } else {
          setError("Errore durante l'invio della recensione.");
        }
      })
      .catch((error) => {
        console.error("Errore durante l'invio della recensione:", error);
        setLoading(false);
        setError("Impossibile inviare la recensione. Riprova più tardi.");
      });
  };

  return (
    <div className="card w-100 mt-4" style={{ maxWidth: "1100px" }}>
      <div className="card-body">
        <h2 className="card-title fs-5">Aggiungi una recensione</h2>
        <form onSubmit={handleSubmit} className="d-flex flex-column gap-3">
          <div>
            <label className="form-label">Voto (max 5)</label>
            <input type="number" className="form-control" value={vote} step="1" min="1" max="5" onChange={(e) => setVote(e.target.value)}/>
          </div>
          <div>
            <label className="form-label">Recensione</label>
            <textarea className="form-control" value={text} onChange={(e) => setText(e.target.value)} placeholder="Scrivi qui la tua recensione" rows={5}/>
          </div>
          {error && <div className="alert alert-danger py-2 mb-0">{error}</div>}
          {success && <div className="alert alert-success py-2 mb-0">{success}</div>}
          <button type="submit" disabled={loading} className="btn btn-dark">
            {loading ? "Invio in corso..." : "Pubblica recensione"}
          </button>
        </form>
      </div>
    </div>
  );
}
