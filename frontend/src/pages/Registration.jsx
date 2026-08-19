import { useState } from "react";
import { Link } from "react-router-dom";

export default function Registration() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");

  const handleSubmit = (event) => {
    event.preventDefault();
    // TODO: collegare al backend quando la registrazione sarà pronta
    console.log("Registrazione:", { name, email, password, passwordConfirmation });
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
            <button type="submit" className="btn btn-dark">Registrati</button>
          </form>
          <p className="text-center mt-3 mb-0"> Hai già un account? <Link to="/Login">Accedi</Link></p>
        </div>
      </div>
    </div>
  );
}
