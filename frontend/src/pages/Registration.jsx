import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";

export default function Registration() {
  const navigate = useNavigate();
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [error, setError] = useState("");

  const handleSubmit = (event) => {
    event.preventDefault();
    setError("");

    fetch(`${import.meta.env.VITE_API_URL}/register`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        name,
        email,
        password,
        password_confirmation: passwordConfirmation,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          navigate("/login");
        } else {
          setError(data.message || "Errore durante la registrazione.");
        }
      })
      .catch((error) => {
        console.error("Errore durante la registrazione:", error);
        setError("Impossibile completare la registrazione. Riprova più tardi.");
      });
  };

  return (
    <div className="container py-5 d-flex justify-content-center">
      <div className="card w-100" style={{ maxWidth: "400px" }}>
        <div className="card-body">
          <h2 className="card-title fs-5 mb-3">Registrati</h2>
          <form onSubmit={handleSubmit} className="d-flex flex-column gap-3">
            <div>
              <label className="form-label">Nome</label>
              <input type="text" className="form-control" value={name} onChange={(e) => setName(e.target.value)} placeholder="Il tuo nome"/>
            </div>
            <div>
              <label className="form-label">Email</label>
              <input type="email" className="form-control" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="nome@esempio.com"/>
            </div>
            <div>
                <label className="form-label">Password</label>
                <input type="password" className="form-control" value={password} onChange={(e) => setPassword(e.target.value)} placeholder="La tua password"/>
            </div>
            <div>
              <label className="form-label">Conferma password</label>
              <input type="password" className="form-control" value={passwordConfirmation} onChange={(e) => setPasswordConfirmation(e.target.value)} placeholder="Ripeti la password"/>
            </div>
            {error && <div className="alert alert-danger py-2 mb-0">{error}</div>}

            <button type="submit" className="btn btn-dark">Registrati</button>
          </form>
          <p className="text-center mt-3 mb-0"> Hai già un account? <Link to="/Login">Accedi</Link></p>
        </div>
      </div>
    </div>
  );
}
