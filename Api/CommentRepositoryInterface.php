<?php
namespace AHT\Blog\Api;

interface CommentRepositoryInterface
{
	public function save(\AHT\Blog\Api\Data\CommentInterface $comment);

    public function getById($commentId);

    public function delete(\AHT\Blog\Api\Data\CommentInterface $comment);

    public function deleteById($commentId);
}
?>