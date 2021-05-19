<?php

namespace AHT\Blog\Api;

interface CategoryRepositoryInterface
{

    /**
     * Undocumented function
     *
     * @param \AHT\Blog\Api\Data\CategoryInterface $category
     * @return \AHT\Blog\Api\Data\CategoryInterface
     */
    public function save(\AHT\Blog\Api\Data\CategoryInterface $category);
    

    /**
     * Undocumented function
     *
     * @param int $categoryId
     * @return \AHT\Blog\Api\Data\CategoryInterface
     */
    public function getById($categoryId);
    /**
     * Undocumented function
     *
     * @param \AHT\Blog\Api\Data\CategoryInterface $category
     * @return \AHT\Blog\Api\Data\CategoryInterface
     */
    public function delete(\AHT\Blog\Api\Data\CategoryInterface $category);
    /**
     * Undocumented function
     *
     * @param  string $categoryId
     * @return \AHT\Blog\Api\Data\CategoryInterface
     */
    public function deleteById($categoryId);
}
