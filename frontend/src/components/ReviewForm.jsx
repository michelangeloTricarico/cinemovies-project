import { useState } from "react";

export default function ReviewForm({ movieId, onReviewAdded }) {
  const [name, setName] = useState("");
  const [vote, setVote] = useState("");
  const [text, setText] = useState("");
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (event) => {
    event.preventDefault();
    setError("");
    setSuccess("");

    if (!name.trim() || !text.trim()) {
      setError("Nome e testo della recensione sono obbligatori.");
      return;
    }

    const voteNumber = Number(vote);
    if (Number.isNaN(voteNumber) || voteNumber < 1 || voteNumber > 5) {
      setError("Il voto deve essere tra 1 e 5.");
      return;
    }

    setLoading(true);

    const createdAt = new Date().toISOString().slice(0, 19).replace("T", " ");

    try {
      const response = await fetch(`http://localhost:3000/movies/${movieId}/reviews`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, vote: voteNumber, text, created_at: createdAt }),
      });

      if (!response.ok) {
        throw new Error("Errore durante l'invio della recensione.");
      }

      setName("");
      setVote("");
      setText("");
      setSuccess("Recensione inviata con successo.");
      if (onReviewAdded) onReviewAdded();
    } catch (err) {
      console.error(err);
      setError("Impossibile inviare la recensione. Riprova più tardi.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="card w-100 mt-4" style={{ maxWidth: "1100px" }}>
      <div className="card-body">
        <h2 className="card-title fs-5">Aggiungi una recensione</h2>

        <form onSubmit={handleSubmit} className="d-flex flex-column gap-3">
          <div className="row g-3">
            <div className="col-md-6">
              <label className="form-label">Nome</label>
              <input
                className="form-control"
                value={name}
                onChange={(e) => setName(e.target.value)}
                placeholder="Il tuo nome"
              />
            </div>

            <div className="col-md-6">
              <label className="form-label">Voto (max 5)</label>
              <input
                type="number"
                className="form-control"
                value={vote}
                step="1"
                min="1"
                max="5"
                onChange={(e) => setVote(e.target.value)}
              />
            </div>
          </div>

          <div>
            <label className="form-label">Recensione</label>
            <textarea
              className="form-control"
              value={text}
              onChange={(e) => setText(e.target.value)}
              placeholder="Scrivi qui la tua recensione"
              rows={5}
            />
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
