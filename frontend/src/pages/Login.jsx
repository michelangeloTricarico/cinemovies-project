import { useState } from "react";
import { Link } from "react-router-dom";

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleSubmit = (event) => {
    event.preventDefault();
    // TODO: collegare al backend quando il login sarà pronto
    console.log("Login:", { email, password });
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
            <button type="submit" className="btn btn-dark"> Accedi </button>
          </form>
          <p className="text-center mt-3 mb-0"> Non hai un account? <Link to="/register">Registrati</Link> </p>
        </div>
      </div>
    </div>
  );
}
