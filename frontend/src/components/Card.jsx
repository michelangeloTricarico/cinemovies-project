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
        <div className="card">
            <img src={posterUrl}alt={title}/>
            <div className="card-body">
                <h3>{title}</h3>
                <p>{shortDescription}</p>
                {averageVote !== null && (<p> <i className="bi bi-star-fill"></i> {averageVote.toFixed(1)} / 5</p>)}
                <Link to={`/movies/${id}`} className="btn btn-primary">Dettagli</Link>
            </div>
        </div>
    );
}

export default Card;