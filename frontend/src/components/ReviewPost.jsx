import { useState } from "react";

export default function ReviewPost({ review, onUpdate }) {
  const [isEditing, setIsEditing] = useState(false);
  const [text, setText] = useState(review.text);
  const [vote, setVote] = useState(review.vote);
  const [updatedAt, setUpdatedAt] = useState(review.updated_at || review.created_at);

  const handleSave = async () => {
    const modifiedAt = new Date().toISOString().slice(0, 19).replace("T", " ");
    try {
      const response = await fetch(`http://localhost:3000/movies/reviews/${review.id}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ text, vote, updated_at: modifiedAt }),
      });

      if (!response.ok) {
        throw new Error("Errore durante l'aggiornamento della recensione.");
      }

      const updatedReview = await response.json();
      setText(updatedReview.text);
      setVote(updatedReview.vote);
      setUpdatedAt(updatedReview.updated_at || modifiedAt);
      setIsEditing(false);
      if (onUpdate) onUpdate();
    } catch (err) {
      console.error(err);
      alert("Impossibile aggiornare la recensione. Riprova più tardi.");
    }
  };

  const handleDelete = async () => {
    const confirmed = window.confirm("Vuoi veramente eliminare questa recensione?");
    if (!confirmed) return;

    try {
      const response = await fetch(`http://localhost:3000/movies/reviews/${review.id}`, {
        method: "DELETE",
      });

      if (!response.ok) {
        throw new Error("Errore durante l'eliminazione della recensione.");
      }

      if (onUpdate) onUpdate();
    } catch (err) {
      console.error(err);
      alert("Impossibile eliminare la recensione. Riprova più tardi.");
    }
  };

  return (
    <div className="card mb-3">
      <div className="card-body">
        <div className="d-flex justify-content-between align-items-center mb-2">
          <div>
            <p className="fw-bold mb-0">{review.name}</p>
            <p className="text-secondary mb-0">Voto: {vote}/5</p>
          </div>
          <div className="d-flex gap-2">
            <button type="button" className="btn btn-dark btn-sm" onClick={() => setIsEditing(!isEditing)}>
              {isEditing ? "Annulla" : "Modifica"}
            </button>
            <button type="button" className="btn btn-danger btn-sm" onClick={handleDelete}>
              Elimina
            </button>
          </div>
        </div>

        <div className="row g-3 mb-2">
          <div className="col">
            <label className="form-label">Post</label>
            <textarea
              className="form-control"
              value={text}
              disabled={!isEditing}
              onChange={(e) => setText(e.target.value)}
              rows={4}
            />
          </div>

          <div className="col-md-2">
            <label className="form-label">Voto</label>
            <input
              type="number"
              className="form-control"
              min="1"
              max="5"
              value={vote}
              disabled={!isEditing}
              onChange={(e) => setVote(e.target.value)}
            />
          </div>
        </div>

        <div className="d-flex justify-content-between align-items-center text-secondary small">
          <div>
            <p className="mb-0">Creato: {review.created_at}</p>
            <p className="mb-0">Aggiornato: {updatedAt}</p>
          </div>
          {isEditing && (
            <button type="button" className="btn btn-dark btn-sm" onClick={handleSave}>
              Salva
            </button>
          )}
        </div>
      </div>
    </div>
  );
}
