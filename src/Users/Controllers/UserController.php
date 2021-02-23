<?php


namespace WilokeRestAPI\Users\Controllers;


use WilokeRestAPI\Users\Models\UserModel;

class UserController
{
	protected string $requestMethod;
	protected int    $userId;

	public function __construct($requestMethod, $userId)
	{
		$this->requestMethod = $requestMethod;
		$this->userId = $userId;
	}

	public function userGateway()
	{
		switch ($this->requestMethod) {
			case 'GET':
				header('HTTP/1.1 200 OK');
				if ($this->userId) {
					$aResponse = [
						'item' => $this->find($this->userId)
					];
				} else {
					$aResponse = [
						'items' => $this->findAll()
					];
				}
				break;
			case 'POST':
				break;
			case 'DELETE':
				break;
			case 'PUT':
				break;
			default:
				header('HTTP/1.1 Not Acceptable');
				break;
		}

		echo json_encode($aResponse);
	}

	private function find(int $userId)
	{
		return UserModel::getUser($userId);
	}

	private function findAll(): array
	{
		return UserModel::getAll();
	}
}
