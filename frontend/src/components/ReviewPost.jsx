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
    <div style={{ border: "1px solid #e5e7eb", borderRadius: "1rem", padding: "1rem", backgroundColor: "#ffffff", boxShadow: "0 4px 12px rgba(0,0,0,0.05)", marginBottom: "1rem" }}>
      <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: "0.75rem" }}>
        <div>
          <p style={{ margin: 0, fontWeight: 700 }}>{review.name}</p>
          <p style={{ margin: 0, color: "#6b7280" }}>Voto: {vote}/5</p>
        </div>
        <div style={{ display: "flex", gap: "0.5rem" }}>
          <button
            type="button"
            onClick={() => setIsEditing(!isEditing)}
            style={{ backgroundColor: "#111827", color: "#fff", border: "none", borderRadius: "999px", padding: "0.5rem 0.9rem", cursor: "pointer" }}
          >
            {isEditing ? "Annulla" : "Modifica"}
          </button>
          <button
            type="button"
            onClick={handleDelete}
            style={{ backgroundColor: "#dc2626", color: "#fff", border: "none", borderRadius: "999px", padding: "0.5rem 0.9rem", cursor: "pointer" }}
          >
            Elimina
          </button>
        </div>
      </div>

      <div style={{ display: "flex", justifyContent: "space-between", gap: "1rem", marginBottom: "0.75rem" }}>
        <div style={{ flex: 1 }}>
          <label style={{ display: "block", fontSize: "0.95rem", fontWeight: 600, marginBottom: "0.35rem" }}>Post</label>
          <textarea
            value={text}
            disabled={!isEditing}
            onChange={(e) => setText(e.target.value)}
            rows={4}
            style={{ width: "100%", borderRadius: "0.75rem", border: "1px solid #d1d5db", padding: "0.75rem", resize: "vertical", backgroundColor: isEditing ? "#ffffff" : "#f9fafb" }}
          />
        </div>

        <div style={{ width: "120px", textAlign: "right" }}>
          <label style={{ display: "block", fontSize: "0.95rem", fontWeight: 600, marginBottom: "0.35rem" }}>Voto</label>
          <input
            type="number"
            min="1"
            max="5"
            value={vote}
            disabled={!isEditing}
            onChange={(e) => setVote(e.target.value)}
            style={{ width: "100%", borderRadius: "0.75rem", border: "1px solid #d1d5db", padding: "0.75rem" }}
          />
        </div>
      </div>

      <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", color: "#6b7280", fontSize: "0.9rem" }}>
        <div>
          <p style={{ margin: 0 }}>Creato: {review.created_at}</p>
          <p style={{ margin: 0 }}>Aggiornato: {updatedAt}</p>
        </div>
        {isEditing && (
          <button
            type="button"
            onClick={handleSave}
            style={{ backgroundColor: "#111827", color: "#fff", border: "none", borderRadius: "999px", padding: "0.5rem 0.9rem", cursor: "pointer" }}
          >
            Salva
          </button>
        )}
      </div>
    </div>
  );
}
