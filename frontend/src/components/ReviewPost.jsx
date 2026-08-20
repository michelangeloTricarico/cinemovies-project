import { useState } from "react";

export default function ReviewPost({ review, onUpdate }) {
  const user = JSON.parse(localStorage.getItem("user"));
  const isOwner = user && review.user_id === user.id;

  const [isEditing, setIsEditing] = useState(false);
  const [text, setText] = useState(review.comment);
  const [vote, setVote] = useState(review.rating);
  const [updatedAt, setUpdatedAt] = useState(review.updated_at || review.created_at);

  const handleSave = () => {
    fetch(`${import.meta.env.VITE_API_URL}/movies/reviews/${review.id}`, {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ rating: vote, comment: text }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          setText(data.results.comment);
          setVote(data.results.rating);
          setUpdatedAt(data.results.updated_at);
          setIsEditing(false);
          if (onUpdate) onUpdate();
        } else {
          alert("Errore durante l'aggiornamento della recensione.");
        }
      })
      .catch((error) => {
        console.error("Errore durante l'aggiornamento della recensione:", error);
        alert("Impossibile aggiornare la recensione. Riprova più tardi.");
      });
  };

  const handleDelete = () => {
    const confirmed = window.confirm("Vuoi veramente eliminare questa recensione?");
    if (!confirmed) return;

    fetch(`${import.meta.env.VITE_API_URL}/movies/reviews/${review.id}`, {
      method: "DELETE",
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          if (onUpdate) onUpdate();
        } else {
          alert("Errore durante l'eliminazione della recensione.");
        }
      })
      .catch((error) => {
        console.error("Errore durante l'eliminazione della recensione:", error);
        alert("Impossibile eliminare la recensione. Riprova più tardi.");
      });
  };

  return (
    <div className="card mb-3">
      <div className="card-body">
        <div className="d-flex justify-content-between align-items-center mb-2">
          <div>
            <p className="fw-bold mb-0">{review.user ? review.user.name : "Utente"}</p>
            <p className="text-secondary mb-0">Voto: {vote}/5</p>
          </div>
          {isOwner && (
            <div className="d-flex gap-2">
              <button type="button" className="btn btn-dark btn-sm" onClick={() => setIsEditing(!isEditing)}>
                {isEditing ? "Annulla" : "Modifica"}
              </button>
              <button type="button" className="btn btn-danger btn-sm" onClick={handleDelete}>Elimina</button>
            </div>
          )}
        </div>
        <div className="row g-3 mb-2">
          <div className="col">
            <label className="form-label">Post</label>
            <textarea className="form-control" value={text} disabled={!isEditing} onChange={(e) => setText(e.target.value)} rows={4}/>
          </div>
          <div className="col-md-2">
            <label className="form-label">Voto</label>
            <input type="number" className="form-control" min="1" max="5" value={vote} disabled={!isEditing} onChange={(e) => setVote(e.target.value)}/>
          </div>
        </div>
        <div className="d-flex justify-content-between align-items-center text-secondary small">
          <div> <p className="mb-0">Creato: {review.created_at}</p><p className="mb-0">Aggiornato: {updatedAt}</p></div>
          {isEditing && (<button type="button" className="btn btn-dark btn-sm" onClick={handleSave}> Salva </button>)}
        </div>
      </div>
    </div>
  );
}
