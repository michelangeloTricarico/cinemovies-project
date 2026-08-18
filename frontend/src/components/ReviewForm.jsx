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
    <div style={{ width: "90%", maxWidth: "1100px", margin: "1.5rem auto 0", padding: "1.5rem", borderRadius: "1rem", backgroundColor: "#ffffff", boxShadow: "0 8px 20px rgba(0,0,0,0.05)" }}>
      <div style={{ display: "flex", alignItems: "center", gap: "0.75rem", marginBottom: "1rem", color: "#111827" }}>
        <i className="bi bi-person-circle" style={{ fontSize: "1.3rem" }} />
        <i className="bi bi-pencil-square" style={{ fontSize: "1.3rem" }} />
        <h2 style={{ margin: 0, fontSize: "1.15rem" }}>Aggiungi una recensione</h2>
      </div>

      <form onSubmit={handleSubmit} style={{ display: "flex", flexDirection: "column", gap: "1rem" }}>
        <div style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: "1rem" }}>
          <label style={{ display: "flex", flexDirection: "column", gap: "0.35rem", color: "#374151" }}>
            Nome
            <input
              value={name}
              onChange={(e) => setName(e.target.value)}
              placeholder="Il tuo nome"
              style={{ padding: "0.85rem", borderRadius: "0.75rem", border: "1px solid #d1d5db" }}
            />
          </label>

          <label style={{ display: "flex", flexDirection: "column", gap: "0.35rem", color: "#374151" }}>
            Voto (max 5)
            <input
              type="number"
              value={vote}
              step="1"
              min="1"
              max="5"
              onChange={(e) => setVote(e.target.value)}
              style={{ padding: "0.85rem", borderRadius: "0.75rem", border: "1px solid #d1d5db" }}
            />
          </label>
        </div>

        <label style={{ display: "flex", flexDirection: "column", gap: "0.35rem", color: "#374151" }}>
          Recensione
          <textarea
            value={text}
            onChange={(e) => setText(e.target.value)}
            placeholder="Scrivi qui la tua recensione"
            rows={5}
            style={{ padding: "0.85rem", borderRadius: "0.75rem", border: "1px solid #d1d5db", resize: "vertical" }}
          />
        </label>

        {error && <p style={{ color: "#bf1e2e", margin: 0 }}>{error}</p>}
        {success && <p style={{ color: "#166534", margin: 0 }}>{success}</p>}

        <button
          type="submit"
          disabled={loading}
          style={{ padding: "0.85rem 1rem", borderRadius: "999px", border: "none", backgroundColor: "#111827", color: "#ffffff", fontWeight: 700, cursor: loading ? "not-allowed" : "pointer" }}
        >
          {loading ? "Invio in corso..." : "Pubblica recensione"}
        </button>
      </form>
    </div>
  );
}
