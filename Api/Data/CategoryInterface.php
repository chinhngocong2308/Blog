<?php

namespace AHT\Blog\Api\Data;

interface CategoryInterface
{
	const CATEGORY_ID = 'id';
	const TITLE  = 'title';
	const METATITLE = 'meta_title';
	const METADESCRIPTION = 'meta_description';
	const METAKEYWORD = 'meta_keyword';
	const STATUS = 'status';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	/**
	 * Get category id
	 *
	 * @return int|null
	 */
	public function getId();

	/**
	 * Get category title
	 *
	 * @return string|null
	 */
	public function getTitle();
	/**
	 * Get category title
	 *
	 * @return string|null
	 */
	public function getMetaTitle();
/**
	 * Get category title
	 *
	 * @return string|null
	 */
	public function getMetaDescription();
/**
	 * Get category title
	 *
	 * @return string|null
	 */
	public function getMetaKeyword();
	/**
	 * Set category title
	 *
	 * @return null
	 */
	public function setMetaKeyword($metakeyword);
	/**
	 * Get category id
	 *
	 * @return int|null
	 */
	public function getStatus();
/**
	 * Get category id
	 *
	 * @return int|null
	 */
	public function getCreatedAt();
/**
	 * Get category id
	 *
	 * @return int|null
	 */
	public function getUpdatedAt();
/**
	 * Set category id
	 *
	 * @return int|null
	 */
	public function setId($id);

    /**
     * Set comment title
     *
     * @param string $title
     * @return null
     */
	public function setTitle($title);
  /**
     * Set comment title
     *
     * @param string $title
     * @return null
     */
	public function setMetaTitle($metatitle);
  /**
     * Set comment title
     *
     * @param string $title
     * @return null
     */
	public function setMetaDescription($metadescription);
  /**
     * Set comment title
     *
     * @param string $title
     * @return null
     */
	public function setStatus($status);
  /**
     * Set comment title
     *
     * @param string $title
     * @return null
     */
	public function setCreatedAt($created_at);
  /**
     * Set comment title
     *
     * @param string $title
     * @return null
     */
	public function setUpdatedAt($updated_at);
}
