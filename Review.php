<?php


require_once 'ReviewService.php';

class Review
{
    public $id;
    public $name;
    public $email;
    public $message;
    public $image;
    public $isDeleted;
    public $isChanged;
    public $isActive;


    public function __construct($id, $name, $email, $message, $image, $isChanged = 0, $isActive = 0, $isDeleted = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->image = $image;
        $this->isChanged = $isChanged;
        $this->isActive = $isActive;
        $this->isDeleted = $isDeleted;

    }


    public function save(): Review
    {
        $service = new ReviewService();
        $service->save($this);
        return $this;

    }

    public static function getAllReviews(): array
    {
        $service = new ReviewService();
        $res = $service->getAllReviews();
        $reviews = [];
        foreach ($res as $review) {
            $reviews[] = new Review($review['id'], $review['name'], $review['email'], $review['message'], $review['image'], $review['is_deleted']);
        }
        return $reviews;
    }

    public static function getReview($id)
    {
        $service = new ReviewService();
        return $service->getReview($id);
    }

    public static function getReviews(): array
    {
        $service = new ReviewService();
        $reviews = [];
        $res = $service->getReviews();
        foreach ($res as $review) {
            $reviews[] = new Review($review['id'],
                $review['name'], $review['email'], $review['message'], $review['image'],
                $review['is_changed'], $review['is_active'],
                $review['is_deleted']
            );
        }
        return $reviews;
    }

    public static function deleteReview($id)
    {
        $service = new ReviewService();
        $service->deleteReview($id);
    }

    public function updateReview(): Review
    {
        $service = new ReviewService();
        $service->updateReview($this);
        return $this;
    }


    public function getImagePath(): string
    {
        return "uploads/" . $this->image;
    }

}