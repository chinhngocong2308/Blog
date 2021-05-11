<?php
namespace AHT\Blog\Api;

interface PostRepositoryInterface
{
	public function save(\AHT\Blog\Api\Data\PostInterface $post);

    public function getById($postId);

    public function delete(\AHT\Blog\Api\Data\PostInterface $post);

    public function deleteById($postId);
}
?>