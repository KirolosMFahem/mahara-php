<?php
require 'MysqlAdapter.php';
require 'database_config.php';

class user extends MysqlAdapter {
    private $_table = 'users';

    public function __construct() {
        global $config;
        parent::__construct($config['host'], $config['username'], $config['password'], $config['database']);
    }

    public function getUsers() {
        $result = $this->select($this->_table);
        return $this->fetchAll($result);
    }

    public function getUser($user_id) {
        $result = $this->select($this->_table, 'id = ' . $user_id);
        return $this->fetch($result);
    }

    public function addUser($user_data) {
        return $this->insert($this->_table, $user_data);
    }

    public function updateUser($user_data, $user_id) {
        return $this->update($this->_table, $user_data, 'id = ' . $user_id);
    }

    public function deleteUser($user_id) {
        return $this->delete($this->_table, 'id = ' . $user_id);
    }

    public function searchUsers($keyword) {
        $result = $this->select($this->_table, 'name LIKE "%' . $keyword . '%" OR email LIKE "%' . $keyword . '%"');
        return $this->fetchAll($result);
    }
}
?>