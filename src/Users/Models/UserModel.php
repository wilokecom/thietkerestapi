<?php

namespace WilokeRestAPI\Users\Models;

class UserModel
{
	private static string $tblName = 'users';

	public static function insert($aInfo)
	{
		global $wpdb;

		return $wpdb->query(
			sprintf(
				"INSERT INTO  %s VALUES(%s, %s, %s, %s)",
				self::$tblName, $aInfo['firstname'], $aInfo['lastname'], $aInfo['email'], md5($aInfo['password'])
			)
		);
	}

	public static function delete($userId)
	{
		global $wpdb;

		return $wpdb->query(
			sprintf("DELETE * FROM %s WHERE ID=%d", self::$tblName, $userId)
		);
	}

	public static function getAll(): ?array
	{
		global $wpdb;

		$oResult = $wpdb->query("SELECT * FROM " . self::$tblName);

		if (!$oResult) {
			return [];
		}

		return $oResult->fetch_all(MYSQLI_ASSOC);
	}

	public static function getUser($id): ?array
	{
		global $wpdb;
		$oResult = $wpdb->query(sprintf("SELECT * FROM " . self::$tblName . " WHERE ID=%d", $id));

		if (!$oResult) {
			return [];
		}

		/* fetch associative array */
		while ($aRow = $oResult->fetch_assoc()) {
			return $aRow;
		}

		return [];
	}
}
