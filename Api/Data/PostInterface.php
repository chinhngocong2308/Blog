<?php
namespace AHT\Blog\Api\Data;

interface PostInterface
{
	const POST_ID = 'post_id';
	const TITLE  = 'title';
	const CONTENT = 'content';
	const STATUS = 'status';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	public function getId();

	public function getTitle();

	public function getContent();

	public function getStatus();

	public function getCreatedAt();

	public function getUpdatedAt();

	public function setId($id);

	public function setTitle($title);

	public function setContent($content);

	public function setStatus($status);

	public function setCreatedAt($created_at);

	public function setUpdatedAt($updated_at);
}
?>