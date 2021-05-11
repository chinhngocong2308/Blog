<?php
namespace AHT\Blog\Api\Data;

interface CategoryInterface
{
	const POST_ID = 'id';
	const TITLE  = 'title';
	const METATITLE = 'meta_title';
    const METADESCRIPTION = 'meta_description';
	const STATUS = 'status';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	public function getId();

	public function getTitle();

	public function getMetaTitle();

    public function getMetaDescription();

	public function getStatus();

	public function getCreatedAt();

	public function getUpdatedAt();

	public function setId($id);

	public function setTitle($title);

	public function setMetaTitle($metatitle);

    public function setMetaDescription($metadescription);

	public function setStatus($status);

	public function setCreatedAt($created_at);

	public function setUpdatedAt($updated_at);
}
?>