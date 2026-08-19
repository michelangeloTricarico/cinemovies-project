import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";

export default function Login() {
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");

  const handleSubmit = (event) => {
    event.preventDefault();
    setError("");

    fetch(`${import.meta.env.VITE_API_URL}/login`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          localStorage.setItem("user", JSON.stringify(data.results));
          navigate("/movies");
        } else {
          setError(data.message || "Credenziali non valide.");
        }
      })
      .catch((error) => {
        console.error("Errore durante il login:", error);
        setError("Impossibile effettuare il login. Riprova più tardi.");
      });
  };

  return (
    <div className="container py-5 d-flex justify-content-center">
      <div className="card w-100" style={{ maxWidth: "400px" }}>
        <div className="card-body">
          <h2 className="card-title fs-5 mb-3">Accedi</h2>
          <form onSubmit={handleSubmit} className="d-flex flex-column gap-3">
            <div>
              <label className="form-label">Email</label>
              <input type="email" className="form-control" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="nome@esempio.com"
              />
            </div>
            <div>
              <label className="form-label">Password</label>
              <input type="password" className="form-control" value={password} onChange={(e) => setPassword(e.target.value)} placeholder="La tua password"/>
            </div>
            {error && <div className="alert alert-danger py-2 mb-0">{error}</div>}

            <button type="submit" className="btn btn-dark"> Accedi </button>
          </form>
          <p className="text-center mt-3 mb-0"> Non hai un account? <Link to="/register">Registrati</Link> </p>
        </div>
      </div>
    </div>
  );
}
