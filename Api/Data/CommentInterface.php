<?php
namespace AHT\Blog\Api\Data;

interface CommentInterface
{
	const COMMENT_ID = 'id';
	const USERNAME  = 'username';
	const EMAIL = 'email';
    const COMMENT = 'comment';
	const STATUS = 'status';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	public function getId();

	public function getUserName();

    public function getEmail();

	public function getStatus();

	public function getComment();

	public function getCreatedAt();

	public function getUpdatedAt();

	public function setId($id);

    public function setUserName($username);

    public function setEmail($email);

	public function setStatus($status);

	public function setComment($comment);

	public function setCreatedAt($created_at);

	public function setUpdatedAt($updated_at);
}
?>