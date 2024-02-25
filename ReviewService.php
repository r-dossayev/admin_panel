<?php

require_once 'Review.php';

class ReviewService
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=aiplus_db;", "root", "");
    }

    public function save(Review $review): bool
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

    public function getReview($id): Review
    {
        $sql = "SELECT * FROM reviews WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // $isChanged = 0, $isActive = 0, $isDeleted = 0
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Review($res['id'], $res['name'], $res['email'], $res['message'],
            $res['image'], $res['is_changed'] , $res['is_active'], $res['is_deleted']

        );
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

    public function updateReview(Review $review): bool
    {
        $sql = "UPDATE reviews SET name = :name, email = :email, message = :message,  is_active = :isActive,
        is_deleted = :isDeleted, is_changed = :isChanged
WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $review->id);
        $stmt->bindParam(':name', $review->name);
        $stmt->bindParam(':email', $review->email);
        $stmt->bindParam(':message', $review->message);
        $stmt->bindParam(':isActive', $review->isActive);
        $stmt->bindParam(':isDeleted', $review->isDeleted);
        $stmt->bindParam(':isChanged', $review->isChanged);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}