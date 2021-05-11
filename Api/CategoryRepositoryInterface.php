<?php
namespace AHT\Blog\Api;

interface CategoryRepositoryInterface
{
	public function save(\AHT\Blog\Api\Data\CategoryInterface $category);

    public function getById($categoryId);

    public function delete(\AHT\Blog\Api\Data\CategoryInterface $category);

    public function deleteById($categoryId);
}
?>