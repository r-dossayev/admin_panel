<?php



class ReviewService
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=aiplus_db;", "root", "");
    }

    public function save(Review $review):bool
    {
        $sql = "INSERT INTO reviews (name, email, message, image) VALUES (:name, :email, :message, :image)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $review->name);
        $stmt->bindParam(':email', $review->email);
        $stmt->bindParam(':message', $review->message);
        $stmt->bindParam(':image', $review->image);
        $stmt->execute();
        return true;
    }

    public function getAllReviews()
    {
        $sql = "SELECT * FROM reviews";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        // array Review
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getReview($id)
    {
        $sql = "SELECT * FROM reviews WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getReviews(): array
    {
        $sql = "SELECT * FROM reviews WHERE is_deleted = 0";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function deleteReview($id): bool
    {
        $sql = "UPDATE reviews SET is_deleted = 1 WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = false;
        if ($stmt->rowCount() > 0) {
            $res = true;
        }
        return $res;
    }

    public function updateReview(Review $review):bool
    {
        $sql = "UPDATE reviews SET name = :name, email = :email, message = :message, image = :image WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $review->id);
        $stmt->bindParam(':name', $review->name);
        $stmt->bindParam(':email', $review->email);
        $stmt->bindParam(':message', $review->message);
        $stmt->bindParam(':image', $review->image);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}