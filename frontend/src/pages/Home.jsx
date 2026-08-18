import { useEffect, useState } from "react";
import Card from "../components/Card";

export default function Home() {
    const [movies, setMovies] = useState([]);

    useEffect(() => {
        fetch(`${import.meta.env.VITE_API_URL}/movies`)
            .then((response) => response.json())
            .then((data) => {
                console.log("Risposta ricevuta:", data);
                setMovies(data.results);
            })
            .catch((error) => {
                console.error("Errore nel caricamento dei film:", error);
            });
    }, []);

    return (
        <section style={{ padding: "2rem 1.5rem", maxWidth: "1200px", margin: "0 auto" }}>
            
            <h1 style={{ marginBottom: "1.5rem" }}>
                Film in evidenza
            </h1>

            <div
                style={{
                    display: "grid",
                    gridTemplateColumns: "repeat(auto-fit, minmax(250px, 1fr))",
                    gap: "1.5rem"
                }}
            >
                {movies.map((movie) => (
                    <Card key={movie.id} movie={movie} />
                ))}
            </div>

        </section>
    );
}