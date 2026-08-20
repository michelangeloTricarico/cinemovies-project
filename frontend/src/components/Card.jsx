import { Link } from "react-router-dom";

function Card({ movie }) {
    const { id, title, poster, description, reviews } = movie;
    // Calculation of reviews average for each movie
    const averageVote = reviews.length > 0 ? reviews.reduce((sum, review) => sum + review.rating, 0) / reviews.length : null;
    // Set limit for abstract in movies in home page
    const maxLength = 30;
    const shortDescription = description && description.length > maxLength ? description.substring(0, maxLength) + "..." : description;

    // Set poster address
    const posterUrl = `${import.meta.env.VITE_API_URL.replace('/api', '')}/storage/${poster}`;
    return (
        <div className="card h-100">
            <img src={posterUrl} alt={title} className="card-img-top" style={{ height: "320px", objectFit: "cover" }} />
            <div className="card-body d-flex flex-column">
                <h3>{title}</h3>
                <p>{shortDescription}</p>
                {averageVote !== null && (<p> <i className="bi bi-star-fill"></i> {averageVote.toFixed(1)} / 5</p>)}
                <Link to={`/movies/${id}`} className="btn btn-dark mt-auto">Dettagli</Link>
            </div>
        </div>
    );
}
export default Card;